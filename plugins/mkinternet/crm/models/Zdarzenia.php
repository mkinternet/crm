<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Zdarzenia extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_zdarzenia';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
    public $belongsTo = [
		'klienci' =>          'Mkinternet\Crm\Models\Klienci',
    ];	
	
    public function getKlienciIdOptions()
    {
		$slo = Klienci::orderBy('firma')->lists('firma','id');
		
		return $slo;
   
    }  	
		
	
}
