<?php
/**
 * General single template
 **/

?>	
<div class="post-inner">
	

	<div class="post-content cf">
	
		<?php the_content();?>
		<?php echo esc_html(get_the_date());?>
		
	</div> <!-- /post-content -->			   
	
	<div class="post-meta-bottom cf">
		
		<?php //@to_do: add sharing somewhere
			$args = array(
				'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','grt' ) . '</span>',
				'after'            => '</p>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'separator'        => '',
				'pagelink'         => '%',
				'echo'             => 1
			);
		
			wp_link_pages($args); 
		?>


		
	</div> <!-- /post-meta-bottom -->

</div> <!-- /post-inner -->	
	

