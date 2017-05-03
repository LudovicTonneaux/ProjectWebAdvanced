<div class="pull-right">
	<a href="<?php echo site_url('index.php/person/add'); ?>" class="btn btn-success">Add</a>
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Actions</th>
    </tr>
    <tr>
		<td><?php echo $person['id']; ?></td>
		<td><?php echo $person['first_name']; ?></td>
		<td><?php echo $person['last_name']; ?></td>
		<td>
            <a href="<?php echo site_url('index.php/person/edit/'.$person['id']); ?>" class="btn btn-info btn-xs">Edit</a>
            <a href="<?php echo site_url('index.php/person/remove/'.$person['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
</table>