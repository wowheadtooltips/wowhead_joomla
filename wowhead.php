<?php
/**
* PLUGIN: Wowhead Tooltip BBCode Parser
* TYPE: Content
* AUTHOR: Adam Koch
* DATE CREATED: 2009-02-09
* COPYRIGHT: Copyright (C) 2009 Adam K. All rights reserved.
* LICENSE: GNU General Public License
* AUTHOR EMAIL: tooltips@crackpot.ws
* AUTHOR URL: wowhead.crackpot.ws
* VERSION: 1.0.1
* DESCRIPTION: The plugin is designed to install a BBCode parser to Joomla.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

//$mainframe->registerEvent( 'onPrepareContent', 'plgContentWowhead' );

class plgSystemWowhead extends JPlugin
{
	// add the JS and CSS file to the header
	function onPrepareContent(&$article)
	{
		global $mainframe;

		$document = &JFactory::getDocument();

		// add wowhead's javascript for the tooltips
		$document->addScript("http://static.wowhead.com/widgets/power.js" );

		// add our stylesheet for links
		$document->addStyleSheet('plugins/system/wowhead/css/wowheadtooltips.css');

		// add armory javascript
		$document->addScript('plugins/system/wowhead/js/armory.js.php');
	}

	// parse the text (hopefully, lol)
	function onAfterRender()
	{
		include_once(dirname(__FILE__) . '/wowhead/parse.php');

		$document = &JFactory::getDocument();
		$doctype = $document->getType();

		// make sure its html
		if ($doctype == 'html')
		{
			$body = JResponse::getBody();

			$body = whp_parse($body);
			JResponse::setBody($body);
		}
	}
}

?>
