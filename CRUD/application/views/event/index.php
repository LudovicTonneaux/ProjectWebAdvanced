<div class="pull-right">
	<a href="<?php echo site_url('event/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Person Id</th>
		<th>Name</th>
		<th>Date</th>
		<th>Actions</th>
    </tr>
	<?php foreach($event as $e){ ?>
    <tr>
		<td><?php echo $e['id']; ?></td>
		<td><?php echo $e['person_id']; ?></td>
		<td><?php echo $e['name']; ?></td>
		<td><?php echo $e['date']; ?></td>
		<td>
            <a href="<?php echo site_url('event/edit/'.$e['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('event/remove/'.$e['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>