<?php
 /**
 * Testimonial widget
 */
class nuwhite_Social_Widget extends WP_Widget {

	function nuwhite_Social_Widget() {
 		$widget_ops = array( 'classname' => 'social_widget', 'description' => __( 'Display Social Links', 'nuwhite' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'NuWhite: Social Widget', 'nuwhite' ), $widget_ops, $control_ops);
 	}
	
	function widget( $args, $instance ) {
	extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
		do_action ( 'nuwhite_get_social_links' ); /* Get social links from action hook */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'name' => '' ) );
		$title = strip_tags($instance['title']);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'nuwhite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}

class nuwhite_Popular_Posts extends WP_Widget {
	function nuwhite_Popular_Posts() {
 		$widget_ops = array( 'classname' => 'popular_posts', 'description' => __( 'Display Popular Posts', 'nuwhite' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'NuWhite: Popular Posts', 'nuwhite' ), $widget_ops, $control_ops);
 	}
	function widget( $args, $instance ) {
	extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$total = $instance['total'];
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
		/* do_action ( 'nuwhite_get_query_popular_posts' ); Get popular posts */
			query_posts(array('orderby' => 'comment_count', 'post_status' => 'publish', 'showposts' => $total));
			$pop_posts = '';
			$widthumb = '';
			$nothumb = '<div class="widget-thumbnails-no"><img src="'. get_template_directory_uri() .'/img/featured-widget.png"></div>';
			$pop_posts .= '<ul class="popular-widget">';
			if (have_posts()) : 	
				
				while (have_posts()) : the_post();
					if ( has_post_thumbnail() ) {
						$pop_posts .= '<li><div class="widget-thumbnails">';
						$pop_posts .= get_the_post_thumbnail( get_the_ID(), 'featured-small-widget', array( 'title' => get_the_title(), 'alt' => get_the_title() ) ).'</div>'; 
						$pop_posts .= '<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
					if ( ! has_post_thumbnail() ) {
						$pop_posts .= '<li>'. $nothumb .'<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
				endwhile; 
			endif;
			$pop_posts .= '</ul>';
			echo $pop_posts;
		echo $after_widget;
		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['total'] = $new_instance['total'];
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'total' => '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'nuwhite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('total'); ?>"><?php _e( 'Number of posts to show: ', 'nuwhite'); ?></label>
		<input id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo $instance['total']; ?>" size="3"></p>
<?php
	}
}


class nuwhite_Recent_Posts extends WP_Widget {
	function nuwhite_Recent_Posts() {
 		$widget_ops = array( 'classname' => 'recent_posts', 'description' => __( 'Display Recent Posts', 'nuwhite' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'NuWhite: Recent Posts', 'nuwhite' ), $widget_ops, $control_ops);
 	}
	function widget( $args, $instance ) {
	extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$total = $instance['total'];
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
			query_posts(array('orderby' => 'date', 'post_status' => 'publish', 'showposts' => $total));
			$pop_posts = '';
			$widthumb = '';
			$nothumb = '<div class="widget-thumbnails-no"><img src="'. get_template_directory_uri() .'/img/featured-widget.png"></div>';
			$pop_posts .= '<ul class="popular-widget">';
			if (have_posts()) : 	
				
				while (have_posts()) : the_post();
					if ( has_post_thumbnail() ) {
						$pop_posts .= '<li><div class="widget-thumbnails">';
						$pop_posts .= get_the_post_thumbnail( get_the_ID(), 'featured-small-widget', array( 'title' => get_the_title(), 'alt' => get_the_title() ) ).'</div>'; 
						$pop_posts .= '<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
					if ( ! has_post_thumbnail() ) {
						$pop_posts .= '<li>'. $nothumb .'<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
				endwhile; 
			endif;
			$pop_posts .= '</ul>';
			echo $pop_posts;
		echo $after_widget;
		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['total'] = $new_instance['total'];
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'total' => '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'nuwhite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('total'); ?>"><?php _e( 'Number of posts to show: ', 'nuwhite'); ?></label>
		<input id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo $instance['total']; ?>" size="3"></p>
<?php
	}
}


class nuwhite_Category_Posts extends WP_Widget {
	function nuwhite_Category_Posts() {
 		$widget_ops = array( 'classname' => 'category_posts', 'description' => __( 'Display Category Posts', 'nuwhite' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 ); 
		parent::WP_Widget( false, $name = __( 'NuWhite: Category Posts', 'nuwhite' ), $widget_ops, $control_ops);
 	}
	function widget( $args, $instance ) {
	extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$category = $instance['category'];
		$total = $instance['total'];
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; }
			query_posts(array('orderby' => 'date', 'cat' => $category, 'post_status' => 'publish', 'showposts' => $total));
			$pop_posts = '';
			$widthumb = '';
			$nothumb = '<div class="widget-thumbnails-no"><img src="'. get_template_directory_uri() .'/img/featured-widget.png"></div>';
			
			$pop_posts .= '<ul class="popular-widget">';
			if (have_posts()) : 	
				
				while (have_posts()) : the_post();
					if ( has_post_thumbnail() ) {
						$pop_posts .= '<li><div class="widget-thumbnails">';
						$pop_posts .= get_the_post_thumbnail( get_the_ID(), 'featured-small-widget', array( 'title' => get_the_title(), 'alt' => get_the_title() ) ).'</div>'; 
						$pop_posts .= '<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
					if ( ! has_post_thumbnail() ) {
						$pop_posts .= '<li>'. $nothumb .'<a href="' . get_permalink() . '" title="'.__( 'Go to ', 'nuwhite' ).get_the_title().'">'.get_the_title().'</a><div class="date">'.get_the_date().'</div></li>';
					}
				endwhile; 
			endif;
			$pop_posts .= '</ul>';
			echo $pop_posts;
		echo $after_widget;
		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = $new_instance['category'];
		$instance['total'] = $new_instance['total'];
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'category' => '',
		'total' => '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'nuwhite' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('total'); ?>"><?php _e( 'Number of posts to show: ', 'nuwhite'); ?></label>
		<input id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo $instance['total']; ?>" size="3"></p>
		
		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Set the category:', 'nuwhite' ); ?></label>
		<?php $categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
			<select name="<?php echo $this->get_field_name('category'); ?>">
				<option <?php selected( 0 == $instance['category'] ); ?> value="0"><?php _e( '--none--', 'nuwhite' ); ?></option>
				<?php foreach( $categories as $category ) : ?>
				<option <?php selected( $category->term_id == $instance['category'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
				<?php endforeach; ?>
			</select></p>
<?php
	}
}