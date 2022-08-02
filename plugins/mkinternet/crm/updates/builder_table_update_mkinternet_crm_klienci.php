<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmKlienci extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->boolean('aktywny')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_klienci', function($table)
        {
            $table->dropColumn('aktywny');
        });
    }
}
