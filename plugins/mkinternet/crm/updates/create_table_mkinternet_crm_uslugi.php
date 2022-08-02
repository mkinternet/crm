<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTableMkinternetCrmUslugi extends Migration
{
    public function up()
    {
		Schema::dropIfExists('mkinternet_crm_uslugi');
		
		Schema::create('mkinternet_crm_uslugi', function($table) {
			
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('nazwa', 191);
		    $table->text('opis');
		    $table->integer('klienci_id');
		    $table->decimal('cena', 10, 2);
		    $table->smallInteger('vat_id');
		    $table->timestamp('created_at')->nullable()->default(null);
		    $table->timestamp('updated_at')->nullable()->default(null);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		    $table->date('wygasa')->nullable()->default(null);
		    $table->boolean('zaplacona');
		    $table->integer('faktury_id');
		    $table->string('waluta', 191);
		
			//$table->primary('id');
		    
		});	
		
    }
    
    public function down()
    {
		Schema::dropIfExists('mkinternet_crm_uslugi');
    }
}
