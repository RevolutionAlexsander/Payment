<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutopaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autopayments', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('sender_id');
            $table->foreign('sender_id')
                ->references('id')
                ->on('accounts');
            $table->unsignedInteger('recipient_id');
            $table->foreign('recipient_id')
                ->references('id')
                ->on('accounts');
            $table->decimal('sum');
            $table->date('date');
            $table->unsignedInteger('type_autopayment_id');
            $table->foreign('type_autopayment_id')
                ->references('id')
                ->on('type_autopayments');

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
        Schema::dropIfExists('autopayments');
    }
}
