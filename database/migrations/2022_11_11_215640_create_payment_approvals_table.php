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
        Schema::create('payment_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->morphs('payment');
            $table->enum('status', ['APPROVED', 'DISAPPROVED']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id', 'payment_approvals_user_id_foreign')
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
        Schema::table('payment_approvals', function (Blueprint $table) {
            $table->dropForeign('payment_approvals_user_id_foreign');
        });

        Schema::dropIfExists('payment_approvals');
    }
};
