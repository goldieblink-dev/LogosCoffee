<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    // SQLite doesn't support changing column types easily, but we can just use the enum in the model for logic.
    // For the sake of consistency, if we were on MySQL we'd change it. 
    // In SQLite, we'll just ensure the logic supports 'processing'.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    //
    }
};