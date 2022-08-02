<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;

class CreateTableMkinternetCrmPlatnosc extends Migration
{
    public function up()
    {
		Schema::dropIfExists('mkinternet_crm_platnosc');
		
		Schema::create('mkinternet_crm_platnosc', function($table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('nazwa', 191);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		    $table->timestamp('created_at')->nullable()->default(null);
		    $table->timestamp('updated_at')->nullable()->default(null);
		
		    //$table->primary('id');
			
		
		});
		
		
		$mkinternet_crm_platnosc = [
			  ['id' => '1','nazwa' => 'Przelew','deleted_at' => NULL,'created_at' => NULL,'updated_at' => NULL],
			  ['id' => '2','nazwa' => 'Gotówka','deleted_at' => NULL,'created_at' => NULL,'updated_at' => NULL],
			  ['id' => '3','nazwa' => 'Przelew-przedpłata','deleted_at' => NULL,'created_at' => NULL,'updated_at' => NULL]
		];
		
		
		DB::table('mkinternet_crm_platnosc')->insert($mkinternet_crm_platnosc);		
		
    }
    
    public function down()
    {
		Schema::dropIfExists('mkinternet_crm_platnosc');
    }
}
