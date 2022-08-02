<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmKlienci2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->string('kodmiasta', 20)->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->string('kodmiasta', 191)->change();
        });
    }
}
