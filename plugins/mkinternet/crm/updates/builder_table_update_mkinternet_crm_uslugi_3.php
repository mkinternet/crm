<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmUslugi3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->text('opisprywatny');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->dropColumn('opisprywatny');
        });
    }
}
