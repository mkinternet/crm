<?php namespace Mkinternet\Crm\Models;

use Model;
use Mkinternet\Crm\Models\Klienci;
use Responsiv\Currency\Models;
use Responsiv\Currency\Facades\Currency as CurrencyHelper;
use October\Rain\Database\Traits\Validation;

/**
 * Model
 */
class Uslugi extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    public $belongsTo = [
		'klienci' =>          'Mkinternet\Crm\Models\Klienci',
		'vat' =>          'Mkinternet\Crm\Models\Vat',
		'faktury' =>          'Mkinternet\Crm\Models\Faktury',
		'uslugistatus' =>          'Mkinternet\Crm\Models\Uslugistatus',
    ];



    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_uslugi';

    /**
     * @var array Validation rules
     */
	public $rules = [
		 'klienci'    => 'required',
		 'nazwa'	=> 'required',
		 'vat_id'	=> 'required',
	];




	
    public function getKlienciIdOptions()
    {
		$slo = \Mkinternet\Crm\Models\Klienci::where('aktywny','1')->orderBy('firma')->lists('firma','id');
		
		return $slo;
   
    }    	

    public function getUslugistatusIdOptions()
    {
		$slo = \Mkinternet\Crm\Models\Uslugistatus::orderBy('id')->lists('nazwa','id');
		
		return $slo;
   
    }   
	
	
	
    public function getVatIdOptions()
    {
		$slo = \Mkinternet\Crm\Models\Vat::orderBy('id')->lists('nazwa','id');
		
		return $slo;
    
    }   


    public function getWalutaOptions()
    {
		
		
		//$slo = \Responsiv\Currency\Models\Currency::get();
		$slo = \Responsiv\Currency\Models\Currency::orderBy('is_primary', 'desc')->lists('currency_symbol','currency_code');

		//dd($slo);

		
		return $slo;
    
    }  
	
	
	public function beforeSave(){
		
		if($this->uslugistatus_id===''){
			$this->uslugistatus_id = null;
		}
			
		
	}



    public function scopeKlienciFiltr($query, $val)
    {
		$klienciid = \Mkinternet\Crm\Models\Klienci::where('firma','LIKE','%'.$val.'%')
			->orWhere('adresemail','LIKE','%'.$val.'%')
			->orWhere('stronawww','LIKE','%'.$val.'%')
			->lists('id');
		
        return $query->whereIn('klienci_id', $klienciid);
    }	

    public function scopeUslugiFiltr($query, $val)
    {
		$id = Uslugi::where('nazwa','LIKE','%'.$val.'%')->orWhere('opis','LIKE','%'.$val.'%')->lists('id');
		
        return $query->whereIn('id', $id);
    }	

	
	
    public function getFirmanazwaAttribute() {
		
		$firmanazwa = ($this->klienci->nazwakrotka!='') ? $this->klienci->nazwakrotka : $this->klienci->firma;
		
        return $firmanazwa;
		
    }	
	
	
    public function getCenaNettoWalutaAttribute() {
		
        return CurrencyHelper::format($this->cena, ['format' => $this->waluta]);
    }
	
}
