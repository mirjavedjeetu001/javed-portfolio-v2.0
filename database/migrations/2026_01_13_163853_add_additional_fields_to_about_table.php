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
        Schema::table('about', function (Blueprint $table) {
            $table->integer('clients_served')->default(0)->after('projects_completed');
            $table->integer('awards_won')->default(0)->after('clients_served');
            $table->string('github_url')->nullable()->after('cv_file');
            $table->string('linkedin_url')->nullable()->after('github_url');
            $table->string('website_url')->nullable()->after('linkedin_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn(['clients_served', 'awards_won', 'github_url', 'linkedin_url', 'website_url']);
        });
    }
};
