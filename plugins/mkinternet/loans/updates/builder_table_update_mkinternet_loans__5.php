<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetLoans5 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->string('loan_currency', 191)->nullable()->change();
            $table->string('platform', 191)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->string('loan_currency', 191)->nullable(false)->change();
            $table->string('platform', 191)->nullable(false)->change();
        });
    }
}
