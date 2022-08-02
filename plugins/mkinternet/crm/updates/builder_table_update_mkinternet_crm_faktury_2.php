<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmFaktury2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->dateTime('datasprzedazy')->nullable(false)->unsigned(false)->default(null)->change();
            $table->dateTime('terminplatnosci')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->date('datasprzedazy')->nullable(false)->unsigned(false)->default(null)->change();
            $table->date('terminplatnosci')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
