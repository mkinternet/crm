<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagins2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->string('emailtitle');
            $table->text('emailcontent');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->dropColumn('emailtitle');
            $table->dropColumn('emailcontent');
        });
    }
}
