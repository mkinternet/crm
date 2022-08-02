<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagins4 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->dateTime('sentdate')->nullable();
            $table->string('emailtitle')->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_campagins', function($table)
        {
            $table->dropColumn('sentdate');
            $table->string('emailtitle', 191)->change();
        });
    }
}
