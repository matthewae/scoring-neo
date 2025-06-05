<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectDocument extends Pivot
{
    use HasFactory;

    protected $table = 'project_documents';

    protected $fillable = [
        'project_id',
        'document_id',
        'is_complete',
        'notes',
        'file_path',
        'guest_uploaded_file_path',
        'guest_notes',
        'guest_approval_status',
    ];

    protected $casts = [
        'is_complete' => 'boolean',
        'guest_approval_status' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}