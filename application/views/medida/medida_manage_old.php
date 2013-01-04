<div id="content" class="clearfix">
<h2>Gestionar medidas<h2>
<table border="1" width="100%" cellpadding="5" cellspacing="5">
	<thead>
		<tr>
			<th>Valor</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Tipo</th>
			<th>Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($medidas as $medida) { ?>
			<tr>
				<td><?php echo $medida->valor; ?></td>
				<td><?php echo $medida->fecha; ?></td>
				<td><?php echo $medida->hora; ?></td>
				<td><?php echo $medida->tipo; ?></td>
				<td>
					<?php 
					
					echo anchor("medida/editar_medida/$medida->id", 'Editar') . ' / ' . anchor("medida/delete/id/$medida->id", 'Borrar'); ?></td>
			<tr>
		<?php } ?>
	</tbody>
</table>
<?php echo $pagination ?>
</div>