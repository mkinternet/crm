<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagins3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->integer('mailinglist_id');
            $table->string('emailtitle')->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->dropColumn('mailinglist_id');
            $table->string('emailtitle', 191)->change();
        });
    }
}
