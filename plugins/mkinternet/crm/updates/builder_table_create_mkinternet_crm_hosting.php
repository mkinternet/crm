<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetCrmHosting extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_crm_hosting', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('nazwa');
            $table->integer('cena');
            $table->date('datawygasniecia')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_crm_hosting');
    }
}
