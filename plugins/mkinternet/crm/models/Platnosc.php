<?php namespace Mkinternet\Crm\Models;

use Model;

/**
 * Model
 */
class Platnosc extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_platnosc';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
