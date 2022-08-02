<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetLoans4 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->decimal('loan_extracharge', 10, 2)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->decimal('loan_extracharge', 10, 2)->nullable(false)->change();
        });
    }
}
