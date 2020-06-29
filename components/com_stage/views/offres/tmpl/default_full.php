<?php
defined('_JEXEC') or die('Restricted access');
?>

<h1>Offres</h1>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">

	<table class="category">
		<thead>
			<tr>
			<th class="title">Titre</th>
			<th class="title">Description</th>
			<th class="title">Date debut</th>
			<th class="title">Date fin</th>
		</tr>
		</thead>

		<tbody>
			<?php foreach($this->offres as $i => $item) : ?>
			<tr>
				<td><?php echo $item->titre ?></td>
				<td><?php echo $item->description ?></td>
				<td><?php echo $item->date_debut ?></td>
				<td><?php echo $item->date_fin ?></td>
			</tr>			
			<?php endforeach; ?>
		</tbody>
	</table>

</form>

<?php echo $this->pagination->getListFooter(); ?>
