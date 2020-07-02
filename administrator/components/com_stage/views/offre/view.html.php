<?php
defined('_JEXEC') or die('Restricted access');
 
class StageViewOffre extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;
	
	public function display($tpl = null) 
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		$this->addToolBar();
		parent::display($tpl);
	}

	protected function addToolBar() 
	{			
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		// $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
	
		// affiche le titre de la page
		$isNew = ($this->item->id == 0);
		JToolBarHelper::title(JText::_('COM_STAGE_OFFRE')." : ".($isNew ? JText::_('COM_STAGE_NEW'): JText::_('COM_STAGE_MODIF')), 'address');

		if ($isNew)
		{
			JToolbarHelper::apply('offre.apply');
			JToolbarHelper::save('offre.save');
			JToolbarHelper::save2new('offre.save2new');
		}
		else
		{
			// if (!$checkedOut)
			// {
				JToolbarHelper::apply('offre.apply');
				JToolbarHelper::save('offre.save');
			// }
		}
		JToolBarHelper::cancel('offre.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
