<?php
defined('_JEXEC') or die('Restricted access');
 
class StageTableCandidature extends JTable
{
	function __construct(&$db) 
	{
		parent::__construct('#__stage_candidatures', 'id', $db);
	}

	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();

		if ($this->id)
		{
			$this->modified		= $date->toSql();
			$this->modified_by	= $user->get('id');
		}
		else
		{
			if (!(int) $this->created)
			{
				$this->created = $date->toSql();
			}
			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}
		
		return parent::store($updateNulls);
	}
}
