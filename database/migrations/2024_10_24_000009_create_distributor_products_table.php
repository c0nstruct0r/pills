<?php

use App\Models\DistributorProduct;
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
        Schema::create(DistributorProduct::TABLE, function (Blueprint $table) {
            $table->id();
            $table->comment('Товары поставщиков');
            $table->unsignedBigInteger(DistributorProduct::MANUFACTURER_PRODUCT_ID);
            $table->unsignedBigInteger(DistributorProduct::DISTRIBUTOR_ID)->nullable();
            $table->string(DistributorProduct::BARCODE)->nullable();
            $table->string(DistributorProduct::NAME);
            $table->integer(DistributorProduct::CREATED_AT);
            $table->integer(DistributorProduct::UPDATED_AT);

            $table->foreign(DistributorProduct::MANUFACTURER_PRODUCT_ID)->references(
                ManufacturerProduct::ID
            )->on(ManufacturerProduct::TABLE)->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(DistributorProduct::TABLE);
    }
};
