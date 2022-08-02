<?php namespace Mkinternet\Newsletter;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
	

    public function registerMailTemplates()
    {
        return [
            'mkinternet.newsletter::emails.campagin' => 'Szablon newsletter',
        ];
    }	

	public function registerNavigation()
		{
			return [
				'newsletter' => [
					'label'       => 'Newsletter',
					'url'         => Backend::url('mkinternet/newsletter/subscriber'),
					'icon'        => 'icon-table',
					'order'       => 520,

					'sideMenu' => [

						'campagin' => [
							'label'       => 'Kampanie',
							'icon'        => 'icon-file-text-o',
							'url'         => Backend::url('mkinternet/newsletter/campagin'),
						],					
					
						'subscriber' => [
							'label'       => 'Subskrybenci',
							'icon'        => 'icon-address-book',
							'url'         => Backend::url('mkinternet/newsletter/subscriber'),
						],
						'mailinglist' => [
							'label'       => 'Listy',
							'icon'        => 'icon-file-text-o',
							'url'         => Backend::url('mkinternet/newsletter/mailinglist'),
						],
						

						
					]
				]
			];
		}		
	
}
