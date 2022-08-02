<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;

class BuilderTableCreateMkinternetCrmUslugistatus extends Migration
{
    public function up()
    {
        Schema::create('mkinternet_crm_uslugistatus', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nazwa');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
		
		$mkinternet_crm_uslugistatus = array(
			array('id' => '1','nazwa' => 'Projekt graficzny','created_at' => '2019-07-25 12:56:24','updated_at' => '2019-07-25 12:56:24','deleted_at' => NULL),
			array('id' => '2','nazwa' => 'Kodowanie projektu','created_at' => '2019-07-25 12:56:37','updated_at' => '2019-07-25 12:56:37','deleted_at' => NULL),
			array('id' => '3','nazwa' => 'Do akceptacji klienta','created_at' => '2019-07-25 12:56:47','updated_at' => '2019-07-25 12:56:47','deleted_at' => NULL),
			array('id' => '4','nazwa' => 'Rozliczenie','created_at' => '2019-07-25 12:56:57','updated_at' => '2019-07-25 12:56:57','deleted_at' => NULL)
		);
		
		DB::table('mkinternet_crm_uslugistatus')->insert($mkinternet_crm_uslugistatus);		
    }
    
    public function down()
    {
        Schema::dropIfExists('mkinternet_crm_uslugistatus');
    }
}
