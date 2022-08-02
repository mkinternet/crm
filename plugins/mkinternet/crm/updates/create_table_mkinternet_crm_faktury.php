<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTableMkinternetCrmFaktury extends Migration
{
    public function up()
    {
		Schema::dropIfExists('mkinternet_crm_faktury');
		
		Schema::create('mkinternet_crm_faktury', function($table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id')->unsigned();
		    $table->string('numer', 191);
		    $table->date('datawystawienia');
		    $table->date('datasprzedazy');
		    $table->integer('klienci_id');
		    $table->integer('platnosc_id');
		    $table->boolean('zaplacona');
		    $table->text('uwagi');
		    $table->timestamp('created_at')->nullable()->default(null);
		    $table->timestamp('updated_at')->nullable()->default(null);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		    $table->date('terminplatnosci');
		
		    //$table->primary('id');
			
			
		});
    }
    
    public function down()
    {
		Schema::dropIfExists('mkinternet_crm_faktury');
    }
}
