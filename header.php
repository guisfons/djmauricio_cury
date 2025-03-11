<!DOCTYPE html>
<html lang="pt-Br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="publisher" content="guilhermesfonsecaa@gmail.com">
        
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/slick.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
		<link rel="stylesheet" href="https://icono-49d6.kxcdn.com/icono.min.css">
        <?php
            get_template_part('template-parts/header/seo');
            wp_head();

            global $current_user;
            wp_get_current_user();
        ?>
    </head>
    <body style="opacity: 0;">
        <header class="header">
            <div class="wrapper header__container">
                <a href="#" >
                    <img class="header__logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="DJ Mauricio Cury">
                </a>
                <button class="header__nav-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <nav class="header__nav">
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
            </div>
        </header>