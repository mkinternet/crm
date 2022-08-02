<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMkinternetNewsletterCampagin3 extends Migration
{
    public function up()
    {
        Schema::table('mkinternet_newsletter_campagin', function($table)
        {
            $table->integer('recievecount')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('mkinternet_newsletter_campagin', function($table)
        {
            $table->integer('recievecount')->nullable(false)->change();
        });
    }
}
