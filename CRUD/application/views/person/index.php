<div class="pull-right">
	<a href="<?php echo site_url('person/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Actions</th>
    </tr>
	<?php foreach($person as $p){ ?>
    <tr>
		<td><?php echo $p['id']; ?></td>
		<td><?php echo $p['first_name']; ?></td>
		<td><?php echo $p['last_name']; ?></td>
		<td>
            <a href="<?php echo site_url('person/edit/'.$p['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('person/remove/'.$p['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>