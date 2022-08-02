<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetNewsletterMailinglist2 extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_newsletter_mailinglist', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_newsletter_mailinglist');
    }
}
