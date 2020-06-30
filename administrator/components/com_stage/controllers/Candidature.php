<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerCandidature extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'candidature'));

		parent::display($cachable, $urlparams);
	}
}
