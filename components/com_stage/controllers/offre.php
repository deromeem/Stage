<?php
defined('_JEXEC') or die;

class StageControllerOffre extends JControllerForm
{
	// précise la vue (formulaire de saisie) à afficher
	protected $view_item = 'form_u';
	
	// précise la variable d'édition URL
	protected $urlVar = 'b.id';
	
	public function add()
	{
		if (!parent::add())
		{
			// redirige à la page de retour
			$this->setRedirect($this->getReturnPage());
		}
	}

	public function edit($key = null, $urlVar = 'b_id')
	{
		$result = parent::edit($key, $urlVar);
		if (!$result)
		{
			$this->setRedirect($this->getReturnPage());
		}
		return $result;
	}

	public function save($key = null, $urlVar = 'b_id')
	{
		$result = parent::save($key, $urlVar);
		if ($result)
		{
			$this->setRedirect($this->getReturnPage());
		}
		return $result;
	}

	public function cancel($key = 'b_id')
	{
		parent::cancel($key);
		$this->setRedirect($this->getReturnPage());
	}

	protected function getReturnPage()
	{
		// $return = $this->input->get('return', null, 'base64');

		// if (empty($return) || !JUri::isInternal(base64_decode($return)))
		// {
			// return JUri::base();
		// }
		// else
		// {
			// return base64_decode($return);
		// }
		return JURI::base()."/index.php?option=com_stage&view=offres";		
	}

	public function getModel($name = 'form_u', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
