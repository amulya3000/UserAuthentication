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
        Schema::table('backlogs', function (Blueprint $table) {
            $table->string('sprint')->nullable();
            $table->enum('status', ['To Do', 'In Progress', 'Done'])->default('To Do');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('backlogs', function (Blueprint $table) {
            $table->dropColumn(['sprint', 'status']);
        });
    }
};
