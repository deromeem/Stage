<?php
defined('_JEXEC') or die('Restricted access');

class StageModelOffres extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'o.id',
				'titre', 'o.titre',
				'description', 'o.description',
				'published', 'o.published',
				'hits', 'o.hits',
				'modified', 'o.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session offre nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// parent::populateState('modified', 'desc');
		parent::populateState('o.titre', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('o.id, o.titre, o.description, o.published, o.hits, o.modified');
		$query->from('#__stage_offres o');

		// joint la table _users de Joomla
		$query->select('e.etat AS etat')->join('LEFT', '#__stage_etat_offres AS e ON o.etat_offres_id=e.id');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('o.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'o.titre LIKE '.$search;
				$searches[]	= 'o.description LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'o.titre');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

<<<<<<< HEAD
		echo nl2br(str_replace('#__','stage_',$query));			// TEST/DEBUG
=======
		//echo nl2br(str_replace('#__','stage_',$query));			// TEST/DEBUG
>>>>>>> 0069969ceafeeb593f685c8b22e015df958f09c5
		return $query;
	}
}
