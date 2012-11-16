<?php
$name = '';
?>
<form class="form-horizontal" action="./actions/category_add.php" method="post">
	<h2>Add a new category</h2>
	<div class="control-group">
		<label class="control-label" for="category_name">Name</label>
		<div class="controls">
			<input type="text" name="category_name" placeholder="name" class="span5" value="<?php echo $name; ?>" />
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success">Add</button>
		<button type="button" class="btn btn-cancel">Cancel</button>
	</div>
</form>