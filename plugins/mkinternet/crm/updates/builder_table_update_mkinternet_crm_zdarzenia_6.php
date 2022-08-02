<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmZdarzenia6 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->text('opis')->nullable()->change();
            $table->string('nazwa', 191)->nullable()->change();
            $table->integer('klienci_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_zdarzenia', function($table)
        {
            $table->text('opis')->nullable(false)->change();
            $table->string('nazwa', 191)->nullable(false)->change();
            $table->integer('klienci_id')->nullable(false)->change();
        });
    }
}
