<?php

use App\Models\DistributorProduct;
use App\Models\ManufacturerProduct;
use App\Models\Pos;
use App\Models\PosProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(PosProduct::TABLE, function (Blueprint $table) {
            $table->id();
            $table->comment('Товары в точке продаж');
            $table->unsignedBigInteger(PosProduct::POS_ID);
            $table->boolean(PosProduct::IS_HIDDEN)->default(false);
            $table->unsignedBigInteger(PosProduct::MANUFACTURER_PRODUCT_ID);
            $table->unsignedBigInteger(PosProduct::DISTRIBUTOR_PRODUCT_ID);
            $table->string(PosProduct::NAME);
            $table->string(PosProduct::BARCODE)->nullable();
            $table->string(PosProduct::CATEGORY_ID)->nullable();
            $table->unsignedInteger(PosProduct::CREATED_AT);
            $table->unsignedInteger(PosProduct::UPDATED_AT);

            $table->unique([PosProduct::NAME, PosProduct::POS_ID], 'POS_ID_PRODUCT_NAME_UNIQUE');
            $table->unique([PosProduct::NAME, PosProduct::POS_ID, PosProduct::MANUFACTURER_PRODUCT_ID],
                'MANUFACTURER_PRODUCT_ID_POS_ID_PRODUCT_NAME_UNIQUE');
            $table->unique([PosProduct::NAME, PosProduct::POS_ID, PosProduct::DISTRIBUTOR_PRODUCT_ID],
                'DISTRIBUTOR_PRODUCT_ID_POS_ID_PRODUCT_NAME_UNIQUE');
            $table->index(PosProduct::POS_ID, 'POS_ID_FK');
            $table->foreign(PosProduct::POS_ID)
                ->references(Pos::ID)
                ->on(Pos::TABLE)
                ->onDelete('restrict');
            $table->foreign(PosProduct::MANUFACTURER_PRODUCT_ID)
                ->references(ManufacturerProduct::ID)
                ->on(ManufacturerProduct::TABLE)
                ->onDelete('restrict');
            $table->foreign(PosProduct::DISTRIBUTOR_PRODUCT_ID)
                ->references(DistributorProduct::ID)
                ->on(DistributorProduct::TABLE)
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(PosProduct::TABLE);
    }
};
