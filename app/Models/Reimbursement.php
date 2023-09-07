<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;

    protected $table = 'reimbursement';

    protected $fillable = [
        'name',
        'creator_id',
        'approver_id',
        'nominal',
        'approved_at',
        'status',
        'desc',
        'files',
    ];

    // Relasi ke tabel 'role' untuk 'creator_id'
    public function creator()
    {
        return $this->belongsTo(Role::class, 'creator_id');
    }

    // Relasi ke tabel 'role' untuk 'approver_id'
    public function approver()
    {
        return $this->belongsTo(Role::class, 'approver_id');
    }
}
