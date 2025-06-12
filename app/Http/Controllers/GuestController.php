<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    public function dashboard()
    {
        // This could be the guest dashboard, showing projects they can assess or their past submissions
        $projects = Project::all(); // Example: show all projects for guest to view scores
        return view('guest_dashboard', compact('projects'));
    }

    public function guide()
    {
        return view('guest.guide');
    }

    public function projectsIndex()
    {
        $projects = Project::all();
        return view('guest.projects.index', compact('projects'));
    }

    public function showProject(Project $project)
    {
        $project->load(['documents' => function ($query) {
            $query->with('documentStage')->withPivot('value')->orderBy('document_stage_id');
        }]);

        $documentsByStage = $project->documents->groupBy('documentStage.name');

        return view('guest.projects.show', compact('project', 'documentsByStage'));
    }

    public function assess(Project $project)
    {
        $project->load(['documents' => function ($query) {
            $query->with('documentStage')->withPivot('value')->orderBy('document_stage_id');
        }]);

        $documentsGroupedByStage = $project->documents->groupBy('document_stage_id');
        $documentStages = \App\Models\DocumentStage::whereIn('id', $documentsGroupedByStage->keys())->pluck('name', 'id');



        return view('guest.projects.assess', compact('project', 'documentsGroupedByStage', 'documentStages'));
    }

    public function proposeAssessment(ProjectDocument $projectDocument)
    {
        // Form for guest to propose assessment and upload file
        return view('guest.propose_assessment', compact('projectDocument'));
    }

    public function saveAssessment(Request $request, Project $project)
    {
        $request->validate([
            'documents.*' => 'required|numeric|min:0|max:100',
        ]);

        DB::transaction(function () use ($request, $project) {
            foreach ($request->input('documents') as $document_id => $value) {
                $project->documents()->updateExistingPivot($document_id, [
                    'value' => $value,
                ]);
            }
        });

        return redirect()->route('guest.projects.show', $project->id)->with('success', 'Penilaian dokumen berhasil disimpan!');
    }

    public function saveProposedAssessment(Request $request, ProjectDocument $projectDocument)
    {
        $request->validate([
            'guest_notes' => 'nullable|string|max:1000',
            'guest_uploaded_file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('guest_uploaded_file')) {
            $filePath = $request->file('guest_uploaded_file')->store('guest_uploads', 'public');
        }

        $projectDocument->update([
            'guest_notes' => $request->input('guest_notes'),
            'guest_uploaded_file_path' => $filePath,
            'guest_approval_status' => false, // Set to false, awaiting user approval
        ]);

        return redirect()->back()->with('success', 'Pengajuan penilaian berhasil dikirim, menunggu persetujuan!');
    }

    public function upload(Request $request, ProjectDocument $projectDocument)
    {
        return $this->saveProposedAssessment($request, $projectDocument);
    }

    public function submissionHistoryIndex()
    {
        // Logic to retrieve and display submission history for the guest
        $guestProposals = ProjectDocument::whereNotNull('guest_uploaded_file_path')
                                        ->orWhereNotNull('guest_notes')
                                        ->with('project', 'document')
                                        ->get();
        return view('guest.submission_history.index', compact('guestProposals'));
    }

    public function assessmentResultsIndex()
    {
        $projects = Project::with(['projectDocuments.document'])

            ->get();

        return view('guest.assessment_results.index', compact('projects'));
    }

    public function assessmentResultsShow($id)
    {
        $project = Project::with(['projectDocuments.document'])
            ->findOrFail($id);

        return view('guest.assessment_results.show', compact('project'));
    }

    public function guestApprovalsIndex()
    {
        $guestProposals = ProjectDocument::whereNotNull('guest_uploaded_file_path')
                                        ->orWhereNotNull('guest_notes')
                                        ->with('project', 'document')
                                        ->get();
        return view('guest_approvals.index', compact('guestProposals'));
    }

    public function approveGuestProposal(ProjectDocument $projectDocument)
    {
        $projectDocument->update([
            'is_complete' => true, // Assuming approval means it's complete
            'notes' => $projectDocument->guest_notes, // Copy guest notes to main notes
            'file_path' => $projectDocument->guest_uploaded_file_path, // Copy guest file to main file
            'guest_approval_status' => true,
        ]);

        return redirect()->back()->with('success', 'Pengajuan guest berhasil disetujui!');
    }

    public function rejectGuestProposal(ProjectDocument $projectDocument)
    {
        $projectDocument->update([
            'guest_approval_status' => false, // Explicitly mark as rejected/not approved
            'guest_notes' => null, // Clear guest notes on rejection
            'guest_uploaded_file_path' => null, // Clear guest file on rejection
        ]);

        // Optionally delete the uploaded file from storage
        if ($projectDocument->guest_uploaded_file_path) {
            Storage::disk('public')->delete($projectDocument->guest_uploaded_file_path);
        }

        return redirect()->back()->with('success', 'Pengajuan guest berhasil ditolak!');
    }
}