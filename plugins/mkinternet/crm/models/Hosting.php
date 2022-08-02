<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Hosting extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_hosting';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
    public $belongsTo = [
		'klienci' =>          'Mkinternet\Crm\Models\Klienci',
    ];	

	public $hasMany = [

		'klienci' =>          'Mkinternet\Crm\Models\Klienci',
    ];	
}
