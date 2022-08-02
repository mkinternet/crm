<?php namespace Mkinternet\Newsletter\Models;

use Model;

/**
 * Model
 */
class Mailinglist extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_newsletter_mailinglist';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
	

	public $belongsToMany = [
        'subscriber' => [
            \Mkinternet\Newsletter\Models\Subscriber::class,
            'table'      => 'mkinternet_newsletter_mailinglist_subscriber',
        ],
    ];	


    public function getSubsCountAttribute() {
		
		return $this->subscriber()->count();
    }	
	
}
