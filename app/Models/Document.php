<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'document_stage_id'];

    public function stage()
    {
        return $this->belongsTo(DocumentStage::class, 'document_stage_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_documents')
                    ->withPivot('is_complete', 'notes', 'file_path');
    }
}