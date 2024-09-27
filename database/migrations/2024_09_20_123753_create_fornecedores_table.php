<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cnpj');
            $table->string('email')->unique();
            $table->boolean('status')->default(1);
            $table->string('cep', 8);
            $table->string('logradouro', 120);
            $table->string('numero', 120);
            $table->string('complemento', 60)->nullable();
            $table->string('bairro', 60);
            $table->string('cidade', 60);
            $table->string('uf', 2);
            $table->string('telefone', 15);
            $table->string('celular', 15);
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
        Schema::dropIfExists('fornecedores');
    }
}
