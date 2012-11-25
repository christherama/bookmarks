<?php $categories = get_categories() ?>
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