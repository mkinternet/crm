<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Tagi extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_tagi';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
	public $belongsToMany = [
        'tagi' => [
            \Mkinternet\Crm\Models\Tagi::class,
            'table'      => 'mkinternet_crm_klienci_tagi',
        ],
    ];		
	
}
