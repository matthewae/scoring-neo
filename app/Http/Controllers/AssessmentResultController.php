<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class AssessmentResultController extends Controller
{
    /**
     * Menampilkan daftar proyek yang sudah dinilai.
     */
    public function index()
    {
        // Ambil semua proyek, bisa diubah ke filter jika hanya proyek yang sudah dinilai
        $assessedProjects = Project::all(); 

        return view('assessment_results.index', compact('assessedProjects'));
    }

    /**
     * Menampilkan detail penilaian proyek berdasarkan ID.
     */
    public function show($id)
    {
        // Ambil proyek berdasarkan ID
        $project = Project::findOrFail($id);

        // Jika kamu punya model lain untuk hasil penilaian, misalnya Assessment, kamu bisa ikutkan juga
        // $assessment = Assessment::where('project_id', $id)->first();

        return view('assessment_results.show', compact('project'));
    }
}
