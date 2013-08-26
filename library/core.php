<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package nuwhite
 * @since nuwhite 1.0
 */

if ( ! function_exists( 'nuwhite_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since nuwhite 1.0
 */
function nuwhite_content_nav( $nav_id ) {
    global $wp_query, $post;
 
    // if single page
    if ( is_single() ) {
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );
 
        if ( ! $next && ! $previous )
            return;
    }
 
    // if only one page.
    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
        return;
 
    $nav_class = 'site-navigation paging-navigation';
    if ( is_single() )
        $nav_class = 'site-navigation post-navigation';
 
    ?>
    <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
        <h1 class="assistive-text"><?php _e( 'Post navigation', 'nuwhite' ); ?></h1>
 
    <?php if ( is_single() ) : ?>
 
        <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'nuwhite' ) . '</span> %title' ); ?>
        <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'nuwhite' ) . '</span>' ); ?>
 
    <?php elseif (  is_home() || is_archive() || is_search()  ) : // navigation links for home, archive, and search pages 
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5
	) );
 
	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="pagination">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}

    endif;
 ?>
    </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
}
endif; // nuwhite_content_nav

if ( ! function_exists( 'nuwhite_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since nuwhite 1.0
 */
function nuwhite_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'nuwhite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'nuwhite' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer>
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                    <?php printf( __( '%s <span class="says">says:</span>', 'nuwhite' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'nuwhite' ); ?></em>
                    <br />
                <?php endif; ?>
 
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'nuwhite' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( '(Edit)', 'nuwhite' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
            </footer>
 
            <div class="comment-content"><?php comment_text(); ?></div>
 
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for nuwhite_comment()

/*
 * Get Popular posts for nuwhite widget
 */
function wp_popular_posts() {
	global $wpdb, $list;
	$popular = $wpdb->get_results("SELECT id, post_title, comment_count FROM {$wpdb->prefix}posts WHERE post_type='post' ORDER BY comment_count DESC LIMIT 10");
	$list .= '<ul>';
	
	foreach($popular as $post) :
		$list .= '<li><a href="'.get_permalink( $post->id ).'" title="'.$post->post_title.'">';
		$list .= $post->post_title;
		$list .= '</a></li>';
	endforeach;
	$list .= '</ul>';
	echo $list;
}

add_action ( 'nuwhite_get_popular_posts', 'wp_popular_posts' );

/*
 * Get Popular posts for nuwhite widget
 */
function wp_query_popular_posts() {
	global $pop_posts;
	$numPosts = 5;
	query_posts(array('orderby' => 'comment_count', 'showposts' => $numPosts));

	if (have_posts()) : 
		while (have_posts()) : the_post();
			$pop_posts .= '<li>'. get_the_title() .'</li>';
		endwhile; 
	endif;
	echo $pop_posts;
}

add_action ( 'nuwhite_get_query_popular_posts', 'wp_query_popular_posts' );