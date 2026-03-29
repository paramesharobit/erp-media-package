<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('erp_media', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('disk', 100);
            $table->string('directory')->nullable();
            $table->string('name');
            $table->string('mime_type', 150);
            $table->string('extension', 20)->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->string('path')->unique();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['disk', 'directory']);
            $table->index('mime_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('erp_media');
    }
};
