<?php

use App\Models\Brand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Manufacturer;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Brand::TABLE, function (Blueprint $table) {
            $table->id();
            $table->comment('Бренды');
            $table->unsignedBigInteger(Brand::MANUFACTURER_ID);
            $table->string(Brand::NAME);
            $table->string(Brand::ALIAS);
            $table->timestamps();

            $table->foreign(Brand::MANUFACTURER_ID)->references(
                Manufacturer::ID
            )->on(Manufacturer::TABLE)->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Brand::TABLE);
    }
};
