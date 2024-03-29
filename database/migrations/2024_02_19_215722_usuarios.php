<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by TablePlus 5.8.4(532)
 * @author https://tableplus.com
 * @source https://github.com/TablePlus/tabledump
 */
class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('NITUSUARIO', 22)->nullable();
            $table->string('NOMUSUARIO', 50)->nullable();
            $table->string('CODUSUARIO', 15);
            $table->text('CLAVEUSUARIO')->nullable();
            $table->enum('ESTADOUSUARIO', ['A','C','B'])->nullable()->default(A);
            $table->string('CODEMPRESA', 20)->nullable()->default(001);
            $table->datetime('FECGRA')->nullable();
            $table->string('EMAIL', 80)->nullable();
            $table->date('FECNAC')->nullable()->default(1990-02-10);
            $table->enum('SEXO', ['','Femenino','Masculino'])->nullable();
            $table->integer('AVATAR')->nullable()->default(0);
            $table->string('numcelular', 10)->nullable();
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
