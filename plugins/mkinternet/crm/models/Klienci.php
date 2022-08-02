<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Klienci extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_klienci';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	


    public $hasMany = [
		'zdarzenia' =>         'Mkinternet\Crm\Models\Zdarzenia',
		'uslugi' =>         'Mkinternet\Crm\Models\Uslugi',

    ];		

    public $belongsTo = [
		'hosting' =>          'Mkinternet\Crm\Models\Hosting',
    ];	

	
	public $belongsToMany = [
        'tagi' => [
            \Mkinternet\Crm\Models\Tagi::class,
            'table'      => 'mkinternet_crm_klienci_tagi',
        ],
    ];

    public function getHostingOptions()
    {
		$dane = \Mkinternet\Crm\Models\Hosting::get();
		
		$slo = [];
		
		foreach($dane as $dane){
			$slo[$dane->id] = $dane->nazwa.' cena:'.$dane->cena;
		}
		
		//dd($slo);
		
		return $slo;
   
    }    	
	
}
