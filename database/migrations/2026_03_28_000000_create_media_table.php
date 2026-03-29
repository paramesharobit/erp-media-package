<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('disk', 64);
            $table->string('path');
            $table->string('filename');
            $table->string('mime_type', 150)->nullable();
            $table->string('extension', 20)->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->string('type', 64);
            $table->string('related_model_type')->nullable();
            $table->string('related_model_id')->nullable();
            $table->timestamps();

            $table->index(['related_model_type', 'related_model_id'], 'media_related_model_index');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
