<?php
defined('_JEXEC') or die('Restricted access');
 
class StageViewOffres extends JViewLegacy
{
	function display($tpl = null) 
	{
		// récupère la liste des items à afficher
		$this->items = $this->get('Items');
		// récupère l'objet jPagination correspondant à la liste
		$this->pagination = $this->get('Pagination');

		// récupère l'état des information de tri des colonnes
		$this->state = $this->get('State');
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn	= $this->escape($this->state->get('list.direction'));			

		// récupère les paramêtres du fichier de configuration config.xml
		$params = JComponentHelper::getParams('com_stage');
		$this->paramDescShow = $params->get('jstage_show_desc', 0);
		$this->paramDescSize = $params->get('jstage_size_desc', 70);
		$this->paramDateFmt = $params->get('jstage_date_fmt', "d F Y");

		// affiche les erreurs éventuellement retournées
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		// ajoute la toolbar contenant les boutons d'actions
		$this->addToolBar();
		// invoque la méthode addSubmenu du fichier de soutien (helper)
		UtilisateurHelper::addSubmenu('offres');
		// prépare et affiche la sidebar à gauche de la liste
		$this->prepareSideBar();
		$this->sidebar = JHtmlSidebar::render();

		// affiche les calques par appel de la méthode display() de la classe parente
		parent::display($tpl);
	}
 
	protected function addToolBar() 
	{
		// affiche le titre de la page
		JToolBarHelper::title(JText::_('COM_STAGE_OPTIONS')." : ".JText::_('COM_STAGE_OFFRES'));
		
		// affiche les boutons d'action
		JToolBarHelper::addNew('offre.add');
		JToolBarHelper::editList('offre.edit');
		JToolBarHelper::deleteList('Etes vous sur ?', 'offres.delete');		
		JToolbarHelper::publish('offres.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('offres.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('offres.archive');
		JToolbarHelper::checkin('offres.checkin');
		JToolbarHelper::trash('offres.trash');
		JToolbarHelper::preferences('com_stage');
	}

	protected function prepareSideBar()
	{
		// definit l'action du formulaire sidebar
		JHtmlSidebar::setAction('index.php?option=com_stage');
		
		// ajoute le filtre standard des statuts dans le bloc des sous-menus
		JHtmlSidebar::addFilter( JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'),
			'value', 'text', $this->state->get('filter.published'),true)
		);

		// ajoute le filtre spécifique pour les etats des offres
		/*$this->etatoffres = $this->get('Etatoffres');
		$options3	= array();
		foreach ($this->etatoffres as $typeoffre) {
			$options3[]	= JHtml::_('select.option', $typeoffre->id,  $typeoffre->typeOffre);
		}
		$this->typeoffre = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_STAGE_ETATOFFRES_SELECT')." -", 'filter_typeoffre',
			JHtml::_('select.options', $this->typeoffre,
			'value', 'text', $this->state->get('filter.typeoffre'))
		);

		// ajoute le filtre spécifique pour les entreprises
		$this->entreprises = $this->get('Entreprises');
		$options3	= array();
		foreach ($this->entreprises as $entreprise) {
			$options3[]	= JHtml::_('select.option', $entreprise->id,  $entreprise->nom);
		}
		$this->entreprise = $options3;
		JHtmlSidebar::addFilter("- ".JText::_('COM_STAGE_ENTREPRISES_SELECT')." -", 'filter_entreprise',
			JHtml::_('select.options', $this->entreprise,
			'value', 'text', $this->state->get('filter.entreprise'))
		
		);
		*/
	}

 	protected function getSortFields()
	{
		// prépare l'affichage des colonnes de tri du calque
		return array(
			'o.titre' => JText::_('COM_STAGE_OFFRES_TITRE'),
			'o.description' => JText::_('COM_STAGE_OFFRES_DESCRIPTION'),
			'c.published' => JText::_('JSTATUS'),
			'c.modified' => JText::_('JDATE'),
			'o.id' => "Id"
		);
	}  
	
}
