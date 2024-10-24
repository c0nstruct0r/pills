<?php

use App\Models\Pos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Pos::TABLE, function (Blueprint $table) {
            $table->id();
            $table->comment('Точки продаж');
            $table->string(Pos::PARENT_ID)->nullable();
            $table->string(Pos::ALIAS)->nullable();
            $table->string(Pos::NAME);
            $table->string(Pos::ADDRESS);
            $table->integer(Pos::CREATED_AT);
            $table->integer(Pos::UPDATED_AT);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Pos::TABLE);
    }
};
