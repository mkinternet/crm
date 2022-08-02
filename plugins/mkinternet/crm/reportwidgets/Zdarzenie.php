<?php namespace Mkinternet\Crm\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Carbon\Carbon;
use BackendAuth;

use Mkinternet\Crm\Models\Zdarzenia AS ZdarzenieModel;

class Zdarzenie extends ReportWidgetBase
{
	
	public function defineProperties()
	{
		return [

			'liczbadni' => [
				'title'             => 'Liczba dni',
				'default'           => '7',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$'
			]
		];
	}
	
	
    public function render()
    {
		$user = BackendAuth::getUser();
		

		
		$this->vars['liczbadni'] = $this->property('liczbadni');
		
		$this->vars['datado'] = Carbon::now()->addDay($this->vars['liczbadni']);
		
		$zdarzenia = ZdarzenieModel::whereNotNull('termin')
			->where('termin','<=',$this->vars['datado'])
			->orderBy('termin','asc')->get();

		
		$this->vars['zdarzenia'] = $zdarzenia;
		
        return $this->makePartial('widget');
    }
}
