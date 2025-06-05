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
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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

        $project = Project::create($request->all());

        // Initialize project_documents pivot table with all 428 documents
        $documents = Document::all();
        foreach ($documents as $document) {
            $project->documents()->attach($document->id, ['is_complete' => false, 'notes' => '']);
        }

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $documentStages = DocumentStage::with('documents')->get();
        $projectDocuments = $project->documents->keyBy('id');
        return view('projects.edit', compact('project', 'documentStages', 'projectDocuments'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
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

        return redirect()->route('projects.show', $project->id)->with('success', 'Proyek berhasil diperbarui!');
    }

    public function assess(Project $project)
    {
        $documentStages = DocumentStage::with('documents')->get();
        $projectDocuments = $project->documents->keyBy('id');
        return view('projects.assess', compact('project', 'documentStages', 'projectDocuments'));
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

        return redirect()->route('projects.show', $project->id)->with('success', 'Penilaian dokumen berhasil disimpan!');
    }
}