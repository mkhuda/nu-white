<div class="home-contents">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
	 
	 <?php nuwhite_date_posts(); ?>
	 
     <header class="entry-header">

          <h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		  </h1>
 
          <div class="entry-meta">
              <?php nuwhite_posted_author(); ?>
			  <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for Pages in Search results ?>
          <?php
               /* translators: used between list items, there is a space after the comma */
               $categories_list = get_the_category_list( __( ', ', 'nuwhite' ) );
               if ( $categories_list && nuwhite_categorized_blog() ) :
          ?>
		  <span class="sep"> | </span>
          <span class="cat-links">
               <?php printf( __( 'Categories %1$s', 'nuwhite' ), $categories_list ); ?>
          </span>
          <?php endif; // End if categories ?>
 
          <?php
               /* translators: used between list items, there is a space after the comma */
               $tags_list = get_the_tag_list( '', __( ', ', 'nuwhite' ) );
               if ( $tags_list ) :
          ?>
               <span class="sep"> | </span>
               <span class="tag-links">
                    <?php printf( __( 'Tagged %1$s', 'nuwhite' ), $tags_list ); ?>
               </span>
               <?php endif; // End if $tags_list ?>
          </div><!-- .entry-meta -->
          <?php endif; ?>
     </header><!-- .entry-header -->
 
     <?php if ( is_search() ) : // Only display Excerpts on Search results pages ?>
     <div class="entry-summary">
          <?php the_excerpt(); ?>
     </div><!-- .entry-summary -->
	 
     <?php else : ?>
     	
	 
		  <?php do_action ( 'nuwhite_get_index_posts_style' ); ?>
		  
     <!-- .entry-content -->
    
 
<?php /* Show the post's tags, categories, and a comment link. */ ?>
     <footer class="entry-meta">
		 
          <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'nuwhite' ), 'after' => '</div>' ) ); ?>
		  <?php endif; ?> <!-- End if 'post' == get_post_type() ?> -->
		  
          <?php edit_post_link( __( 'Edit', 'nuwhite' ) ); ?>
		  
		   <?php echo '<div class="nuwhite-more"><a class="readmore" href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">'.__( 'Read more', 'nuwhite' ).'</a></div>'; ?>
     </footer><!-- .entry-meta -->
<?php /* Close up the article and end the loop. */ ?>
</div><!-- #post-<?php the_ID(); ?> -->
</div>