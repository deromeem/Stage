<?php
defined('_JEXEC') or die('Restricted access');
 
class StageController extends JControllerLegacy
{
	function display($cachable = false, $urlparams = false) 
	{
		require_once JPATH_COMPONENT.'/helpers/utilisateur.php';

		// affectation de la vue récupérée en paramètre
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Utilisateurs'));

		parent::display($cachable, $urlparams);		
		return $this;
	}
}
