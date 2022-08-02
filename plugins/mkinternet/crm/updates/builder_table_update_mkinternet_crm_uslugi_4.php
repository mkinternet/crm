<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmUslugi4 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->integer('uslugistatus_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->integer('uslugistatus_id')->nullable(false)->change();
        });
    }
}
