<?php namespace Mkinternet\Crm\Classes;

use Session;

class FilterSettings
{

	public static function getCurrentFilterSettings($scopefilter=''){

	$filters = [];
	
	foreach (\Session::get('widget', []) as $name => $item) {
		
		if (str_contains($name, 'Filter')) {
			
			$filter = @unserialize(@base64_decode($item));
			
			//dd($filter);
			
			if ($filter) {
				
				foreach($filter as $k=>$v)
				{
					$k = str_replace('scope-','',$k);
					$filters[$k] = $v;
				}
			}
		}
	}	
	
	
	
	if($scopefilter!='' && array_key_exists($scopefilter, $filters)){
		
		return $filters[$scopefilter];
		
	}else{
	
		return $filters;
	}
}	
}
 
?>
