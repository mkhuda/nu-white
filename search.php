<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package nuwhite
 * @since nuwhite 1.0
 */
 
get_header(); ?>
 
        <section id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
 
            <?php if ( have_posts() ) : ?>
 
                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'nuwhite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
 
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
 
                    <?php get_template_part( 'content', 'search' ); ?>
 
                <?php endwhile; ?>
 
                <?php nuwhite_content_nav( 'nav-below' ); ?>
 
            <?php else : ?>
 
               <article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'nuwhite' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Nothing found ! Please try again with some different keywords !', 'nuwhite' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
 
            <?php endif; ?>
 
            </div><!-- #content .site-content -->
        </section><!-- #primary .content-area -->
 
<?php get_footer(); ?>