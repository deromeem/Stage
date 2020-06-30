<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerEtatCandidature extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'etatcandidature'));

		parent::display($cachable, $urlparams);
	}
}