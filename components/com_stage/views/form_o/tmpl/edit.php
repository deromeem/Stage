<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('12', $user->groups));		// sets flag when user group is '12' that is 'STAGE entreprise
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_STAGE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>

	<script type="text/javascript">
		// fonction javascript pour gérer les actions sur les boutons
		Joomla.submitbutton = function(task)
		{
			// si bouton 'Annuler' ou si les champs du formulaire sont valides alors on envoie le formulaire
			if (task == 'offre.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
			{
				Joomla.submitform(task);
			}
		}
	</script>

	<div class="edit item-page">
		<form action="<?php echo JRoute::_('index.php?option=com_stage&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
			
			<div class="form-inline form-inline-header">
				<div class="btn-group pull-left">
					<?php $isNew = ($this->item->id == 0); ?>
					<h2><?php echo JText::_('COM_STAGE_OFFRE')." ".($isNew ? JText::_('COM_STAGE_ADD_PAR'): JText::_('COM_STAGE_MODIF_PAR')); ?></h2>
				</div>
				<div class="btn-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn" onclick="Joomla.submitbutton('offre.cancel')">
							<span class="icon-cancel"></span>
						</button>
					</div>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary validate" onclick="Joomla.submitbutton('offre.save')">
							<span class="icon-ok"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>

			<fieldset>
				<ul class="nav nav-tabs">
					<li><a href="#offre" data-toggle="tab"><?php echo JText::_('COM_STAGE_OFFRE'); ?></a></li>
					<li><a href="#avance" data-toggle="tab"><?php echo JText::_('COM_STAGE_ADVANCED'); ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="offre">
						<table class="table">
							<tbody>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('titre'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('titre'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane" id="avance">
						<table class="table">
							<tbody>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('date_debut'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('date_debut'); ?></div>
									</td>
								</tr>
								<tr>
									<td width="20%" class="nowrap right">
										<div class="control-label"><?php echo $this->form->getLabel('date_fin'); ?></div>
									</td>
									<td width="80%">
										<div class="controls"><?php echo $this->form->getInput('date_fin'); ?></div>
									</td>
								</tr>
							</tbody>
						</table>				

						<input type="hidden" name="task" value="" />
						<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
					</div>
					</div>
				<?php echo JHtml::_('form.token'); ?>
			</fieldset>
		</form>
	</div>

<?php endif; ?>
