<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmZdarzenia extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->string('nazwa', 10)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->smallInteger('nazwa')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
