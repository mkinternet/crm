<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetLoans extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->integer('loanid')->nullable()->change();
            $table->string('borrower', 191)->nullable()->change();
            $table->integer('loan_value')->nullable()->change();
            $table->integer('loan_commision')->nullable()->change();
            $table->integer('loan_percentage')->nullable()->change();
            $table->integer('loan_payedamount')->nullable()->change();
            $table->dateTime('loan_grantdate')->nullable()->change();
            $table->dateTime('loan_payeddate')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_loans_', function($table)
        {
            $table->integer('loanid')->nullable(false)->change();
            $table->string('borrower', 191)->nullable(false)->change();
            $table->integer('loan_value')->nullable(false)->change();
            $table->integer('loan_commision')->nullable(false)->change();
            $table->integer('loan_percentage')->nullable(false)->change();
            $table->integer('loan_payedamount')->nullable(false)->change();
            $table->dateTime('loan_grantdate')->nullable(false)->change();
            $table->dateTime('loan_payeddate')->nullable(false)->change();
        });
    }
}
