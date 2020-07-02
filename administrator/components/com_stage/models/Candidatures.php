<?php
defined('_JEXEC') or die('Restricted access');

class StageModelCandidatures extends JModelList
{
	public function __construct($config = array())
	{
		// précise les colonnes activant le tri
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'c.id',
				'motivation', 'c.motivation',
				'url_cv', 'c.url_cv',
                'url_lettre', 'c.url_lettre',
                'etat_candidatures_id', 'c.etat_candidatures_id',
                'etudiants_id', 'c.etudiants_id',
                'offres_id', 'c.offres_id',
				'published', 'c.published',
				'hits', 'c.hits',
				'modified', 'c.modified'
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
		parent::populateState('c.motivation', 'ASC');
	}
	
	protected function getListQuery()
	{
		// construit la requête d'affichage de la liste
		$query = $this->_db->getQuery(true);
		$query->select('c.id, c.motivation, c.url_cv, c.url_lettre, c.published, c.hits, c.modified');
		$query->from('#__stage_candidatures c');

		// joint la table _users de Joomla
        // $query->select('ul.name AS linked_user')->join('LEFT', '#__users AS ul ON ul.id=a.affected_to');
        
        // joint la table _etat_candidatures de Joomla
		$query->select('ec.etat AS etat')->join('LEFT', '#__stage_etat_candidatures AS ec ON ec.id=c.etat_candidatures_id');

		// filtre de recherche rapide textuelle
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			// recherche prefixée par 'id:'
			if (stripos($search, 'id:') === 0) {
				$query->where('c.id = '.(int) substr($search, 3));
			}
			else {
				// recherche textuelle classique (sans préfixe)
				$search = $this->_db->Quote('%'.$this->_db->escape($search, true).'%');
				// Compile les clauses de recherche
				$searches	= array();
				$searches[]	= 'c.motivation LIKE '.$search;
				$searches[]	= 'c.url_cv LIKE '.$search;
				$searches[]	= 'c.url_lettre LIKE '.$search;
				// Ajoute les clauses à la requête
				$query->where('('.implode(' OR ', $searches).')');
			}
		}

		// tri des colonnes
		$orderCol = $this->state->get('list.ordering', 'c.motivation');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($this->_db->escape($orderCol.' '.$orderDirn));

	    // echo nl2br(str_replace('#__','stage_',$query));			// TEST/DEBUG
		return $query;
	}
}
