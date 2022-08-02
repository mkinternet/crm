<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Uslugistatus extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_uslugistatus';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
