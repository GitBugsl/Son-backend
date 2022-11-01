<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('SupplierShopName')->nullable();
            $table->string('SupplierNumber')->nullable();
            $table->string('SupplierShopType')->nullable();
            $table->string('SupplierShopPhoto')->nullable();
            $table->string('SupplierId')->nullable();
            $table->string('SupplierShopInfo')->nullable();
            $table->string('SupplierHolidayMode')->nullable();
            $table->string('OpenEntegratorKey')->nullable();
            $table->string('OpenEntegratorId')->nullable();
            $table->string('SupplierIbank')->nullable();
            $table->string('SupplierBankName')->nullable();
            $table->string('SupplierVkn')->nullable();
            $table->string('SupplierVd')->nullable();
            $table->string('AgreementSeller')->nullable();
            $table->string('SupplierName')->nullable();
            $table->string('SupplierSurname')->nullable();
            $table->timestamps();
        });
    }
 

   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_accounts');
    }
};
