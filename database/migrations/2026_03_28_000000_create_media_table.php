<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->string('type');
            $table->string('related_model_type')->nullable();
            $table->string('related_model_id')->nullable();
            $table->timestamps();

            $table->index(
                ['related_model_type', 'related_model_id'],
                'media_related_model_type_related_model_id_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
