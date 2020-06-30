<?php
defined('_JEXEC') or die('Restricted access');
 
class StageControllerCandidatures extends JControllerAdmin
{
	// surcharge pour gérer la suppression de candidatures par le modèle adéquat
	public function getModel($name = 'Candidature', $prefix = 'StageModel') 
	{
		// récupère le modèle de détail ($name au sigulier) pour la suppression assistée d'un (des) enregistrement(s)
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
