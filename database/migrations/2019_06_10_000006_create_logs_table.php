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
            $table->string('mensagem', 191);
            $table->string('extra', 191)->nullable()->default(null);

            $table->unique(["id"], 'id_UNIQUE');

            $table->index(["user_id"], 'fk_logs_users_idx');
            $table->foreign('user_id', 'fk_logs_users_idx')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
