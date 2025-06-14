<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectDocument;
use App\Models\Project;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        $pendingProposals = ProjectDocument::whereNull('guest_approval_status')
            ->whereNotNull('guest_uploaded_file_path')
            ->with(['project', 'document'])
            ->get();

        return view('user_dashboard', compact('pendingProposals'));
    }

    public function assessmentResultsIndex()
    {
        $assessedProjects = Project::where('user_id', auth()->id())
            ->whereHas('documents', function ($query) {
                $query->where('is_complete', true);
            })
            ->paginate(10);

        return view('user.assessment_results.index user', compact('assessedProjects'));
    }

    public function assessmentResultsShow(Project $project)
    {
        $project->load('projectDocuments');
        $totalDocuments = $project->projectDocuments->count();
        $completedDocuments = $project->projectDocuments->where('is_completed', true)->count();
        $incompleteDocuments = $project->projectDocuments->where('is_completed', false)->count();
        $completionPercentage = $totalDocuments > 0 ? ($completedDocuments / $totalDocuments) * 100 : 0;

        return view('user.assessment_results.show', compact('project', 'totalDocuments', 'completedDocuments', 'incompleteDocuments', 'completionPercentage'));
    }

    public function uploadDocumentForm()
    {
        $projects = Project::where('user_id', auth()->id())->get();
        return view('user.documents.upload', compact('projects'));
    }

    public function storeDocument(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'document_id' => 'required|exists:documents,id',
            'document_file' => 'required|file|mimes:pdf|max:1048576', // Max 1GB
        ]);

        $filePath = null;
        if ($request->hasFile('document_file')) {
            $filePath = $request->file('document_file')->store('project_documents', 'public');
        }

        $projectDocument = ProjectDocument::firstOrNew([
            'project_id' => $request->project_id,
            'document_id' => $request->document_id,
        ]);

        $projectDocument->fill([
            'file_path' => $filePath,
            'guest_approval_status' => false,
        ]);

        $projectDocument->save();

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan ke proyek!');

    }

    public function assessmentSubmissionsIndex()
    {
        $submissions = ProjectDocument::with(['project', 'document'])->get();
        return view('user.assessment_submissions.index', compact('submissions'));
    }

    public function approveSubmission(ProjectDocument $projectDocument)
    {
        $projectDocument->guest_approval_status = true;
        $projectDocument->approved_by_user = auth()->id();
        $projectDocument->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui!');
    }

    public function rejectSubmission(ProjectDocument $projectDocument)
    {
        $projectDocument->guest_approval_status = false;
        $projectDocument->approved_by_user = auth()->id();
        $projectDocument->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil ditolak!');
    }

    public function documentsIndex()
    {
        $projectDocuments = ProjectDocument::with('document')->whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('user.documents.index', compact('projectDocuments'));
    }

    public function getProjectDocuments(Project $project)
    {
        $documents = $project->documents()->get(['documents.id', 'documents.name']);
        return response()->json($documents);
    }

    public function guestApprovalsIndex()
    {
        $guestProposals = ProjectDocument::whereNotNull('guest_uploaded_file_path')
            ->whereNull('guest_approval_status')
            ->with(['project', 'document'])
            ->get();

        return view('user.guest_approvals.index', compact('guestProposals'));
    }

    public function approveGuestProposal(ProjectDocument $document)
    {
        $document->update([
            'guest_approval_status' => true,
            'is_complete' => true
        ]);
        return redirect()->back()->with('success', 'Guest proposal approved successfully.');
    }

    public function rejectGuestProposal(ProjectDocument $document)
    {
        $document->update(['guest_approval_status' => false]);
        return redirect()->back()->with('error', 'Guest proposal rejected.');
    }
}