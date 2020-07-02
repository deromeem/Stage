<?php
defined('_JEXEC') or die('Restricted access');
 
class StageModelOffre extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_stage.offre';

	protected function populateState()
	{
		$app = JFactory::getApplication('site');
		
		// Charge et mémorise l'état (state) de l'id depuis le contexte
		$pk = $app->input->getInt('id');
		$this->setState($this->_context.'.id', $pk);
		// $this->setState('contact.id', $pk);
	}

	public function getItem($pk = null)
	{
		// Initialise l'id
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->_context.'.id');

		// Si pas de données chargées pour cet id
		if (!isset($this->_item[$pk])) {
			$db = $this->getDbo();
			$query = $db->getQuery(true);
			$query->select('o.id, o.titre, o.description, o.date_debut, o.date_fin');
			$query->from('#__stage_offres AS o');


			// joint la table d'etat d'offre
			$query->select('e.etat AS etat')->join('LEFT', '#__stage_etat_offres AS e ON o.etat_offres_id=e.id');		
			
			// joint la table utilisateur
			$query->select('u.nom AS utilisateur')->join('LEFT', '#__stage_utilisateurs AS u ON o.utilisateurs_id=u.id');

			$query->where('o.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
