<?php namespace Mkinternet\Crm\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Renatio\DynamicPDF\Classes\PDF; // import facade
use Mkinternet\Crm\Controllers\Faktury;
use Mkinternet\Crm\Models\Faktury as FakturyModel;
use Request;
use Flash;
use Redirect;
use Responsiv\Currency\Facades\Currency as CurrencyHelper;
use Mail;
use Carbon\Carbon;

use Mkinternet\Crm\Classes\FilterSettings;
use Mkinternet\Crm\Models\Settings;


class Faktury extends Controller
{
    public $implement = [        
		'Backend\Behaviors\ListController',        
		'Backend\Behaviors\FormController',    
		'Backend\Behaviors\RelationController',
	];
    
	
    public $listConfig = [
        'faktury_tenmiesiac' => 'config_list_tenmiesiac.yaml',
        'faktury_wszystkie' => 'config_list.yaml',
        'faktury_popmiesiac' => 'config_list_popmiesiac.yaml',
        'faktury_zalegle' => 'config_list_zalegle.yaml',
        'faktury_niezaplacone' => 'config_list_niezaplacone.yaml',		
    ];		
	
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';


	//public $sumanetto = 12;


    public function __construct()
    {
        parent::__construct();
        //BackendMenu::setContext('Mkinternet.Faktury', 'main-menu-item');
		//BackendMenu::setContext('Mkinternet.Crm', 'crm', 'faktury');
		
		//$Sumaktur = new \Mkinternet\Crm\ReportWidgets\Sumafaktur($this);
		
		
		
	//	$SumaFaktur->alias = 'Sumafaktur';
//		$SumaFaktur->bindToController();		
		
    }
	
	
	public function listExtendQuery($query)
	{
		$query->with(['klienci']);
	}
	
	
	public function index()
	{

		$this->vars['sumanetto'] = 0;
		$this->vars['sumavat'] = 0;
		$this->vars['sumabrutto'] = 0;

		
		$this->asExtension('ListController')->index();
	}	
	




	
	/*
	public function update($recordId, $context = null)
	{
		//dd($context);
		
		return $this->asExtension('FormController')->update($recordId, $context);
	}
*/	
	
	public function listExtendRecords($records)
	{
		
		
		$this->vars['sumanetto'] = 0;
		$this->vars['sumavat'] = 0;
		$this->vars['sumabrutto'] = 0;
		
		foreach($records as $record){
			$this->vars['sumanetto'] += $record->getWartoscNetto($record->id);
			$this->vars['sumavat'] += $record->getWartoscVat($record->id);
			$this->vars['sumabrutto'] += $record->getWartoscBrutto($record->id);
		}
		
		
	}
	

	
	public function pdf($id, $dopliku=false, $duplikat=false)
	{
	
		$danefirmy = Settings::get('firma');
		$logofirmy = Settings::instance()->logo->toArray();
		
		//dd($logofirmy);
	
		
		$faktura = \Mkinternet\Crm\Models\Faktury::find($id);
		
		$faktura->wartoscbrutto = 0;
		$faktura->wartoscnetto = 0;
		$faktura->wartoscvat = 0;
		$waluta = '';
		
		foreach($faktura->uslugi as $usluga)
		{
			
			$usluga->vatkwota = $usluga->cena*$usluga->vat->wartosc/100;
			$usluga->cenabrutto = $usluga->vatkwota+$usluga->cena;
			
			$faktura->wartoscnetto += $usluga->cena;
			
			$usluga->cena = CurrencyHelper::format($usluga->cena, ['format' => $usluga->waluta]);
			
			$faktura->wartoscvat += $usluga->vatkwota;
			
			$usluga->vatkwota = CurrencyHelper::format($usluga->vatkwota, ['format' => $usluga->waluta]);
			
			$faktura->wartoscbrutto += $usluga->cenabrutto;
			
			$usluga->cenabrutto = CurrencyHelper::format($usluga->cenabrutto, ['format' => $usluga->waluta]);
			
			if($usluga->wygasa!='') $faktura->uwagi  = 'usługa wygasa '.Carbon::parse($usluga->wygasa)->format('d-m-Y'); 
			
			$waluta = $usluga->waluta;
			
		}
		
		//dd($faktura->platnosc);
		
		$faktura->slownie = \MKinternet\Crm\Classes\Slownie::pokaz($faktura->wartoscbrutto);
		
		$faktura->wartoscbruttow = CurrencyHelper::format($faktura->wartoscbrutto, ['format' => $waluta]);
		$faktura->wartoscnettow = CurrencyHelper::format($faktura->wartoscnetto, ['format' => $waluta]);
		$faktura->wartoscvatw = CurrencyHelper::format($faktura->wartoscvat, ['format' => $waluta]);
		
		$faktura->datawystawienia = Carbon::parse($faktura->datawystawienia)->format('d-m-Y');
		$faktura->datasprzedazy = Carbon::parse($faktura->datasprzedazy)->format('d-m-Y');
		$faktura->terminplatnosci = Carbon::parse($faktura->terminplatnosci)->format('d-m-Y');
		
		$faktura->datadzis = Carbon::now()->format('d-m-Y');
		$faktura->duplikat = $duplikat;

		
		//dd($faktura);
		
		$templateCode = 'mkinternet::faktura'; // unique code of the template
		$data = [
			'faktura' => $faktura,
			'platnosc' => $faktura->platnosc,
			'firma' => $danefirmy,
			'background_img' => $logofirmy['path']
		]; 

		if($dopliku)
			PDF::loadTemplate($templateCode, $data)->save('faktura.pdf')->stream();	
		
		else
			return PDF::loadTemplate($templateCode, $data)->stream('faktura.pdf');
	}


	public function onDrukujFaktura()
	{
		set_time_limit(0);
		
		$fakturyid = Request::input('checked');
		
		$faktury = \Mkinternet\Crm\Models\Faktury::whereIn('id', $fakturyid)->get();
		
		$logofirmy = Settings::instance()->logo->toArray();
		
		
		foreach($faktury as $faktura){
		
			$faktura->wartoscbrutto = 0;
			$faktura->wartoscnetto = 0;
			$faktura->wartoscvat = 0;
			$waluta = '';
			
			foreach($faktura->uslugi as $usluga)
			{
				
				$usluga->vatkwota = $usluga->cena*$usluga->vat->wartosc/100;
				$usluga->cenabrutto = $usluga->vatkwota+$usluga->cena;
				
				$faktura->wartoscnetto += $usluga->cena;
				
				$usluga->cena = CurrencyHelper::format($usluga->cena, ['format' => $usluga->waluta]);
				
				$faktura->wartoscvat += $usluga->vatkwota;
				
				$usluga->vatkwota = CurrencyHelper::format($usluga->vatkwota, ['format' => $usluga->waluta]);
				
				$faktura->wartoscbrutto += $usluga->cenabrutto;
				
				$usluga->cenabrutto = CurrencyHelper::format($usluga->cenabrutto, ['format' => $usluga->waluta]);
				
				if($usluga->wygasa!='') $faktura->uwagi  = 'usługa wygasa '.Carbon::parse($usluga->wygasa)->format('d-m-Y'); 
				
				$waluta = $usluga->waluta;
				
			}
			
			//dd($faktura->platnosc);
			
			$faktura->slownie = \MKinternet\Crm\Classes\Slownie::pokaz($faktura->wartoscbrutto);
			
			$faktura->wartoscbruttow = CurrencyHelper::format($faktura->wartoscbrutto, ['format' => $waluta]);
			$faktura->wartoscnettow = CurrencyHelper::format($faktura->wartoscnetto, ['format' => $waluta]);
			$faktura->wartoscvatw = CurrencyHelper::format($faktura->wartoscvat, ['format' => $waluta]);
			
			$faktura->datawystawienia = Carbon::parse($faktura->datawystawienia)->format('d-m-Y');
			$faktura->datasprzedazy = Carbon::parse($faktura->datasprzedazy)->format('d-m-Y');
			$faktura->terminplatnosci = Carbon::parse($faktura->terminplatnosci)->format('d-m-Y');
			
			$faktura->datadzis = Carbon::now()->format('d-m-Y');
		}
		
		//dd($faktury);
		
		$templateCode = 'mkinternet::lista-faktur'; // unique code of the template
		$data = [
			'faktury' => $faktury,
			'background_img' => $logofirmy['path']
		]; 


		\Storage::put(
			'faktury-lista.pdf',
			PDF::loadTemplate($templateCode, $data)->stream()
		);		
		
		return \Redirect::to(\Backend::url('mkinternet/crm/faktury/fakturylista'));
		
	}
	
	public function fakturylista(){
		
		$contents = \Storage::get('faktury-lista.pdf');
		
		return \Response::make($contents)->header('Content-Type', 'application/pdf');
		
	}
	
	
	

	public function onWyslijFaktura()
	{
		set_time_limit(0);
		
		$fakturyid = Request::input('checked');
		$dolaczraport = Request::input('dolaczraport');
		$duplikat = Request::input('duplikat');
		
		
		
		foreach($fakturyid as $fakturaid){
			
			
			$faktura = FakturyModel::where('id','=',$fakturaid)->get()->first();
			$faktura = FakturyModel::find($fakturaid);
			
			
			$szablon = 'fakturapowiadomienie';
			
			
			if($faktura->terminplatnosci<Carbon::now()->toDateString() && $faktura->zaplacona==0)
			{
				$szablon = 'fakturanieoplaconapowiadomienie';
			}
			
			
			$faktura->wartosc = FakturyModel::getWartoscBrutto($faktura->id);
			
			$zdarzenie = new \Mkinternet\Crm\Models\Zdarzenia;
			$zdarzenie->klienci_id = $faktura->klienci_id;
			
			if($faktura->terminplatnosci<Carbon::now()->toDateString() && $faktura->zaplacona==0)
			{
				$zdarzenie->nazwa = 'Przypomnienie o nieuregulowanej fakturze '.$faktura->numer;
			}else{
				$zdarzenie->nazwa = 'Wysłanie faktury do klienta '.$faktura->numer;
			}
			
			
			$zdarzenie->save();			
			
			
			Mail::send('mkinternet.crm::emails.'.$szablon, $faktura->toArray(), function($message) use($faktura, $dolaczraport, $duplikat) {

				$this->pdf($faktura->id, true, $duplikat);
				
				$message->attach('faktura.pdf', ['as' => 'faktura-'.$faktura->id.'.pdf', 'mime' => 'pdf']);

				if($dolaczraport==1){
				
					$data = [
						'usluga' => $faktura->uslugi[0],
						'faktura' => $faktura,
					]; 

					PDF::loadTemplate('mkinternet::faktura-raport', $data)->save('faktura-raport.pdf')->stream();
				
					$message->attach('faktura-raport.pdf', ['as' => 'faktura-'.$faktura->id.'-raport.pdf', 'mime' => 'pdf']);
				
				}

				$message->to($faktura->klienci->adresemail, $faktura->klienci->firma);

			});        
			
		}
		
		

		Flash::success('Faktury zostały wysłane');
	
	}


	public function onWyslijFakturaKsiegowa()
	{
		set_time_limit(0);
		
		$fakturyid = Request::input('checked');
		
		$ksiegowaemail = Settings::get('ksiegowaemail');
		
		foreach($fakturyid as $fakturaid){
			
			
			$faktura = FakturyModel::find($fakturaid);
			
			$szablon = 'fakturapowiadomienie';
			
			$faktura->wartosc = FakturyModel::getWartoscBrutto($faktura->id);
			
			
			Mail::send('mkinternet.crm::emails.'.$szablon, $faktura->toArray(), function($message) use($faktura, $ksiegowaemail) {

				$this->pdf($faktura->id, true);
				
				$message->attach('faktura.pdf', ['as' => 'faktura-'.$faktura->id.'.pdf', 'mime' => 'pdf']);

				$message->to($ksiegowaemail, '');

			});        
			
		}
		
		

		Flash::success('Faktury zostały wysłane');
	
	}


	/*
		tworzy fakture na podstawie uslugi
	*/

	public function usluga($id){
		
		$usluga = \Mkinternet\Crm\Models\Uslugi::find($id);
		
		if($usluga->faktury_id==0){
			
			$data = new \Mkinternet\Crm\Models\Faktury;
			$data->klienci_id = $usluga->klienci_id;
			$data->datawystawienia = Carbon::now()->toDateString();
			$data->datasprzedazy = Carbon::now()->toDateString();
			$data->terminplatnosci = Carbon::now()->addDays(14)->toDateTimeString();
			$data->platnosc_id = 1;
			
			$data->save();
			
			$usluga->faktury_id = $data->id;
			
			$usluga->save();
			
			return Redirect::to("backend/mkinternet/crm/faktury/update/".$data->id);
		}else{
			return Redirect::to("backend/mkinternet/crm/faktury/update/".$usluga->faktury_id);
		}

		
	}
	
	

}


