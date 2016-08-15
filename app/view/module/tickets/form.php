<form id="form_tickets" action="" method="POST" >
  <input type="hidden" name="tic_id" value="">
  <div class="form-group">  	
    <label for="name">Nivel de importancia</label>
    <select name="ls_id" class="form-control">
	  <option value=""></option>
	  <?php foreach ($data['level_significance'] as $row): ?>
	 	<option value="<?php echo $row['ls_id']; ?>"><?php echo $row['ls_name']; ?></option>
	 <?php endforeach ?>
	</select>
  </div>
  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" id="name" name='name' placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="description">Descripcion</label>
    <textarea class="form-control" rows="3" name="description" ></textarea>
  </div>
  <div class="form-group message">
    <span></span>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" class="btn btn-default">Cancelar</button>
</form>