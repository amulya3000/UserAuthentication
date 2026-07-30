<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE backlogs MODIFY status ENUM('To Do', 'In Progress', 'Done', 'On Hold', 'Cancelled') DEFAULT 'To Do'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE backlogs MODIFY status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do'");
    }
};
