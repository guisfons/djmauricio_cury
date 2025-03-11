<?php
	if((is_home() || !is_single())):
		echo '<meta property="og:image" content="'.get_template_directory_uri().'/assets/img/new-logo-seo.png">';
	endif;

	if ( is_single() ) {
		echo '<meta property="fb:app_id" content=""/>';
	}
?>
<title><?php echo bloginfo('name') . ' | ' . get_the_title(); ?></title>