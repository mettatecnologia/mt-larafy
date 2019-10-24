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
            $table->enum('papel', ['SYS', 'SUP', 'ADM', 'USR'])->default('USR');
            $table->date('dtanascimento')->nullable();
            $table->string('logradouro_tipo', 45)->nullable();
            $table->string('logradouro', 100)->nullable();
            $table->integer('logradouro_numero')->nullable();
            $table->string('bairro', 45)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->tinyInteger('ativo');

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
