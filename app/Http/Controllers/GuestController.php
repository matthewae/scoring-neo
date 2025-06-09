<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    public function dashboard()
    {
        // This could be the guest dashboard, showing projects they can assess or their past submissions
        $projects = Project::all(); // Example: show all projects for guest to view scores
        return view('guest_dashboard', compact('projects'));
    }

    public function projectsIndex()
    {
        $projects = Project::all();
        return view('guest.projects.index', compact('projects'));
    }

    public function showProject(Project $project)
    {
        // Show project details and current scores for guests
        return view('guest.project_details', compact('project'));
    }

    public function proposeAssessment(ProjectDocument $projectDocument)
    {
        // Form for guest to propose assessment and upload file
        return view('guest.propose_assessment', compact('projectDocument'));
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