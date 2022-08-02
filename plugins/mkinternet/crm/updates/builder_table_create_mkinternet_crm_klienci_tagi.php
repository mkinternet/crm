<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetCrmKlienciTagi extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_crm_klienci_tagi', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('klienci_id');
            $table->integer('tagi_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_crm_klienci_tagi');
    }
}
