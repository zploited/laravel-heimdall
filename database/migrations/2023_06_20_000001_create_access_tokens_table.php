<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint as Table;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('access_tokens', function(Table $table) {
            $table->string('id', 32)->primary();
            $table->string('subject');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->json('scope');
            $table->timestamp('created_at');
            $table->timestamp('expires_at');
            $table->timestamp('not_before')->nullable();
            $table->timestamp('revoked_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('access_tokens');
    }
};