<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('buyer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('po')->nullable();
            $table->string('season')->nullable();
            $table->string('style')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('color')->nullable();
            $table->string('size_range')->nullable();
            $table->foreignId('sample_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('qty');
            $table->string('tag');
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('fabric')->nullable();
            $table->string('gsm')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('samples');
    }
};
