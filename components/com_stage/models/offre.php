<?php
defined('_JEXEC') or die('Restricted access');
 
class StageModelUtilisateur extends JModelItem
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
			$query->select('d.id, d.nom, d.prenom, d.email');
			$query->from('#__stage_utilisateurs AS d');


			// joint la table entreprises
			$query->select('d.etat AS etat')->join('LEFT', '#__stage_etat_offres AS d ON b.etat_offres_id=d.id');		
					
			$query->where('d.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
