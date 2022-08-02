<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;

class CreateTableMkinternetCrmVat extends Migration
{
    public function up()
    {
		Schema::dropIfExists('mkinternet_crm_vat');
		
		Schema::create('mkinternet_crm_vat', function($table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id')->unsigned();
		    $table->string('nazwa', 191);
		    $table->smallInteger('wartosc');
		    $table->timestamp('created_at')->nullable()->default(null);
		    $table->timestamp('updated_at')->nullable()->default(null);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		
			//$table->primary('id');
		
		});
		
		
		$mkinternet_crm_vat = [
			  ['id' => '1','nazwa' => '23%','wartosc' => '23','created_at' => '2019-02-20 10:21:55','updated_at' => '2019-02-20 10:14:11','deleted_at' => NULL],
			  ['id' => '2','nazwa' => 'np','wartosc' => '0','created_at' => '2019-02-20 09:27:59','updated_at' => '2019-02-20 09:27:59','deleted_at' => NULL],
			  ['id' => '3','nazwa' => '22%','wartosc' => '22','created_at' => '2019-02-20 10:13:14','updated_at' => '2019-02-20 10:13:14','deleted_at' => NULL]
		];
		
		DB::table('mkinternet_crm_vat')->insert($mkinternet_crm_vat);		
		
    }
    
    public function down()
    {
		Schema::dropIfExists('mkinternet_crm_vat');
    }
}
