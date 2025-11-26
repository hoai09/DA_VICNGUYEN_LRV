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
        Schema::table('contact_info_tables', function (Blueprint $table) {
            $table->string('type')->default('contact');

            $table->json('social_links')->nullable();

            $table->string('studio_image')->nullable();
            $table->text('studio_content')->nullable();
            $table->json('awards')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
