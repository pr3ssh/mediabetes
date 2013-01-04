<div id="content">
<h2>Gestionar Recetas<h2>
<table border="1" width="100%" cellpadding="5" cellspacing="5">
	<thead>
		<tr>
			<th>Titulo</th>
			<th>Categor&iacute;a</th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($recetas as $receta) { ?>
			<tr>
				<td><?php echo $receta->titulo; ?></td>
				<td><?php echo $receta->categoria; ?></td>
				<td>
					<?php 
					
					echo anchor("recetas/editar_receta/$receta->id", 'Editar') . ' / ' . anchor("recetas/delete_receta/id/$receta->id", 'Borrar'); ?></td>
			<tr>
		<?php } ?>
	</tbody>
</table>
<?php echo $pagination ?>
</div>