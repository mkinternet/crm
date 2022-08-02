<?php namespace Mkinternet\Crm\Reportwidgets;

use Backend\Classes\ReportWidgetBase;

class Sumafaktur extends ReportWidgetBase
{
    public function render($obj = null)
    {
		//dd($obj);
		
		
		$faktury = \Mkinternet\Crm\Models\Faktury::
			whereRaw('YEAR(datawystawienia)='.date('Y'))
			->whereRaw('MONTH(datawystawienia)='.date('m'))
			->get();
		
		
		
	
		
		$this->vars['masprzedaznetto'] = 0;
		$this->vars['masprzedazvat'] = 0;
		
		foreach($faktury as $faktura){
			$this->vars['masprzedaznetto'] += $faktura->getWartoscNetto($faktura->id);	
			$this->vars['masprzedazvat'] += $faktura->getWartoscVat($faktura->id);	
		}

		$miesiacpoprzedni = date('m')-1;
		if($miesiacpoprzedni==0) $miesiacpoprzedni = 12;

		$fakturymp = \Mkinternet\Crm\Models\Faktury::
			whereRaw('YEAR(datawystawienia)='.(date('Y')-1))
			->whereRaw('MONTH(datawystawienia)='.$miesiacpoprzedni)
			->get();
		
	
		$this->vars['mpsprzedaznetto'] = 0;
		$this->vars['mpsprzedazvat'] = 0;
		
		foreach($fakturymp as $faktura){
			$this->vars['mpsprzedaznetto'] += $faktura->getWartoscNetto($faktura->id);	
			$this->vars['mpsprzedazvat'] += $faktura->getWartoscVat($faktura->id);	
		}


		
		//dd($wartoscnetto);
		
		
		
		//dd($filters);
		
        return $this->makePartial('widget');
    }
	

	
	function getCurrentFilters()
	{
		$filters = [];
		foreach (\Session::get('widget', []) as $name => $item) {
			if (str_contains($name, 'Filter')) {
				$filter = @unserialize(@base64_decode($item));
				if ($filter) {
					$filters[] = $filter;
				}
			}
		}

		return $filters;
	}	
	
}
