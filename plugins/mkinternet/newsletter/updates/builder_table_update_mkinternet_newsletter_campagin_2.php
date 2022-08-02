<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagin2 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_campagin', function($table)
        {
            $table->integer('recievecount');
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_campagin', function($table)
        {
            $table->dropColumn('recievecount');
        });
    }
}
