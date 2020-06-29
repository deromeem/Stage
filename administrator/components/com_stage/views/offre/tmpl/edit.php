<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'offre.cancel' || document.formvalidator.isValid(document.id('stage-form')))
		{
			<?php //echo $this->form->getField('commentaire')->save(); ?>
			Joomla.submitform(task, document.getElementById('stage-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_stage&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="stage-form" class="form-validate">

	<div class="form-inline form-inline-header">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('titre'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('titre'); ?></div>
		</div>					
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
		</div>		
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('alias'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('alias'); ?></div>
		</div>					
	</div>					

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'infos')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'infos', JText::_('COM_STAGE_ADVANCED')); ?>	
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('date_debut'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('date_debut'); ?></div>
		</div>
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('date_fin'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('date_fin'); ?></div>
		</div>
	</div>		
		
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
			</div>
			<div class="span3">
							<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
	
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
		
</form>
