<?php namespace Mkinternet\Crm\Widgets;

use Backend\Classes\WidgetBase;

class Sumafaktur extends WidgetBase
{
    /**
     * @var string A unique alias to identify this widget.
     */
    protected $defaultAlias = 'Sumafaktur';

    
	public function render()
	{
		if(empty($this->vars['sumanetto'])) $this->vars['sumanetto'] = 0;

		return $this->makePartial('Sumafaktur');
	}	
	
	public function refresh($val)
	{
		//$this->vars['sumanetto'] = 'value';

		//return $this->makePartial('Sumafaktur', ['sumanetto']);
	}		
	
	
}