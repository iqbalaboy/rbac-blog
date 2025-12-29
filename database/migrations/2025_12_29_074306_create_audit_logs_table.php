<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            // siapa yang melakukan
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // jenis aksi, misalnya: login, post_created, post_updated, post_deleted, post_submitted, post_approved, post_rejected
            $table->string('action');

            // tipe dan id objek yang terlibat (polymorphic)
            $table->string('auditable_type')->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();

            // ringkasan / deskripsi singkat
            $table->text('description')->nullable();

            // konteks request
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('url')->nullable();
            $table->string('method', 10)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};