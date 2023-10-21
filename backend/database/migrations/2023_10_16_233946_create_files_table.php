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
        Schema::create('files', function (Blueprint $table) {
            $table->string("id")->nullable(false)->primary();
            $table->string("user_id")->nullable(false);
            $table->text("fileName")->nullable(false);
            $table->text("thumbnail")->nullable()->default(null);
            $table->boolean("stared")->nullable(false)->default(false);
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};