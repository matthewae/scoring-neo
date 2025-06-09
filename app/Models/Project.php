<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_description',
        'user_id',
        'pekerjaan',
        'lokasi',
        'kementerian_lembaga_perangkat_daerah_institusi',
        'konsultan_perencana',
        'konsultan_mk',
        'kontraktor_pelaksana',
        'metode_pemilihan',
        'nilai_kontrak',
        'tanggal_spmk',
        'jangka_waktu',
    ];

    public function projectDocuments()
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'project_documents')
                    ->withPivot('is_complete', 'notes', 'file_path', 'guest_uploaded', 'approved_by_user')
                    ->withTimestamps();
    }
}