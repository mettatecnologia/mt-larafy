<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cidades';

    /**
     * Run the migrations.
     * @table cidades
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod');
            $table->unsignedInteger('cod_uf');
            $table->integer('codcomdv');
            $table->string('nome', 100);

            $table->index(["cod_uf"], 'fk_cidades_ufs1_idx');


            $table->foreign('cod_uf', 'fk_cidades_ufs1_idx')
                ->references('cod')->on('uf')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
