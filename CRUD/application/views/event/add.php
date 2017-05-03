<?php echo validation_errors(); ?>
<?php echo form_open('index.php/event/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="person_id" class="col-md-4 control-label">Person Id</label>
		<div class="col-md-8">
			<select name="person_id" class="form-control">
				<option value="">select person</option>
				<?php 
				foreach($all_person as $person)
				{
					$selected = ($person['id'] == $this->input->post('person_id')) ? ' selected="selected"' : "";

					echo '<option value="'.$person['id'].'" '.$selected.'>'.$person['id'].'</option>';
				} 
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="name" class="col-md-4 control-label">Name</label>
		<div class="col-md-8">
			<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
		</div>
	</div>
	<div class="form-group">
		<label for="date" class="col-md-4 control-label">Date</label>
		<div class="col-md-8">
			<input type="text" name="date" value="<?php echo $this->input->post('date'); ?>" class="form-control" id="date" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>