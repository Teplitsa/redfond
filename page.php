<?php
/**
 * Single Post template
 **/

get_header();
?>
	<div class="content">
		<?php while (have_posts()){ the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('tpl-single'); ?>>

				<?php if ( has_post_thumbnail() ) : ?>

					<div class="module single-block">
						<?php the_post_thumbnail() ?>
						<?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
    						<p class="caption-in-page"><?php echo $caption; ?></p>
						<?php endif; ?>






					</div>

				<?php endif; ?>

				<div class="module2x">
					<div class="container">
						<?php the_content(); ?>
					</div>
					<div class="likely-holder">
						<!-- likely -->
						<div class="likely">
							<div class="facebook">Поделиться</div>
							<div class="vkontakte">Поделиться</div>
							<div class="twitter">Твитнуть</div>
							<div class="telegram">Отправить</div>
						</div>
					</div>
				</div><!-- /content-inner -->

			</article>
		<?php	} //endwhile ?>

		<?php do_action('grt_content_bottom');?>

	</div> <!-- /content -->

<?php get_footer(); ?>