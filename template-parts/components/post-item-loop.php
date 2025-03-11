<article class="posts__item">

    <figure class="posts__photo">
        <a href="<?php echo $post_link; ?>">&nbsp;</a>

		<?php
			if (empty($post_image)):
                $post_image = get_template_directory_uri() . '/assets/img/bg-fake.png';
            endif;
        ?>
        <img src="<?php echo $post_image; ?>" class="posts__img">

        <?php
            if (!empty($brandpost)):
                echo '<img src="'. $brandpost['brandpost_flag']. '">';
            endif;
        ?>
    </figure>

    <div class="posts__text">

        <h2 class="posts__title">
            <a href="<?php echo $post_link; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="posts__excerpt">
            <a href="<?php echo $post_link; ?>" title="<?php echo $post_title; ?>"><?php echo $excerpt; ?></a>
        </p>
        <div class="posts__authorDate">

			<div class="posts__author">
				<span>Por <a href="<?php echo $author['url']; ?>"><?php echo $author['display_name']; ?></a></span>
			</div>

            <div class="posts__date">
                <span><?php echo get_the_date(). ' - ' .get_the_time(); ?></span>

                <?php
                    if (!empty($taxonomy) && ($post->post_type !== 'colunas' || is_search() || is_singular('brandspaces')) ):
                        echo '<p>em <a href="'. $taxonomy_link.'">'. $taxonomy[0]->name.'</a></p>';
                    endif;
                ?>
            </div>
        </div>
    </div>

</article>