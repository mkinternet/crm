<?php namespace Mkinternet\Newsletter\Models;

use Model;

/**
 * Model
 */
class Campagin extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_newsletter_campagin';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	
	
    public $belongsTo = [
		'mailinglist' =>         'Mkinternet\Newsletter\Models\Mailinglist',
    ];		
	
}
