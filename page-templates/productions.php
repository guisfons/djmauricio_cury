<?php
    /**
     * Template Name: Produções
     * Template Post Type: page
     *
     */

    // while ( have_posts() ) : the_post();
    //     $post->post_content = apply_filters( 'the_content', $post->post_content );
    
	get_header();
?>
<main>
    <section class="wrapper producoes">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/producoes.css">
		<h2 class="title"><?php echo get_the_title(); ?></h2>
		<article><?php echo get_the_content(); ?></article>
		<div class="producoes__faixas">
		<?php
			if( have_rows('musica') ):
				while( have_rows('musica') ) : the_row();
					$faixa = get_sub_field('iframe_faixa');
			
					echo
						'<article class="faixa"> 
							'.$faixa.'
						</article>';
				endwhile;
			endif;
		?>
		</div>
	</section>
</main>

<?php get_footer(); ?>