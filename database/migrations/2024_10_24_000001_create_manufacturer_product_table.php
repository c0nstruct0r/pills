<?php

use App\Models\Brand;
use App\Models\Manufacturer;
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
        Schema::create(ManufacturerProduct::TABLE, function (Blueprint $table) {
            $table->id();
            $table->comment('Товары производителя');
            $table->boolean(ManufacturerProduct::IS_PUBLISHED)->default(false);
            $table->unsignedBigInteger(ManufacturerProduct::CATEGORY_ID)->nullable();
            $table->string(ManufacturerProduct::BARCODE)->unique()->nullable();
            $table->string(ManufacturerProduct::NAME);
            $table->string(ManufacturerProduct::ALIAS)->nullable();
            $table->unsignedBigInteger(ManufacturerProduct::MANUFACTURER_ID)->nullable();
            $table->unsignedBigInteger(ManufacturerProduct::BRAND_ID)->nullable();
            $table->integer(ManufacturerProduct::CREATED_AT);
            $table->integer(ManufacturerProduct::UPDATED_AT);

            $table->foreign(ManufacturerProduct::MANUFACTURER_ID)
                ->references(Manufacturer::ID)
                ->on(Manufacturer::TABLE)
                ->onDelete('restrict');
            $table->foreign(ManufacturerProduct::BRAND_ID)
                ->references(Brand::ID)
                ->on(Brand::TABLE)
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ManufacturerProduct::TABLE);
    }
};
