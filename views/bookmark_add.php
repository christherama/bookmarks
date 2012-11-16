<?php
$name = '';
$url = '';
$description = '';
if(isset($_SESSION['POST'])) {
	extract($_SESSION['POST']);
	unset($_SESSION['POST']);
}
?>
<form class="form-horizontal" action="./actions/bookmark_add.php" method="post">
	<h2>Add a new bookmark</h2>
	<div class="control-group">
		<label class="control-label" for="bookmark_name">Name</label>
		<div class="controls">
			<input type="text" name="bookmark_name" placeholder="name" class="span5" value="<?php echo $name; ?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_url">Address</label>
		<div class="controls">
			<input type="text" name="bookmark_url" placeholder="http://www.example.com" class="span5" value="<?php echo $url; ?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_description">Description</label>
		<div class="controls">
			<textarea name="bookmark_description" class="span5" rows="5"><?php echo $description; ?></textarea>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success">Add</button>
		<button type="button" class="btn btn-cancel">Cancel</button>
	</div>
</form>