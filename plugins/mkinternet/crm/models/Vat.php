<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Vat extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_vat';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
    public $hasMany = [
		'uslugi' =>          [\MKinternet\Crm\Models\Uslugi::class],
    ];		
	
}
