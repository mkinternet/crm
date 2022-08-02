<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetLoans3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->decimal('loan_extracharge', 10, 2);
            $table->decimal('loan_value', 10, 2)->nullable()->unsigned(false)->default(null)->change();
            $table->decimal('loan_commision', 10, 2)->nullable()->unsigned(false)->default(null)->change();
            $table->decimal('loan_payedamount', 10, 2)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->dropColumn('loan_extracharge');
            $table->integer('loan_value')->nullable()->unsigned(false)->default(null)->change();
            $table->integer('loan_commision')->nullable()->unsigned(false)->default(null)->change();
            $table->integer('loan_payedamount')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
