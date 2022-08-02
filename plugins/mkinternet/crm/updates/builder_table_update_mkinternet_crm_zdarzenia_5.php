<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmZdarzenia5 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->dateTime('termin')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->dropColumn('termin');
        });
    }
}
