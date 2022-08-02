<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmZdarzenia4 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->string('nazwa')->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->string('nazwa', 10)->change();
        });
    }
}
