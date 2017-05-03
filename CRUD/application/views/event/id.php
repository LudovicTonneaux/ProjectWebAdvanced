<div class="pull-right">
	<a href="<?php echo site_url('index.php/event/add'); ?>" class="btn btn-success">Add</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Person Id</th>
		<th>Name</th>
		<th>Date</th>
		<th>Actions</th>
    </tr>
    <tr>
		<td><?php echo $event['id']; ?></td>
		<td><?php echo $event['person_id']; ?></td>
		<td><?php echo $event['name']; ?></td>
		<td><?php echo $event['date']; ?></td>
		<td>
            <a href="<?php echo site_url('index.php/event/edit/'.$event['id']); ?>" class="btn btn-info btn-xs">Edit</a>
            <a href="<?php echo site_url('index.php/event/remove/'.$event['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
</table>