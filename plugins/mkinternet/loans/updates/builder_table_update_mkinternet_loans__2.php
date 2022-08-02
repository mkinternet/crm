<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetLoans2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->string('loan_currency');
            $table->string('platform');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->dropColumn('loan_currency');
            $table->dropColumn('platform');
        });
    }
}
