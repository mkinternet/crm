<?php namespace Mkinternet\Loans\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Loan extends Controller
{
    public $implement = [        
		'Backend\Behaviors\ListController',        
		'Backend\Behaviors\FormController',
		'Backend.Behaviors.ImportExportController',			
	];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
	public $importExportConfig = 'config_import.yaml';		

    public function __construct()
    {
        parent::__construct();
    }
	
	
	
}
