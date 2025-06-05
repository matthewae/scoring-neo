<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentStage;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('documentStage')->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $documentStages = DocumentStage::all();
        return view('documents.create', compact('documentStages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:documents,name',
            'document_stage_id' => 'required|exists:document_stages,id',
        ]);

        Document::create($request->all());

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function edit(Document $document)
    {
        $documentStages = DocumentStage::all();
        return view('documents.edit', compact('document', 'documentStages'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'name' => 'required|unique:documents,name,' . $document->id,
            'document_stage_id' => 'required|exists:document_stages,id',
        ]);

        $document->update($request->all());

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }