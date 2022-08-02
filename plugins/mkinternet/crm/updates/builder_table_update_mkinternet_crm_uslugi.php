<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmUslugi extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->integer('uslugistatus_id');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->dropColumn('uslugistatus_id');
        });
    }
}
