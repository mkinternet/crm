<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetNewsletterMailinglistSubscriber extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_newsletter_mailinglist_subscriber', function($table)
        {
            $table->engine = 'InnoDB';
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('mailinglist_id');
            $table->integer('subscriber_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_newsletter_mailinglist_subscriber');
    }
}
