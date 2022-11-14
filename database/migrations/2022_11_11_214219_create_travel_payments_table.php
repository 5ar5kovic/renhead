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
        Schema::create('travel_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id', 'travel_payments_user_id_foreign')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_payments', function (Blueprint $table) {
            $table->dropForeign('travel_payments_user_id_foreign');
        });

        Schema::dropIfExists('travel_payments');
    }
};
