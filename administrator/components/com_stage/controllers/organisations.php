<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerOrganisations extends JControllerAdmin
{
	// surcharge pour gérer la suppression d'organisations par le modèle adéquat
	public function getModel($name = 'Organisation', $prefix = 'StageModel') 
	{
		// récupère le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}