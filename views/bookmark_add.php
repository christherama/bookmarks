<?php $categories = get_categories(); ?>
<form class="form-horizontal" action="./actions/bookmark_add.php" method="post">
	<h2>Add a new bookmark</h2>
	<div class="control-group">
		<label class="control-label" for="bookmark_name">Name</label>
		<div class="controls">
			<?php echo input('bookmark_name', null, 'text', 'name', 'span5') ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="category_id">Category</label>
		<div class="controls">
			<?php if($categories == null):?>
				<p class="alert">There are no categories. Add one <a href="./?p=category_add">here</a>.</p>
			<?php else: ?>
				<?php echo dropdown($categories, null, 'category_id', 'Select a category', 'span5') ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_url">Address</label>
		<div class="controls">
			<?php echo input('bookmark_url', null, 'text', 'http://www.example.com', 'span5') ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="bookmark_description">Description</label>
		<div class="controls">
			<?php echo textarea('bookmark_description', null, 5, 'brief description of website', 'span5') ?>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success">Add</button>
		<button type="button" class="btn btn-cancel">Cancel</button>
	</div>
</form>