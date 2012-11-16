<?php 
// Connect to database
$conn = new mysqli('localhost',DB_USER,DB_PASSWORD,DB_NAME);

// Get category name
$sql = "SELECT category_name FROM categories WHERE category_id={$_GET['id']}";
$results = $conn->query($sql);
$category_name = $results->fetch_object()->category_name;

// Construct SQL
$sql = "SELECT * FROM bookmarks WHERE category_id={$_GET['id']}";

// Execute query
$results = $conn->query($sql);
echo $conn->error;

$bookmarks = null;

// If query was successful (no SQL errors)...
if ($results != null) {
	// If there is at least one row in the result set...
	if ($conn->affected_rows > 0) {
		$bookmarks = array();
		// Loop through results, adding a table row
		while($bookmark = $results->fetch_object()) {
			$bookmark->bookmark_timestamp = format_date($bookmark->bookmark_timestamp);
			$bookmarks[] = $bookmark;
		}
	}
}

unset($conn);

echo "<h2>$category_name</h2>";

// If there are no bookmarks in the DB, display a message
if($bookmarks == null) {
	echo '<p class="alert alert-info">There are no bookmarks to display</p>';
} else {
?>
<div class="bookmarks">
	<?php foreach($bookmarks as $b):
		$protocol_pattern = '/(https?:\/\/)/';
		$display_url = preg_replace($protocol_pattern, '', $b->bookmark_url);
	?>
	<div class="bookmark">
		<div class="actions">
			<a class="btn btn-mini" href="./?p=bookmark_edit&amp;id=<?php echo $b->bookmark_id?>"><i class="icon-edit"></i></a>
			<a class="btn btn-mini btn-danger" href="./actions/bookmark_delete.php" onclick="return window.confirm('Are you sure you want to delete this contact?');"><i class="icon-trash icon-white"></i></a>
		</div>
		<h3><?php echo $b->bookmark_name ?><span class="timestamp"><?php echo $b->bookmark_timestamp ?></span></h3>
		<a href="<?php echo $b->bookmark_url ?>" target="_blank"><cite><?php echo $display_url ?></cite></a>
		<p><?php echo $b->bookmark_description ?></p>
	</div>
	<?php endforeach;?>
</div>
<?php }?>