<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->boolean('is_complete')->default(false);
            $table->text('notes')->nullable();
            $table->string('file_path')->nullable();
            $table->text('guest_notes')->nullable();
            $table->string('guest_uploaded_file_path')->nullable();
            $table->boolean('guest_approval_status')->nullable(); // null: pending, true: approved, false: rejected
            $table->timestamps();
            $table->unique(['project_id', 'document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_documents');
    }
};