<?php
defined('_JEXEC') or die;

class UtilisateurHelper extends JHelperContent
{
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('Utilisateurs'),
			'index.php?option=com_stage&view=utilisateurs',
			$vName == 'utilisateurs'
		);
	}
}
