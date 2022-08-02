<?php namespace Mkinternet\Newsletter\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMkinternetNewsletterCampagins extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_newsletter_campagins', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_newsletter_campagins');
    }
}
