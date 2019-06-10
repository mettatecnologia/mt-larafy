<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pessoas';

    /**
     * Run the migrations.
     * @table pessoas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome', 191);
            $table->string('email', 191);
            $table->date('dtanascimento')->nullable()->default(null);
            $table->string('logradouro_tipo', 45)->nullable()->default(null);
            $table->string('logradouro', 100)->nullable()->default(null);
            $table->integer('logradouro_numero')->nullable()->default(null);
            $table->string('logradouro_bairro', 45)->nullable()->default(null);
            $table->string('telefone', 15)->nullable()->default(null);
            $table->tinyInteger('ativo');

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["email"], 'email_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
