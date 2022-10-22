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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_id")->unique();

            $table->float('amount');
            $table->tinyInteger('status')->default(0);
            $table->string("type");
            
            $table->string("payment_method")->nullable()->default(null);

            $table->dateTime("completed_at")->nullable()->default(null);
            $table->bigInteger("from_user_id")->unsigned();
            $table->index("from_user_id");
            $table->foreign("from_user_id")->references("id")->on("users")->onDelete("cascade");

            $table->bigInteger("to_user_id")->unsigned()->nullable()->default(null);
            $table->index("to_user_id");
            $table->foreign("to_user_id")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('transactions');
    }
};
