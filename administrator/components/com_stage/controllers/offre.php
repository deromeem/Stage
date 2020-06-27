<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerOffre extends JControllerForm
{
	function display($cachable = false, $urlparams = false) 
	{
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'offre'));

		parent::display($cachable, $urlparams);
	}
}
