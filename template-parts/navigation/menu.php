<nav class="menu menu-items hidden-sm">

	<a class="menu__item opacity-effect" href="/" title="">
		<i class="las la-home"></i>
	</a>

	<!--<a class="menu__item opacity-effect" href="/" title="">
		<img alt="Emoji Fire" src="<?php echo get_template_directory_uri(); ?>//assets/svg/emoji_fire.svg">&nbsp;populares
	</a>-->

	<?php
		$header_menu = wp_get_nav_menu_items("Menu Header");
		foreach($header_menu as $key => $menu_item){
			echo '<a title="'. str_replace('*', '', $menu_item->title) .'" href="'.$menu_item->url.'" class="menu__item '. (get_the_ID() == $menu_item->object_id ? 'is-current active' : '') .'" target="'.$menu_item->target.'">';
				$menu_title = $menu_item->title;

				if (strpos($menu_item->title, '*') !== false) {
					$menu_title = str_replace('*', '', $menu_item->title);
				}

				echo $menu_title;
			echo '</a>';
		}
	?>
</nav>