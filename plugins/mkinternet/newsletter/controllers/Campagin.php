<?php namespace Mkinternet\Newsletter\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Request;
use Mail;
use Flash;
use Carbon\Carbon;

use Mkinternet\Newsletter\Models\Campagin as Campaginmodel;
use Mkinternet\Newsletter\Models\Mailinglist as Mailinglist;

class Campagin extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
		
		BackendMenu::setContext('Mkinternet.Newsletter', 'newsletter', 'campagin');
		
		
		
    }
	
	
	public function onRunCampagin()
	{
		set_time_limit(0);
		
		$campaginid = Request::input('checked');
		
		$campagin = Campaginmodel::find($campaginid[0]);
		
		$mailinglist = Mailinglist::find($campagin->mailinglist_id);
		
		$subscribers = $mailinglist->subscriber()->get();
		
		$emaildata = [
			'emailcontent' => $campagin->emailcontent,
			'subject' => $campagin->emailtitle
		];
		
		
		foreach($subscribers as $subscriber){
			
			
			Mail::send('mkinternet.newsletter::emails.campagin', $emaildata, function($message) use($subscriber, $campagin) {

				$message->to($subscriber->email);
				$message->subject($campagin->emailtitle);

			});        
			
		}
		
		$campagin->sentdate = Carbon::now();
		$campagin->recievecount = $mailinglist->subscriber()->count();
		$campagin->save();

		Flash::success('emaile zostały wysłane');
	
	}	
	
}
