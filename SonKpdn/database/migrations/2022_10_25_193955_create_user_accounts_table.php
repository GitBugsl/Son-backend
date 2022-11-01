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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('UserNumber')->nullable();
            $table->string('UserPhoto')->nullable();
            $table->string('UserId')->nullable();
            $table->string('UserName')->nullable();
            $table->string('UserSurname')->nullable();
            $table->string('AgreementSeller')->nullable();
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
        Schema::dropIfExists('user_accounts');
    }
};
