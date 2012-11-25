<?php
// Connect to database
$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

// Construct SQL
$sql = "SELECT * FROM bookmarks WHERE bookmark_id={$_GET['id']} LIMIT 1";

// Execute query
$result = $conn->query($sql);

// Get result
$bookmark = null;
if($result != null && $conn->affected_rows > 0) {
	$bookmark = $result->fetch_object();
}

// Close DB connection
unset($conn);
?>
<form class="form-horizontal" action="./actions/bookmark_edit.php" method="post">
	<input type="hidden" name="bookmark_id" value="<?php echo $_GET['id'] ?>" />
	<h2>Edit Bookmark</h2>
	<div class="control-group">
		<label class="control-label" for="bookmark_name">Name</label>
		<div class="controls">
			<input type="text" name="bookmark_name" placeholder="name" class="span5" value="<?php echo $bookmark->bookmark_name; ?>" />
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
				<?php if($bookmark->category_id == $c->category_id) {
					$selected = 'selected="selected"';
				} else {
					$selected = '';
				} ?>
				<option value="<?php echo $c->category_id ?>" <?php echo $selected; ?>><?php echo $c->category_name ?></option>
				<?php endforeach; ?>
			</select>
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_url">Address</label>
		<div class="controls">
			<input type="text" name="bookmark_url" placeholder="http://www.example.com" class="span5" value="<?php echo $bookmark->bookmark_url; ?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_description">Description</label>
		<div class="controls">
			<textarea name="bookmark_description" class="span5" rows="5"><?php echo $bookmark->bookmark_description; ?></textarea>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning">Edit</button>
		<button type="button" class="btn btn-cancel">Cancel</button>
	</div>
</form>