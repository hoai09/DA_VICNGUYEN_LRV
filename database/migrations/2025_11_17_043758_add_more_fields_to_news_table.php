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
        Schema::table('news', function (Blueprint $table)
        {
            $table->boolean('is_published')->default(false);
            $table->boolean('status')->default(true);

            $table->boolean('featured_news')->default(false);
            $table->boolean('latest_news')->default(false);

            $table->unsignedBigInteger('author_id')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->integer('view_count')->default(0);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
