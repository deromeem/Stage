<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerOrganisation extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'organisation'));

		parent::display($cachable, $urlparams);
	}
}
