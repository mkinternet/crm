<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterMailinglistSubscriber extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_mailinglist_subscriber', function($table)
        {
            $table->increments('id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_mailinglist_subscriber', function($table)
        {
            $table->dropColumn('id');
        });
    }
}
