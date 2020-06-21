<?php
defined('_JEXEC') or die('Restricted access');
 
class StageModelUtilisateur extends JModelItem
{
	protected $_item = null;
	protected $_context = 'com_stage.utilisateur';

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
			$query->select('c.id, c.nom, c.prenom, c.email');
			$query->from('#__stage_utilisateurs AS c');


			// joint la table entreprises
			// $query->select('e.nom AS entreprise')->join('LEFT', '#__stage_entreprises AS e ON e.id=c.entreprises_id');		
					
			$query->where('c.id = ' . (int) $pk);
			$db->setQuery($query);
			$data = $db->loadObject();
			$this->_item[$pk] = $data;
		}
  		return $this->_item[$pk];
	}
}
