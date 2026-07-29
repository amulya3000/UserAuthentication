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
            $table->dropColumn('sprint');
            $table->foreignId('sprint_id')->nullable()->constrained('sprints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('backlogs', function (Blueprint $table) {
            $table->dropForeign(['sprint_id']);
            $table->dropColumn('sprint_id');
            $table->string('sprint')->nullable();
        });
    }
};
