<?php namespace Mkinternet\Crm\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Uslugistatus extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

	public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();
		
		BackendMenu::setContext('Mkinternet.Crm', 'crm', 'uslugistatus');
    }
}
