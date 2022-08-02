<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetCrmTagi extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_crm_tagi', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nazwa');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_crm_tagi');
    }
}
