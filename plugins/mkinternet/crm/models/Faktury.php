<?php namespace Mkinternet\Crm\Models;

use Model;
use Mkinternet\Crm\Models\Klienci;
use Mkinternet\Crm\Models\Uslugi;
use Responsiv\Currency\Facades\Currency as CurrencyHelper;
use DB;


/**
 * Model
 */
class Faktury extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'mkinternet_crm_faktury';

    /**
     * @var array Validation rules
     */
	public $rules = [
		 'platnosc_id'    => 'required',
		 'klienci_id'	=> 'required',
	];
	
    public $belongsTo = [
		'klienci' =>          'Mkinternet\Crm\Models\Klienci',
		'platnosc' =>          'Mkinternet\Crm\Models\Platnosc',
    ];	

    public $hasMany = [
		'uslugi' =>          [\MKinternet\Crm\Models\Uslugi::class],
    ];	
	
	
    public function getKlienciIdOptions()
    {
		$slo = Klienci::where('aktywny','1')->orderBy('firma')->lists('firma','id');
		
		return $slo;
   
    }  	
	
	/*
    public function filterFields($fields, $context = null)
    {
        if ($this->product) {
            $fields->price->value = $this->product->price;
        }
		
		
		dd($fields);
    }
	*/
	
    public function getPlatnoscIdOptions()
    {
		$slo = \Mkinternet\Crm\Models\Platnosc::orderBy('id')->lists('nazwa','id');
		
		return $slo;
    
    }   


    public function scopeKlienciFiltr($query, $val)
    {
		$klienciid = Klienci::where('firma','LIKE','%'.$val.'%')
			->orWhere('adresemail','LIKE','%'.$val.'%')
			->orWhere('stronawww','LIKE','%'.$val.'%')
			->lists('id');
		
        return $query->whereIn('klienci_id', $klienciid);
    }	
	
	
    public function scopeUslugiFiltr($query, $val)
    {
		$id = Uslugi::where('nazwa','LIKE','%'.$val.'%')->orWhere('opis','LIKE','%'.$val.'%')->lists('faktury_id');
		
        return $query->whereIn('id', $id);
    }		
	
	
	
    public function getWartoscNettoAttribute() {
		
        return $this->getWartoscNetto($this->id);
    }

    public function getWartoscNetto($id) {
		
		$suma = Uslugi::where('faktury_id','=',$id)->sum('cena');
		
        return $suma;
    }
	
	
    public function beforeSave()
    {
		
		//dd($this);
		
		//dd($this->zaplacona);
		
		foreach($this->uslugi as $usluga){
			
			//dd($usluga);
			
			$usluga->zaplacona = $this->zaplacona;
			$usluga->save();
			
		}
		
		
		
        if (empty($this->numer)) {
        
			$fakturaost = \MKinternet\Crm\Models\Faktury::orderBy('id', 'desc')->latest()
					->first();
			
			if(empty($fakturaost))
				$this->numer = '001/'.date('y');
			else
			{
				$numer = explode("/", $fakturaost->numer);
			
				$numer[0] = intVal($numer[0]);
				
				$this->numer = str_pad($numer[0]+1, 3, '0', STR_PAD_LEFT).'/'.date('y');
			}
		
        }	


		
		
		
    }	
	
    public function getFirmanazwaAttribute() {
		
		$firmanazwa = ($this->klienci->nazwakrotka!='') ? $this->klienci->nazwakrotka : $this->klienci->firma;
		
        return $firmanazwa;
		
    }	
	
	

    public function getWartoscVatAttribute() {
		
        return $this->getWartoscVat($this->id);
    }
	
    public function getWartoscVat($id) {
		
		$uslugi = Uslugi::where('faktury_id','=',$id)->get();
		$wartoscvat = 0;
		
		foreach($uslugi as $usluga)
		{
			$wartoscvat += $usluga->cena*$usluga->vat->wartosc/100;
		}
		
        return $wartoscvat;
    }	
	

	
    public function getWartoscBruttoAttribute() {
		
		return self::getWartoscBrutto($this->id);
    }
	
    public static function getWartoscBrutto($id) {
		
		$uslugi = Uslugi::where('faktury_id','=',$id)->get();
		$wartoscbrutto = 0;
		
		foreach($uslugi as $usluga)
		{
			$wartoscbrutto += $usluga->cena + $usluga->cena*$usluga->vat->wartosc/100;
		}
		
        return $wartoscbrutto;
    }	
	
}
