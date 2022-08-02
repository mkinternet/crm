<?php namespace Mkinternet\Crm\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Redirect;
use Backend;

use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;
use Smsapi\Client\Feature\Sms\Data\Sms;
use Smsapi\Client\Curl\SmsapiHttpClient;

use Mkinternet\Crm\Models\Settings;
use Mkinternet\Crm\Models\Klienci as KlienciModel;


class Klienci extends Controller
{
    public $implement = [        
		'Backend\Behaviors\ListController',        
		'Backend\Behaviors\FormController',        
		'Backend\Behaviors\RelationController',	
        //'Backend\Behaviors\ImportExportController',		
	];
    
	
    public $listConfig = [
        'klienci_wszyscy' => 'config_list.yaml',
        'klienci_hosting' => 'config_list_hosting.yaml',
    ];	
		
	
    
    public $formConfig = 'config_form.yaml';
	public $relationConfig = 'config_relation.yaml';


    public function __construct()
    {
        parent::__construct();
        //BackendMenu::setContext('Mkinternet.Klienci', 'main-menu-item');
		//BackendMenu::setContext('Mkinternet.Crm', 'crm', 'klienci');
    }
	
	
	public function update($recordId, $context = null)
	{
		
		$this->vars['id'] = $recordId;

	
		return $this->asExtension('FormController')->update($recordId, $context);
	}		
	
	
	public function wyslijsms($id){
		
		
		$klient = KlienciModel::find($id);
		
		$this->vars['klient'] = $klient;


	}
	
	public function onWyslijsms(){
		
		$dane = post();
		
		$klient = KlienciModel::find($dane['klient_id']);
		
		if($klient->telefon == ''){
			Flash::error('Ustaw numer telefonu dla klienta');					
		}else{
			
			$smsapisettings = Settings::get('smsapi');
			
			$smsapiclient = new SmsapiHttpClient();
			
			$sms = SendSmsBag::withMessage($klient->telefon, $dane['tresc']);
			$sms->from = 'MK Internet';		

			$smsapi = $smsapiclient->smsapiPlService($smsapisettings['token'])->smsFeature()->sendSms($sms);

			$zdarzenie = new \Mkinternet\Crm\Models\Zdarzenia;

			$zdarzenie->klienci_id = $klient->id;
			$zdarzenie->nazwa = 'SMS do klienta';
			$zdarzenie->opis = $dane['tresc'];
			
			$zdarzenie->save();			
			
			Flash::success('SMS zostsał wysłany do '.$klient->firma);		
			
			return Redirect::to(Backend::url("mkinternet/crm/klienci/"));
			
		}
	
		
	}
	
}
