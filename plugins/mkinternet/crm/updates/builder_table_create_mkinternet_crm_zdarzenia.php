<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetCrmZdarzenia extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_crm_zdarzenia', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('opis');
            $table->smallInteger('nazwa');
            $table->integer('klienci_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_crm_zdarzenia');
    }
}
