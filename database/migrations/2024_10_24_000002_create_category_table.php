<?php

use App\Models\Category;
use App\Models\ManufacturerProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Category::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string(Category::NAME);
            $table->unsignedBigInteger(Category::CATEGORY_ID)->nullable();
            $table->comment('Категории товаров');
            $table->integer(Category::CREATED_AT)->unsigned();
            $table->integer(Category::UPDATED_AT)->unsigned();
            $table->foreign(Category::CATEGORY_ID)
                ->references(Category::ID)
                ->on(Category::TABLE)
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Category::TABLE);
    }
};
