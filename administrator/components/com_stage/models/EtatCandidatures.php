<?php
defined('_JEXEC') or die('Restricted access');

class StageModelEtatCandidatures extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'e.id',
				'etatcandidature', 'e.etatcandidature',
				'published', 'e.published',
				'hits', 'e.hits',
				'modified', 'e.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session utilisateur nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// parent::populateState('modified', 'desc');
		parent::populateState('e.motivation', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('e.id, e.etatcandidature, e.published, e.hits, e.modified');
		$query->from('#__stage_etatcandidatures e');

		// joint la table _users de Joomla
		// $query->select('ul.name AS linked_user')->join('LEFT', '#__users AS ul ON ul.id=a.affected_to');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('u.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'u.nom LIKE '.$search;
				$searches[]	= 'u.prenom LIKE '.$search;
				$searches[]	= 'u.email LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'u.nom');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','stage_',$query));			// TEST/DEBUG
		return $query;
	}
}
