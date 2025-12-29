<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'subject_type',
        'subject_id',
        'ip_address',
    ];

    /**
     * User yang melakukan aksi.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Model yang menjadi subject dari log (misalnya Post).
     */
    public function subject()
    {
        // morphTo() pakai kolom subject_type & subject_id
        return $this->morphTo(__FUNCTION__, 'subject_type', 'subject_id');
    }
}