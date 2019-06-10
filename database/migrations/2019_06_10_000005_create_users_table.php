<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('pessoa_id');
            $table->string('password', 191);
            $table->enum('papel', ['SUP', 'ADM', 'USR'])->default('USR');
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->rememberToken();
            $table->tinyInteger('ativo');

            $table->unique(["id"], 'id_UNIQUE');

            $table->index(["pessoa_id"], 'fk_users_pessoas_idx');
            $table->foreign('pessoa_id', 'fk_users_pessoas_idx')
                ->references('id')->on('pessoas')
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
