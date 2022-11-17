<?php namespace Mkinternet\Crm;

use System\Classes\PluginBase;
use Backend;
use Event;
use Carbon\Carbon;

class Plugin extends PluginBase
{
    public $require = [
        'Responsiv.Currency',
		'Renatio.DynamicPDF'
    ];	
	
	
    public function registerComponents()
    {
    }

	
    public function registerMailTemplates()
    {
        return [
            'mkinternet.crm::emails.fakturapowiadomienie' => 'Powiadomienie o nowej fakturze',
			'mkinternet.crm::emails.fakturanieoplaconapowiadomienie' => 'Powiadomienie nieopłaconej fakturze',
			'mkinternet.crm::emails.uslugapowiadomienie' => 'Powiadomienie o wygasającej usłudze',
        ];
    }	
	
	public function registerSettings()
	{
		return [
			'location' => [
				'label'       => 'CRM',
				'description' => 'Ustawienia crm.',
				'category'    => 'CRM',
				'icon'        => 'icon-globe',
				'class'       => 'Mkinternet\Crm\Models\Settings',
				'order'       => 500,
				'keywords'    => 'crm'
			]
		];
	}	
	
	
	public function registerReportWidgets()
	{
		return [
				'Mkinternet\Crm\ReportWidgets\Sumafaktur' => [
					'label'       => 'Suma faktur',
					'context'     => 'dashboard',
				],
				'Mkinternet\Crm\ReportWidgets\Zdarzenie' => [
				'label'   => 'Zdarzenia',
				'context' => 'dashboard',
				
				],				
		];
	}	
	
	

	
	 public function registerNavigation()
		{
			return [
				'crm' => [
					'label'       => 'Crm',
					'url'         => Backend::url('mkinternet/crm/klienci'),
					'icon'        => 'icon-table',
					'order'       => 520,

					'sideMenu' => [
						'klienci' => [
							'label'       => 'Klienci',
							'icon'        => 'icon-address-book',
							'url'         => Backend::url('mkinternet/crm/klienci'),
						],
						'faktury' => [
							'label'       => 'Faktury',
							'icon'        => 'icon-file-text-o',
							'url'         => Backend::url('mkinternet/crm/faktury'),
						],
						'uslugi' => [
							'label'       => 'Usługi',
							'icon'        => 'icon-bars',
							'url'         => Backend::url('mkinternet/crm/uslugi'),
						],	
						'zdarzenia' => [
							'label'       => 'Zdarzenia',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/zdarzenia'),
						],	
						
						'vat' => [
							'label'       => 'Stawki Vat',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/vat'),
						],
						'uslugistatus' => [
							'label'       => 'Usługi status',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/uslugistatus'),
						],
						'platnosc' => [
							'label'       => 'Płatności',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/platnosc'),
						],							
					
						'tagi' => [
							'label'       => 'Tagi',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/tagi'),
						],	
						'hosting' => [
							'label'       => 'Hosting cennik',
							'icon'        => 'icon-table',
							'url'         => Backend::url('mkinternet/crm/hosting'),
						],	

						
					]
				]
			];
		}	
	
	
    public function registerPermissions()
    {
        return [

            'mkinternet.crm.widgets' => [
                'tab'   => 'Crm',
                'label' => 'Widgety',
                'order' => 200,
                'roles' => ['developer']
            ],
        ];
    }	
	
	
	public function boot(){
		
		Event::listen('backend.filter.extendScopes', function ($widget) {


			if ((  $widget->getController() instanceof \Mkinternet\Crm\Controllers\Uslugi)) {
				
				if($widget->alias=='uslugi_tenmiesiacFilter'){

					$widget->addScopes([
						'datadodaniauslugi' => [
							'label' => 'Data dodania',
							'type' => 'daterange',
							'default' => $this->filtrDomyslnaData(),
							'conditions' => "created_at >= ':after' AND created_at <= ':before'"
							],
					   ]);
				}	
				
				if($widget->alias=='uslugi_popmiesiacFilter'){

					$widget->addScopes([
						'datadodaniauslugi' => [
							'label' => 'Data dodania',
							'type' => 'daterange',
							'default' => $this->filtrDomyslnaDataPopMiesiac(),
							'conditions' => "created_at >= ':after' AND created_at <= ':before'"
							],
					   ]);
				}				

			}
			   
			   
			if (( $widget->getController() instanceof \Mkinternet\Crm\Controllers\Faktury)) {
				
				
				if($widget->alias=='faktury_tenmiesiacFilter'){
					
					$widget->addScopes([
						'fakturadatawystawienia' => [
							'label' => 'Data wystawienia',
							'type' => 'daterange',
							'default' => $this->filtrDomyslnaData(),
							'conditions' => "datawystawienia >= ':after' AND datawystawienia <= ':before'"
							],
					   ]);	
				}	
				
				if($widget->alias=='faktury_popmiesiacFilter'){
					
					$widget->addScopes([
						'fakturadatawystawienia' => [
							'label' => 'Data wystawienia',
							'type' => 'daterange',
							'default' => $this->filtrDomyslnaDataPopMiesiac(),
							'conditions' => "datawystawienia >= ':after' AND datawystawienia <= ':before'"
							],
					   ]);	
				}
				
			}			   


	   
			   
		});


		Event::listen('backend.list.extendRecords', function ($listWidget, $records) {
			
			//dd($records);
			
			//$model = MyModel::where('always_include', true)->first();
			//$records->prepend($model);
		});		
		
		
	}
	

	
	
    // return value must be instance of carbon
    public function filtrDomyslnaData()
    {
        return [
            0 => Carbon::now()->startOfMonth(),
            1 => Carbon::now(),
        ];
    }		
	
    // return value must be instance of carbon
    public function filtrDomyslnaDataPopMiesiac()
    {
        return [
            0 => Carbon::now()->subMonth(1)->startOfMonth(),
            1 => Carbon::now()->subMonth(1)->endOfMonth(),
        ];
    }	
		
	
	
}
