<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagin extends Migration
{
    public function up()
    {
        Schema::rename('mkinternet_newsletter_campagins', 'mkinternet_newsletter_campagin');
        Schema::table('mkinternet_newsletter_campagin', function($table)
        {
            $table->string('emailtitle')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('mkinternet_newsletter_campagin', 'mkinternet_newsletter_campagins');
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->string('emailtitle', 191)->change();
        });
    }
}
