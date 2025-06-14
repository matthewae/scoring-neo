<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Document;
use App\Models\DocumentStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('user.projects.index', compact('projects'));
    }

    public function create()
    {
        $documentStages = DocumentStage::with('documents')->get();
        return view('user.projects.create', compact('documentStages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string|max:1000',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kementerian_lembaga_perangkat_daerah_institusi' => 'required|string|max:255',
            'konsultan_perencana' => 'required|string|max:255',
            'konsultan_mk' => 'required|string|max:255',
            'kontraktor_pelaksana' => 'required|string|max:255',
            'metode_pemilihan' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric',
            'tanggal_spmk' => 'required|date',
            'jangka_waktu' => 'required|integer',
        ]);

        $project = Project::create(array_merge($request->except(['documents', 'document_files']), ['user_id' => auth()->id()]));

        // Process document assessment values and file uploads
        if ($request->has('documents')) {
            foreach ($request->input('documents') as $document_id => $data) {
                $is_complete = isset($data['is_complete']) && $data['is_complete'] == '1';
                $notes = $data['notes'] ?? '';
                $file_path = null;

                if ($request->hasFile('document_files.' . $document_id)) {
                    $file = $request->file('document_files.' . $document_id);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/documents', $fileName);
                    $file_path = 'documents/' . $fileName;
                }

                $project->documents()->attach($document_id, [
                    'is_complete' => $is_complete,
                    'notes' => $notes,
                    'file_path' => $file_path,
                ]);
            }
        } else {
            // If no documents are submitted, initialize all documents as incomplete
            $documents = Document::all();
            foreach ($documents as $document) {
                $project->documents()->attach($document->id, ['is_complete' => false, 'notes' => '']);
            }
        }

        return redirect()->route('user.projects.index')->with('success', 'Proyek berhasil dibuat!');
    }

    public function syncProjectDocuments()
    {
        $projects = Project::all();
        $allDocuments = Document::all();

        foreach ($projects as $project) {
            $existingDocumentIds = $project->documents->pluck('id')->toArray();
            foreach ($allDocuments as $document) {
                if (!in_array($document->id, $existingDocumentIds)) {
                    $project->documents()->attach($document->id, ['is_complete' => false, 'notes' => '']);
                }
            }
        }

        return redirect()->back()->with('success', 'Dokumen proyek berhasil disinkronkan!');
    }

    public function show(Project $project)
    {
        return view('user.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $documentStages = DocumentStage::with('documents')->get();
        $projectDocuments = $project->documents->keyBy('id');
        return view('user.projects.edit', compact('project', 'documentStages', 'projectDocuments'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string|max:1000',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kementerian_lembaga_perangkat_daerah_institusi' => 'required|string|max:255',
            'konsultan_perencana' => 'required|string|max:255',
            'konsultan_mk' => 'required|string|max:255',
            'kontraktor_pelaksana' => 'required|string|max:255',
            'metode_pemilihan' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric',
            'tanggal_spmk' => 'required|date',
            'jangka_waktu' => 'required|integer',
        ]);

        $project->update($request->all());

        // Update document assessment values
        if ($request->has('documents')) {
            foreach ($request->input('documents') as $document_id => $data) {
                $project->documents()->updateExistingPivot($document_id, [
                    'is_complete' => $data['is_complete'],
                    'notes' => $data['notes'],
                ]);
            }
        }

        return redirect()->route('user.projects.show', $project->id)->with('success', 'Proyek berhasil diperbarui!');
    }

    public function assess(Project $project)
    {
        $documentStages = DocumentStage::with('documents')->get();
        $projectDocuments = $project->documents->keyBy('id');
        return view('user.projects.assess', compact('project', 'documentStages', 'projectDocuments'));
    }

    public function saveAssessment(Request $request, Project $project)
    {
        $request->validate([
            'documents.*.is_complete' => 'required|boolean',
            'documents.*.notes' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($request, $project) {
            foreach ($request->input('documents') as $document_id => $data) {
                $project->documents()->updateExistingPivot($document_id, [
                    'is_complete' => $data['is_complete'],
                    'notes' => $data['notes'],
                ]);
            }
        });

        return redirect()->route('user.projects.show', $project->id)->with('success', 'Penilaian dokumen berhasil disimpan!');
    }

    public function assessmentResultsIndex()
    {
        $assessedProjects = Project::where('user_id', auth()->id())
            ->whereHas('documents', function ($query) {
                $query->where('is_complete', true);
            })
            ->paginate(10);

        return view('user.assessment_results.index', compact('assessedProjects'));
    }

    public function assessmentResultsShow(Project $project)
    {
        // You can load additional data here if needed, e.g., documents, graphs
        $projectDocuments = $project->documents()->where('is_complete', true)->get();
        return view('user.assessment_results.show', compact('project', 'projectDocuments'));
    }
}