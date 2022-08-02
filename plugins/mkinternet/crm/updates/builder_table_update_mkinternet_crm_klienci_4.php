<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmKlienci4 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->smallInteger('hosting_id')->nullable()->index();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->dropColumn('hosting_id');
        });
    }
}
