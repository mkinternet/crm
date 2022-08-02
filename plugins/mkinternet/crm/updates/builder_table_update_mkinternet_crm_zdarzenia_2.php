<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmZdarzenia2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->renameColumn('klienci_id', 'klient_id');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->renameColumn('klient_id', 'klienci_id');
        });
    }
}
