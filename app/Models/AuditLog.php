<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'auditable_type',
        'auditable_id',
        'description',
        'ip_address',
        'user_agent',
        'url',
        'method',
    ];

    // Relasi ke user yang melakukan aksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi polymorphic ke objek yang diaudit (Post, dsb.)
    public function auditable()
    {
        return $this->morphTo();
    }
}