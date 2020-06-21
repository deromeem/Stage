<?php
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();               		// gets current user object
$isAdmin = (in_array('11', $user->groups));		// sets flag when user group is '11' that is 'STAGE Administrateur 
?>

<?php if (!$isAdmin) : ?>
	<?php echo JError::raiseWarning( 100, JText::_('COM_STAGE_RESTRICTED_ACCESS') ); ?>
<?php else : ?>
	<div class="form-inline form-inline-header">
		<div class="btn-group pull-left">
			<h2><?php echo JText::_('COM_STAGE_UTILISATEUR'); ?></h2>
		</div>
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_stage&view=utilisateurs'); ?>" class="btn" role="button">
				<span class="icon-cancel"></span></a>
		</div>	
		<div class="btn-group pull-right">
			<a href="<?php echo JRoute::_('index.php?option=com_stage&view=form_u&layout=edit&id='.$this->item->id); ?>" class="btn" role="button"><span class="icon-edit"></span></a>
		</div>	
	</div>
	<div>
		<table class="table">
			<tbody>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_STAGE_UTILISATEURS_NOM'); ?></span>
					</td>
					<td width="80%">
						<h4><?php echo $this->item->nom ?></h4>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_STAGE_UTILISATEURS_PRENOM'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->prenom ?>
					</td>
				</tr>
				<tr>
					<td width="20%" class="nowrap right">
						<span class="label"><?php echo JText::_('COM_STAGE_UTILISATEURS_EMAIL'); ?></span>
					</td>
					<td width="80%">
						<?php echo $this->item->email ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif; ?>
