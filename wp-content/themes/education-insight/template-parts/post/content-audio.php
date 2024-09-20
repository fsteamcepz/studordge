<?php
/**
 * Template part for displaying posts
 *
 * @subpackage Education Insight
 * @since 1.0
 */
?>
<?php

$audio = education_insight_get_media(array('audio','iframe'));

?>
<div id="Category-section" class="entry-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="postbox smallpostimage p-2">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
      	<?php
          if ( ! is_single() ) {
            // If not a single post, highlight the audio file.
            if ( ! empty( $audio ) ) {
              foreach ( $audio as $audio_html ) {
                echo '<div class="entry-audio">';
                echo $audio_html;
                echo '</div><!-- .entry-audio -->';
              }
            };
          };
          ?>
        	<div class="overlay">
        		<div class="date-box mb-2">
              <?php if( get_option('education_insight_date',false) != 'off'){ ?>
                <span class="mr-2"><i class="<?php echo esc_attr(get_theme_mod('education_insight_date_icon','far fa-calendar-alt')); ?> mr-2"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
              <?php } ?>
              <?php if( get_option('education_insight_admin',false) != 'off'){ ?>
                <span class="entry-author mr-2"><i class="<?php echo esc_attr(get_theme_mod('education_insight_author_icon','fas fa-user')); ?> mr-2"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
              <?php }?>
              <?php if( get_option('education_insight_comment',false) != 'off'){ ?>
                <span class="entry-comments mr-2"><i class="<?php echo esc_attr(get_theme_mod('education_insight_comment_icon','fas fa-comments')); ?> mr-2"></i> <?php comments_number( __('0 Comments','education-insight'), __('0 Comments','education-insight'), __('% Comments','education-insight')); ?></span>
              <?php }?>
              <?php if( get_option('education_insight_tag',false) != 'off'){ ?>
                <span class="tags"><i class="<?php echo esc_attr(get_theme_mod('education_insight_tag_icon','fas fa-tags')); ?> mr-2"></i> <?php display_post_tag_count(); ?></span>
              <?php }?>
          </div>
          <div class="link-more mb-2">
            <a class="more-link py-2 px-4" href="<?php get_the_title( get_the_ID() ); ?>"><?php echo esc_html('Read More','education-insight'); ?></a>
          </div>
        </div>
	      <div class="clearfix"></div> 
	  	</div>
	</div>
</div>