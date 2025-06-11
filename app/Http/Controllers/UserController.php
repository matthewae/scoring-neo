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
        return view('user_dashboard');
    }

    public function assessmentResultsIndex()
    {
        $projectDocuments = ProjectDocument::whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('user.assessment_results.index user', compact('projectDocuments'));
    }

    public function assessmentResultsShow(ProjectDocument $projectDocument)
    {
        return view('user.assessment_results.show', compact('projectDocument'));
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
            'document_name' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:1048576', // Max 1GB (1024 * 1024 = 1048576 KB)
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        Document::create([
            'project_id' => $request->project_id,
            'document_name' => $request->document_name,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
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
        $projectDocuments = ProjectDocument::whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('user.documents.index', compact('projectDocuments'));
    }
}