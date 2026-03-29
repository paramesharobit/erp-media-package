<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('media', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('disk', 50)->default('public')->index();
            $table->string('directory', 255)->default('');
            $table->string('original_name');
            $table->string('filename')->index();
            $table->string('path')->unique();
            $table->string('mime_type', 150)->index();
            $table->string('extension', 20)->nullable();
            $table->unsignedBigInteger('size');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
