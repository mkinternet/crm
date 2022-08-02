<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmUslugi5 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->text('opis')->nullable()->change();
            $table->text('zaplacona')->nullable()->change();
           $table->text('faktury_id')->nullable()->change();
           $table->text('przedluzona')->nullable()->change();
           $table->text('opisprywatny')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_uslugi', function($table)
        {
            $table->text('opis')->nullable(false)->change();
            $table->text('zaplacona')->nullable(false)->change();
            $table->text('faktury_id')->nullable(false)->change();
            $table->text('przedluzona')->nullable(false)->change();
            $table->text('opisprywatny')->nullable(false)->change();
        });
    }
}