<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigValoresTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'config_valores';

    /**
     * Run the migrations.
     * @table config_valores
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('config_id');
            $table->string('valor', 100);

            $table->index(["config_id"], 'fk_config_valores_configs1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('config_id', 'fk_config_valores_configs1_idx')
                ->references('id')->on('configs')
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
