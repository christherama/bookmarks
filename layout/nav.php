<?php 
// Connect to database
$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

// Construct SQL
$sql = 'SELECT * FROM categories';

// Execute query
$results = $conn->query($sql);

$categories = null;

// If query was successful (no SQL errors)...
if ($results != null) {
	// If there is at least one row in the result set...
	if ($conn->affected_rows > 0) {
		$categories = array();
		// Loop through results, adding a table row
		while($category = $results->fetch_object()) {
			$categories[] = $category;
		}
	}
}

// Disconnect from DB
unset($conn);
?>

<div class="navbar-inner">
	<div class="container">
		<ul class="nav">
			<li><img src="assets/img/bookmark-icon.png" alt="Bookmarks Logo"/></li>
			<li><a href="./">Home</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
				<ul class="dropdown-menu">
				<?php if($categories == null):?>
					<li class="nav-header">no categories</li>
				<?php else:?>
					<?php foreach($categories as $c):?>
						<li><a href="./?p=category&amp;id=<?php echo $c->category_id?>"><?php echo $c->category_name?></a></li>
					<?php endforeach;?>
				<?php endif;?>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="./?p=bookmark_add">Bookmark</a></li>
					<li><a href="./?p=category_add">Category</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>