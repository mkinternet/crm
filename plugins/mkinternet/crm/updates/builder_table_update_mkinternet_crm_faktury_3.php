<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetCrmFaktury3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->string('numer', 191)->nullable()->change();
            $table->dateTime('datawystawienia')->nullable()->change();
            $table->dateTime('datasprzedazy')->nullable()->change();
            $table->integer('klienci_id')->nullable()->change();
            $table->integer('platnosc_id')->nullable()->change();
            $table->boolean('zaplacona')->nullable()->change();
            $table->text('uwagi')->nullable()->change();
            $table->dateTime('terminplatnosci')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_crm_faktury', function($table)
        {
            $table->string('numer', 191)->nullable(false)->change();
            $table->dateTime('datawystawienia')->nullable(false)->change();
            $table->dateTime('datasprzedazy')->nullable(false)->change();
            $table->integer('klienci_id')->nullable(false)->change();
            $table->integer('platnosc_id')->nullable(false)->change();
            $table->boolean('zaplacona')->nullable(false)->change();
            $table->text('uwagi')->nullable(false)->change();
            $table->dateTime('terminplatnosci')->nullable(false)->change();
        });
    }
}
