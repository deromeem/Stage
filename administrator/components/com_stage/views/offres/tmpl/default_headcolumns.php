<?php
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

	<tr>
        <th width="5%" class="hidden-phone">
			<?php echo JHtml::_('grid.checkall'); ?>
        </th>                   
        <th width="15%">
<<<<<<< HEAD
			<?php echo JHtml::_('grid.sort', 'COM_STAGE_OFFRES_TITRE', 'o.titre', $listDirn, $listOrder) ?>
        </th>
        <th width="15%">
			<?php echo JHtml::_('grid.sort', 'COM_STAGE_OFFRES_DESCRIPTION', 'o.description', $listDirn, $listOrder) ?>
        </th>
        <th width="15%">
			<?php echo JHtml::_('grid.sort', 'COM_STAGE_OFFRES_ETATOFFRE', 'etat', $listDirn, $listOrder) ?>
=======
			<?php echo JHtml::_('grid.sort', 'Titre', 'o.titre', $listDirn, $listOrder) ?>
        </th>
        <th width="15%">
			<?php echo JHtml::_('grid.sort', 'Description', 'o.description', $listDirn, $listOrder) ?>
        </th>
        <th width="15%">
			<?php echo JHtml::_('grid.sort', 'Etat offre', 'etat', $listDirn, $listOrder) ?>
>>>>>>> 0069969ceafeeb593f685c8b22e015df958f09c5
        </th>
        <th width="5%" style="min-width:55px" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'Publié', 'c.published', $listDirn, $listOrder) ?>
        </th>
        <th width="10%" style="min-width:120px" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'Date', 'c.modified', $listDirn, $listOrder) ?>
        </th>
		<th width="5%" class="nowrap center hidden-tablet hidden-phone">
			<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'c.hits', $listDirn, $listOrder); ?>
		</th>
		<th width="5%" class="nowrap center hidden-phone">
			<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'c.id', $listDirn, $listOrder); ?>
		</th>
	</tr>

