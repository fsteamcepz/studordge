<?php
/**
 * The header for our theme
 *
 * @subpackage Education Insight
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-insight' ); ?></a>
	<?php if( get_option('education_insight_theme_loader',true) != 'off'){ ?>
		<div class="preloader">
			<div class="load">
			  <hr/><hr/><hr/><hr/>
			</div>
		</div>
	<?php }?>
	<div id="page" class="site">
		<div class="top_header">
			<div class="container">
				<?php if( get_theme_mod('education_insight_call') != ''){ ?>
					<span><i class="<?php echo esc_attr(get_theme_mod('education_insight_call_icon','fas fa-phone')); ?>"></i><?php echo esc_html(get_theme_mod('education_insight_call','')); ?></span>
				<?php }?>
				<?php if( get_theme_mod('education_insight_email') != ''){ ?>
					<span><i class="<?php echo esc_attr(get_theme_mod('education_insight_email_icon','far fa-envelope')); ?>"></i><?php echo esc_html(get_theme_mod('education_insight_email','')); ?></span>
				<?php }?>
				<?php if( get_option('education_insight_topbar_enable',false) != 'off'){ ?>
					<?php if(class_exists('woocommerce')){ ?>
						<?php if ( is_user_logged_in() ) { ?>
							<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e('MY ACCOUNT','education-insight'); ?></a>
						<?php }
						else { ?>
							<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e('LOGIN / REGISTER','education-insight'); ?></a>
						<?php } ?>
	                <?php }?>
	            <?php }?>
			</div>
		</div>
		<div id="header">
			<div class="wrap_figure fixed_header">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 box-center">
						   	<div class="menu_box left-menu">
						   		<?php get_template_part('template-parts/navigation/navigation-left'); ?>
						   	</div>
						</div>
						<div class="col-lg-2 col-md-3 box-center">
							<div class="logo">
						        <?php if ( has_custom_logo() ) : ?>
				            		<?php the_custom_logo(); ?>
					            <?php endif; ?>
				              	<?php $education_insight_blog_info = get_bloginfo( 'name' ); ?>

						                <?php if ( ! empty( $education_insight_blog_info ) ) : ?>
						                  	<?php if ( is_front_page() && is_home() ) : ?>
											<?php if( get_option('education_insight_logo_title',false) != 'off' ){ ?>
						                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
																	<?php }?>
						                  	<?php else : ?>
												<?php if( get_option('education_insight_logo_title',false) != 'off' ){ ?>
					                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
																		<?php }?>
					                  		<?php endif; ?>
						                <?php endif; ?>

					                <?php
				                  		$education_insight_description = get_bloginfo( 'description', 'display' );
					                  	if ( $education_insight_description || is_customize_preview() ) :
					                ?>
					                <?php if( get_option('education_insight_logo_text',true) != 'off' ){ ?>
					                  	<p class="site-description">
					                    	<?php echo esc_html($education_insight_description); ?>
					                  	</p>
					                <?php }?>
				              	<?php endif; ?>
						    </div>
						</div>
						<div class="col-lg-5 col-md-8 box-center">
							<div class="row">
								<div class="col-lg-8 col-md-4 col-3">
								   	<div class="menu_box">
								   		<?php get_template_part('template-parts/navigation/navigation-right'); ?>
								   	</div>
								   
										<div class="toggle-menu gb_menu">
											<button onclick="education_insight_gb_Menu_open()" class="gb_toggle"><i class="fas fa-ellipsis-h"></i><p><?php esc_html_e('Menu','education-insight'); ?></p></button>
										</div>
									
									<div class="menu_box_mobile">
								   		<?php get_template_part('template-parts/navigation/navigation-responsive'); ?>
								   	</div>
								</div>
								<div class="col-lg-4 col-md-8 col-9">
									<?php if( get_option('header_social_icon_enable',false) != 'off'){ ?>
									<?php
										$education_insight_header_facebook_target = esc_attr(get_option('education_insight_header_facebook_target','true'));
							            $education_insight_header_twt_target = esc_attr(get_option('education_insight_header_twt_target','true'));
							            $education_insight_header_linkedin_target = esc_attr(get_option('education_insight_header_linkedin_target','true'));
							            $education_insight_header_pinterest_target = esc_attr(get_option('education_insight_header_pinterest_target','true'));
							            
	          						?>  							
									<div class="links">
										 <?php if( get_theme_mod('education_insight_facebook') != ''){ ?>
								            <a target="<?php echo $education_insight_header_facebook_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('education_insight_facebook','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('education_insight_facebook_icon','fab fa-facebook')); ?>"></i>
								            </a>
								          <?php }?>
										<?php if( get_theme_mod('education_insight_twitter') != ''){ ?>
								            <a target="<?php echo $education_insight_header_twt_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('education_insight_twitter','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('education_insight_twitter_icon','fab fa-twitter')); ?>"></i>
								            </a>
								          <?php }?>
								          <?php if( get_theme_mod('education_insight_linkedin') != ''){ ?>
								            <a target="<?php echo $education_insight_header_linkedin_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('education_insight_linkedin','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('education_insight_linkedin_icon','fab fa-linkedin')); ?>"></i>
								            </a>
								          <?php }?>
								         <?php if( get_theme_mod('education_insight_pinterest') != ''){ ?>
								            <a target="<?php echo $education_insight_header_pinterest_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('education_insight_pinterest','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('education_insight_pinterest_icon','fab fa-pinterest-p')); ?>"></i>
								            </a>
								          <?php }?>
								         
									</div>
								<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
