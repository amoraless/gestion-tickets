<div>
	<div class="radio">
	  <label>
	    <input type="radio" name="search_name" id="search_name" value="1" checked>
	    nombre
	  </label>
	  <label>
	    <input type="radio" name="search_name" id="search_descripcion" value="2">
	    descripción
	  </label>
	</div>
	<input type="text" class="form-control" id="search" name='search' placeholder="search">
	<br>
	<button class="btn btn-default" name="btn_search" type="button">Buscar</button>
</div>
<table  id="tbl_tickets" class="table table-hover">
	<thead>
		<th>#</th>
		<th class="ds-nn">id ts</th>
		<th>
			Importancia
			<select name="ls_filtro" class="form-control">
			  <option value=""></option>
			  <?php foreach ($data['level_significance'] as $row): ?>
			 	<option value="<?php echo $row['ls_id']; ?>"><?php echo $row['ls_name']; ?></option>
			 <?php endforeach ?>
			</select>
		</th>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Accion</th>
	</thead>
	<tbody>
		<?php foreach ($data['tickets'] as $key => $row): ?>
			<tr id="<?php echo $row['tic_id']; ?>">
			<td><?php echo $key+1; ?></td>
			<td class="ds-nn" ><?php echo $row['ls_id']; ?></td>
			<td><?php echo $row['ls_name']; ?></td>
			<td><?php echo $row['tic_name']; ?></td>
			<td><?php echo $row['tic_description']; ?></td>
			<td>
			<a href="#" class="edit">Editar</a>
			<a href="#" class="show_delete" data-toggle="modal" data-target="#myModal">eliminar</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>