<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'status',
        'published_at',
    ];

    protected $casts = [
        // Kolom body akan disimpan terenkripsi di DB (AES-256-CBC, key dari APP_KEY)
        'body' => 'encrypted:string',
        'published_at' => 'datetime',
    ];

    // Generate slug otomatis saat create jika slug belum diisi
    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . Str::random(6);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}