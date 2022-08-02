<?php namespace Mkinternet\Newsletter\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Subscriber extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
		
		BackendMenu::setContext('Mkinternet.Newsletter', 'newsletter', 'subscriber');
    }
	
	
	/*
	public function index()
	{
		//$mailinglists = \Mkinternet\Newsletter\Models\Mailinglist::all();
		
		
		//dd($mailinglists);

		// Call the ListController behavior index() method
		
//		dd($this->records);
		
		//dd($this->listExtendRecords($this->records));
		
		
		//$this->vars['mailinglists'] = $mailinglists;
		
		
		//dd($this);
		
	//	$this->asExtension('ListController')->index();
	}		
	*/
}
