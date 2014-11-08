<?
function gm_gallery_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'orderby' => 'menu_order',
		'cat' => '',
		'display' => 'excerpt',
	), $atts ) );
	
	$db_args = array(
		'post_type' => 'gallery',
		'order' => 'ASC',
		'orderby' => $orderby,
		'posts_per_page' => -1,
		'meta_key' => '_thumbnail_id'
	);
	
	if($cat != "") {
		$db_args['tax_query'] = array(
			array(
				'taxonomy' => 'Services',
				'field' => 'slug',
				'terms' => array($cat),
			),
		);
	}

	$gallery_loop = new WP_Query( $db_args );
	
	$content = "";
	$count = 1;
	
	if($gallery_loop->have_posts()) {
		switch($display) {		
			case "content":
				$content .= "<div class=\"gallery_wrapper\">";
				while( $gallery_loop->have_posts() ) : $gallery_loop->the_post();
					$content_filtered = get_the_content();
					$content_filtered = apply_filters('the_content', $content_filtered);
					$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
					$content .= "<div class=\"gallery_single\">";
					$content .= "<h3 class=\"gallery_title\">".get_the_title()."</h3>";
					$content .= "<div class=\"gallery_content\">$content_filtered</div>";
					$content .= "</div>";
				endwhile;
				$content .= "</div>";
				break;
				
				
			case "excerpt":
				$content .= '<div class="row">';
				while( $gallery_loop->have_posts() ) : $gallery_loop->the_post();
				
					$thumb = get_the_post_thumbnail( get_the_id(), 'gallery-thumb'/*, array("class" => "img-responsive")*/);
					$content .= "<div class=\"col-sm-4\">";
					$content .= '<div class="gallery-item">';
					$content .= "<a href=\"".get_permalink()."\">".$thumb."</a>";
					$content .= '<h4 class="text-center gallery-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
					$content .= "</div></div>";
					
					/*if ($count % 2 == 0) {
						$content .= '<div class="clearfix visible-xs visible-sm"></div>';
					}*/
					
					if ($count % 4 == 0) {
						$content .= '<div class="clearfix visible-md visible-lg"></div>';
					}
					
					$count++;
					
				endwhile;
				$content .= "</div>";
				break;
				
				
			case "list":
				$content .= "<ul class=\"gallery_wrapper\">";
				while( $gallery_loop->have_posts() ) : $gallery_loop->the_post();
					$content .= "<li class=\"gallery_single\">";
					$content .= "<span class=\"gallery_title\"><a href=".get_permalink().">".get_the_title()."</a></span>";
					$content .= "</li>";
				endwhile;
				$content .= "</ul>";
				break;
		}
			
	}
	wp_reset_postdata();
	return $content;
				
}
add_shortcode( 'gm_gallery', 'gm_gallery_shortcode' );
