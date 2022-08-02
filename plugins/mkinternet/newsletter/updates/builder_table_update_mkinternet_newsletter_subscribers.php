<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterSubscribers extends Migration
{
    public function up()
    {
        Schema::rename('mkinternet_newsletter_mailinglist', 'mkinternet_newsletter_subscribers');
    }
    
    public function down()
    {
        Schema::rename('mkinternet_newsletter_subscribers', 'mkinternet_newsletter_mailinglist');
    }
}
