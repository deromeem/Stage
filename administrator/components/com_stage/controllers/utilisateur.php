<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerUtilisateur extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'utilisateur'));

		parent::display($cachable, $urlparams);
	}
}
