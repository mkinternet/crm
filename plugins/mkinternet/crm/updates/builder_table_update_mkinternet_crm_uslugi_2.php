<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmUslugi2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->boolean('przedluzona');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->dropColumn('przedluzona');
        });
    }
}
