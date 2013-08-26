</div>
     <!-- #main .site-main -->     
  <div id="colophon" class="site-footer" role="contentinfo">
  	 <div id="colophon-widget">
  	 	  <div class="footbar-widget-content">
  	 	  		<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-footer-1' ) ) : ?>
					<aside id="recent-posts" class="widget widget_recent_entries">
						<ul>
							<?php the_widget('WP_Widget_Recent_Posts'); ?> 
						</ul>
					</aside>
				<?php endif; ?>
  	 	  </div>
		  
  	 	  <div class="footbar-widget-content">
  	 	  		<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-footer-2' ) ) : ?>
					<aside id="tag-cloud" class="widget widget_tag_cloud">
						<ul>
							<?php the_widget( 'WP_Widget_Tag_Cloud'); ?> 
						</ul>
					</aside>
				<?php endif; ?>
  	 	  </div>
		  
  	 	  <div class="footbar-widget-content">
  	 	  		<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( 'sidebar-footer-3' ) ) : ?>
					<aside id="calendar" class="widget widget-calendar">
						<ul>
							<?php the_widget('WP_Widget_Calendar'); ?> 
						</ul>
					</aside>
				<?php endif; ?>
  	 	  </div>
		  
  	 </div>
    <div class="site-credits">
    	
		<?php do_action( 'nuwhite_credits' ); ?>
        <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'nuwhite' ); ?>" rel="generator">
        <?php printf( __( 'Proudly powered by %s', 'nuwhite' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
		<a href="http://mkhuda.com/themes/nuwhite" title="<?php esc_attr_e( 'Mkhuda', 'nuwhite' ); ?>" rel="generator">
        <?php printf( __( 'Theme %s', 'nuwhite' ), 'nuwhite' ); ?></a> <?php printf( __( 'by %s', 'nuwhite' ), 'Mkhuda' ); ?> <br>
		
		<!-- Social Links -->
	
    </div><!-- .site-info -->
  </div><!-- #colophon .site-footer -->
  
  <div class="back-to-top"><a href="#masthead">'.__( 'Back to Top', 'nuwhite' ).'</a></div>
</div>
<?php wp_footer(); ?>
</body>
</html>