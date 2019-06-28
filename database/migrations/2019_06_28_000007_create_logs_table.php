<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'logs';

    /**
     * Run the migrations.
     * @table logs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->dateTime('datahora');
            $table->enum('nivel', ['EMERG', 'ALERT', 'CRIT', 'ERR', 'WARN', 'NOTIC', 'INFO', 'DEBUG']);
            $table->string('mensagem');
            $table->string('extra')->nullable();

            $table->index(["user_id"], 'fk_logs_users1_idx');


            $table->foreign('user_id', 'fk_logs_users1_idx')
                ->references('id')->on('users')
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
