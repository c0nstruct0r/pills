<?php

use App\Models\Manufacturer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Manufacturer::TABLE, function (Blueprint $table) {
            $table->comment('Производители');
            $table->id();
            $table->string(Manufacturer::NAME);
            $table->string(Manufacturer::ALIAS);
            $table->string(Manufacturer::ADDRESS)->nullable();
            $table->string(Manufacturer::URL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Manufacturer::TABLE);
    }
};
