<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'file_path', 'document_stage_id'];

    public function documentStage()
    {
        return $this->belongsTo(DocumentStage::class);
    }
}