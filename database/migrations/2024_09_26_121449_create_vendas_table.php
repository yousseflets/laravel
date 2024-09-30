<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('produto_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->integer('quantidade');
            $table->double('total', 10, 2);
            $table->double('lucro_venda', 10, 2);
            $table->decimal('desconto', 5, 2)->default(0)->nullable();
            $table->boolean('status')->default(1);
            $table->dateTime('data_venda');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
