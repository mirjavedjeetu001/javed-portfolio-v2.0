<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->string('footer_bg_color')->default('#111827')->after('contact_text_color');
            $table->string('footer_text_color')->default('#ffffff')->after('footer_bg_color');
        });
    }

    public function down(): void
    {
        Schema::table('theme_settings', function (Blueprint $table) {
            $table->dropColumn(['footer_bg_color', 'footer_text_color']);
        });
    }
};
