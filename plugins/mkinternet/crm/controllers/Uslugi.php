<?php namespace Mkinternet\Crm\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Request;
use Mail;
use Flash;
use Responsiv\Currency\Facades\Currency as CurrencyHelper;

use Carbon\Carbon;
use Redirect;
use Mkinternet\Crm\Classes\FilterSettings;

use Mkinternet\Crm\Models\Uslugi as UslugiModel;
use Mkinternet\Crm\Models\Klienci as Klienci;

use Mkinternet\Crm\Models\Settings;

class Uslugi extends Controller
{
    public $implement = [        
	'Backend\Behaviors\ListController',        
	'Backend\Behaviors\FormController'

	];
    
	
    public $listConfig = [
        'uslugi_wszystkie' => 'config_list.yaml',
        'uslugi_tenmiesiac' => 'config_list_tenmiesiac.yaml',
        'uslugi_popmiesiac' => 'config_list_popmiesiac.yaml',
        'uslugi_wrealizacji' => 'config_list_wrealizacji.yaml',
		'uslugi_wygasajace' => 'config_list_wygasajace.yaml',
    ];	
	
    public $formConfig = 'config_form.yaml';


/*

SELECT u.id, u.klienci_id, u.cena, (350-u.cena) as cenarabat, u.wygasa 
FROM (`mkinternet_crm_uslugi` u, `mkinternet_crm_klienci` k )
where not isnull(u.wygasa) 
and u.wygasa>now() and (350-u.cena)>0 
and u.klienci_id=k.id
ORDER BY `cenarabat`  DESC

UPDATE mkinternet_crm_klienci AS k
INNER JOIN (
  SELECT (350-u.cena) as hostingrabat, klienci_id
  FROM mkinternet_crm_uslugi AS u
  WHERE (350-u.cena)>0 and u.wygasa>now() and (350-u.cena)>0 

) AS uslugi ON uslugi.klienci_id = k.id
SET k.hostingrabat = uslugi.hostingrabat

*/


    public function __construct()
    {
        parent::__construct();
		
		//BackendMenu::setContext('Mkinternet.Crm', 'crm', 'uslugi');
    }
	
	
	
	public function listExtendQuery($query)
	{
		$query->with(['klienci']);
	}	
	
	
		public function index()
		{

			
			$this->asExtension('ListController')->index();
		}		
	
	
	public function listExtendRecords($records)
	{
		/*
		$sumanetto = 0;
		
		foreach($records as &$record){
			
			$record->fakturabtnclass = ($record->faktury_id==0) ? '':'hidden';
			$record->wygasabtnclass = ($record->wygasa==null) ? 'hidden':'';
			$record->duplikujbtnclass = ($record->wygasa==null) ? '':'hidden';
		
			$sumanetto += $record->cena;		
		}
		
		$uslugisuma = new UslugiModel;
		$uslugisuma->cena = $sumanetto;
		
		$records[] = $uslugisuma;
		
		//??
		//dd($records);
		
		return $records;
		*/
	}		
	
	

	

	
	
	public function update($recordId, $context = null)
	{
		
		$this->vars['usluga'] = UslugiModel::find($recordId);


		// Call the FormController behavior update() method
		return $this->asExtension('FormController')->update($recordId, $context);
	}
	
    protected function createKlienciFormWidget()
    {

		
        $config = $this->makeConfig('$/mkinternet/crm/models/klienci/fields.yaml');

        $config->alias = 'itemForm';

        $config->arrayName = 'Klienci';

        //$config->model = new Klienci::find(;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);		
		
		$widget->bindToController();

        return $widget;
    }		
	
	public function onDaneKlienta()
	{
        $config = $this->makeConfig('$/mkinternet/crm/models/klienci/fields.yaml');

        $config->model = Klienci::find(post('id'));

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);				
		
		$this->vars['klienciwidget'] = $widget;

		
		return $this->makePartial('klienci_preview');
	}	
	
	public function onWyslijWygasaja()
	{
		$uslugiid = Request::input('checked');
		
		$crm = Settings::get('crm');
		
		//dd($crm);
		
		foreach($uslugiid as $uslugaid){
			
			
			$usluga = \Mkinternet\Crm\Models\Uslugi::find($uslugaid);

/*
			if($usluga->cena==300 && $usluga->id>3766){
				$usluga->cena = 350;
			}
*/	
	
			//dd($usluga);
			$klient = Klienci::find($usluga->klienci_id);
			
			$usluga->vatkwota = $klient->hosting->cena*0.23;
			
			$usluga->cenabrutto = $usluga->vatkwota+$klient->hosting->cena;			

			$usluga->klientrabat = 0;

			if($klient->hostingrabat!=0){
				$usluga->klientrabat = $klient->hostingrabat + $klient->hostingrabat*0.23;
			}

			$usluga->cenabruttorabat = $usluga->cenabrutto - $usluga->klientrabat;			
			
			$usluga->cenabrutto = CurrencyHelper::format($usluga->cenabrutto, ['format' => $usluga->waluta]);
			$usluga->cenabruttorabat = CurrencyHelper::format($usluga->cenabruttorabat, ['format' => $usluga->waluta]);
			$usluga->klientrabat = CurrencyHelper::format($klient->hostingrabat + $klient->hostingrabat*$usluga->vat->wartosc/100);
		
		
			if($crm['emailtest']==''){
				
				$zdarzenie = new \Mkinternet\Crm\Models\Zdarzenia;
				$zdarzenie->klienci_id = $usluga->klienci_id;
				$zdarzenie->nazwa = 'Przypomnienie o wygasającej usłudze #'.$usluga->id.' '.$usluga->nazwa;
				$zdarzenie->save();
			}
			
			
			
			Mail::send('mkinternet.crm::emails.uslugapowiadomienie', $usluga->toArray(), function($message) use($usluga, $crm, $klient){

				if($crm['emailtest']!=''){
					$message->to($crm['emailtest']);
				}else{
					$message->to($klient->adresemail, $klient->firma);					
				}
				

				//$message->to('maniek@polczyn.com');

			});        
			
		}
		

		Flash::success('Powiadomienia zostały wysłane');
	
	}	
	
	
	public function przedluz($id){
		
		
		$usluga = UslugiModel::find($id);
		
		$nowausluga = new UslugiModel;
		$nowausluga->klienci_id = $usluga->klienci_id;
		$nowausluga->cena = $usluga->cena;
		$nowausluga->vat_id = $usluga->vat_id;
		$nowausluga->wygasa = Carbon::parse($usluga->wygasa)->addYear()->toDateTimeString();
		$nowausluga->waluta = $usluga->waluta;
		$nowausluga->nazwa = $usluga->nazwa;
		$nowausluga->save();
		
		$usluga->przedluzona = true;
		$nowauslugaid = $usluga->save();
		
	
		return Redirect::to('backend/mkinternet/crm/uslugi/update/'.$nowausluga->id)->with('message', 'Usługa została przedłużona');
		
	}
	
	public function duplikuj($id){
		
		
		$usluga = UslugiModel::find($id);
		
		$nowausluga = new UslugiModel;
		$nowausluga->klienci_id = $usluga->klienci_id;
		$nowausluga->cena = $usluga->cena;
		$nowausluga->vat_id = $usluga->vat_id;
		$nowausluga->waluta = $usluga->waluta;
		$nowausluga->nazwa = $usluga->nazwa;
		$nowausluga->save();
		
		return Redirect::to('backend/mkinternet/crm/uslugi/update/'.$nowausluga->id)->with('message', 'Usługa została zduplikowana');
		
	}	
	
	
}
