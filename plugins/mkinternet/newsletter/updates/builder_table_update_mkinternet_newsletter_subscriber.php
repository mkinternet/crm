<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterSubscriber extends Migration
{
    public function up()
    {
        Schema::rename('mkinternet_newsletter_subscribers', 'mkinternet_newsletter_subscriber');
    }
    
    public function down()
    {
        Schema::rename('mkinternet_newsletter_subscriber', 'mkinternet_newsletter_subscribers');
    }
}
