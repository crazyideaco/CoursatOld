<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentwayCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers_paymentway', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("paymentway_id")->nullable()->index();
            $table->unsignedBigInteger("center_id")->nullable()->index();
            $table->foreign("paymentway_id")->references("id")->on("paymentways")->restrictOnDelete();
            $table->foreign("center_id")->references("id")->on("users")->restrictOnDelete();
            $table->boolean("active")->default(1);
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
        Schema::dropIfExists('paymentway_centers');
    }
}
