<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmKlienci3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->smallInteger('hostingrabat')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->dropColumn('hostingrabat');
        });
    }
}
