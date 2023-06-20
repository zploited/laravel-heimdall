<?php

use Illuminate\Database\Schema\Blueprint as Table;
use Illuminate\Support\Facades\Schema;

return new class extends Illuminate\Database\Migrations\Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Table $table) {
            $table->id();
            $table->binary('public');
            $table->binary('private');
            $table->timestamp('created_at');
            $table->timestamp('revoked_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};