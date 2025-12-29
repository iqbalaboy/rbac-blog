<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'auditable_type',
        'auditable_id',
        'ip_address',
        'user_agent',
        'url',
        'method',
    ];

    /**
     * User yang melakukan aksi.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Model yang menjadi subject dari log (misalnya Post/User).
     */
    public function auditable()
    {
        return $this->morphTo(__FUNCTION__, 'auditable_type', 'auditable_id');
    }
}