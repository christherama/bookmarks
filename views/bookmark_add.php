<?php
$name = '';
$url = '';
$description = '';
if(isset($_SESSION['POST'])) {
	extract($_SESSION['POST']);
	unset($_SESSION['POST']);
}

$categories = get_categories();
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
		<label class="control-label" for="category_id">Category</label>
		<div class="controls">
			<?php if($categories == null):?>
				<p class="alert">There are no categories. Add one <a href="./?p=category_add">here</a>.</p>
			<?php else: ?>
			<select name="category_id" class="span5">
				<option value="">Select a category</option>
				<?php foreach($categories as $c): ?>
				<option value="<?php echo $c->category_id ?>"><?php echo $c->category_name ?></option>
				<?php endforeach; ?>
			</select>
			<?php endif; ?>
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