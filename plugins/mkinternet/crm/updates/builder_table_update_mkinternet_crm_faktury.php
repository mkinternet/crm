<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmFaktury extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->dateTime('datawystawienia')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->date('datawystawienia')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
