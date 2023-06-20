<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint as Table;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function(Table $table) {
            $table->string('id', 32)->primary();
            $table->binary('secret')->nullable();
            $table->string('name');
            $table->json('redirect_uri');
            $table->boolean('allow_skip_consent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};