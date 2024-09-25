<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fornecedor_id')->index();
            $table->unsignedInteger('categoria_id')->index();
            $table->string('nome');
            $table->string('descricao');
            $table->string('qtd_estoque');
            $table->double('preco', 12,5);
            $table->boolean('status')->default(1);
            $table->timestamps();


            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
