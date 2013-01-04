<div id="content">
<h2>Gestionar Editores<h2>
<table border="1" width="100%" cellpadding="5" cellspacing="5">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Email</th>
			<th>Username</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($editores as $editor) { ?>
			<tr>
				<td><?php echo $editor->first_name; ?></td>
				<td><?php echo $editor->last_name; ?></td>
				<td><?php echo $editor->email_address; ?></td>
				<td><?php echo $editor->username; ?></td>
				<td>
					<?php 
					
					echo anchor("editor/editar_editor/$editor->id", 'Editar') . ' / ' . anchor("editor/delete_editor/id/$editor->id", 'Borrar'); ?></td>
			<tr>
		<?php } ?>
	</tbody>
</table>
<?php echo $pagination ?>
</div>