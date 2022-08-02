<?php namespace Mkinternet\Loans\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetLoans extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_loans_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('loanid');
            $table->string('borrower');
            $table->integer('loan_value');
            $table->integer('loan_commision');
            $table->integer('loan_percentage');
            $table->integer('loan_payedamount');
            $table->dateTime('loan_grantdate');
            $table->dateTime('loan_payeddate');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_loans_');
    }
}
