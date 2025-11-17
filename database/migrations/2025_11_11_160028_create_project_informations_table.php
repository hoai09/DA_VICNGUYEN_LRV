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
        Schema::create('project_informations', function (Blueprint $table) {
        $table->id();
        $table->string('full_name')->nullable();
        $table->string('email')->nullable();
        $table->string('job')->nullable();
        $table->string('age')->nullable();
        $table->string('phone')->nullable();

        $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
        $table->string('type')->nullable();
        $table->string('acreage')->nullable();
        $table->string('scale')->nullable();
        $table->string('address')->nullable();

        // 3. Thông tin chi tiết
        $table->string('a_cost_estimates')->nullable();
        $table->string('number_people')->nullable();
        $table->string('function_room_number')->nullable();
        $table->string('b_cost_estimates')->nullable();
        $table->text('function_description')->nullable();

        // 4. Thông tin khác
        $table->string('design_progress')->nullable();
        $table->string('finishing_progress')->nullable();
        $table->text('hobby_habit')->nullable();
        $table->text('why_do_you_know')->nullable();

        $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_informations');
    }
};
