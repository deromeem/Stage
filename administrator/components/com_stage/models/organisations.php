<?php
defined('_JEXEC') or die('Restricted access');

class StageModelOrganisations extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'orga.id',
				'nom', 'orga.nom',
				'activite', 'orga.activite',
				'adr_rue', 'orga.adr_rue',
				'adr_cp', 'orga.adr_cp',
				'adr_ville', 'orga.adr_ville',
				'published', 'orga.published',
				'hits', 'orga.hits',
				'modified', 'orga.modified'
			);
		}
		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		// récupère les informations de la session organisation nécessaires au paramétrage de l'écran
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// parent::populateState('modified', 'desc');
		parent::populateState('orga.nom', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('orga.id, orga.nom, orga.activite, orga.adr_rue, orga.adr_cp, orga.adr_ville, orga.published, orga.hits, orga.modified');
		$query->from('#__stage_organisations orga');

		// joint la table _users de Joomla
		// $query->select('ul.name AS linked_user')->join('LEFT', '#__users AS ul ON ul.id=a.affected_to');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('orga.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'orga.nom LIKE '.$search;
				$searches[]	= 'orga.activite LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'orga.nom');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','stage_',$query));			// TEST/DEBUG
		return $query;
	}
}
