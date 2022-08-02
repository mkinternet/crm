<?php namespace Mkinternet\Crm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTableMkinternetCrmKlienci extends Migration
{
    public function up()
    {
		Schema::dropIfExists('mkinternet_crm_klienci');
		
		Schema::create('mkinternet_crm_klienci', function($table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id')->unsigned();
		    $table->string('firma', 191);
		    $table->string('osoba', 191);
		    $table->string('panstwo', 191);
		    $table->string('kodmiasta', 191);
		    $table->string('miasto', 191);
		    $table->string('adres', 191);
		    $table->string('telefon', 191);
		    $table->string('komorka', 191);
		    $table->string('nip', 191);
		    $table->string('regon', 191);
		    $table->string('adresemail', 191);
		    $table->string('stronawww', 191);
		    $table->string('kontohostingowe', 191);
		    $table->smallInteger('abonament');
		    $table->text('adreskoperta');
		    $table->text('notatka');
		    $table->timestamp('created_at')->nullable()->default(null);
		    $table->timestamp('updated_at')->nullable()->default(null);
		    $table->timestamp('deleted_at')->nullable()->default(null);
		
		    //$table->primary('id');
		
		});
    }
    
    public function down()
    {
		Schema::dropIfExists('mkinternet_crm_klienci');
    }
}
