<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetNewsletterMailinglist extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_newsletter_mailinglist', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('recordid');
            $table->string('email');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_newsletter_mailinglist');
    }
}
