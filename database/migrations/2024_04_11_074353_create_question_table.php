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
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->cascadeOnDelete();
            $table->string('name');
            $table->enum('choice_type', ['short_answer', 'paragraph', 'date', 'time', 'multiple choice', 'dropdown', 'checkboxes']);
            $table->string('choices');
            $table->boolean('is_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
