<?php
/*This file is part of sydney-child, sydney child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function sydney_child_enqueue_child_styles() {
$parent_style = 'parent-style'; 
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 
		'child-style', 
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version') );
	}
add_action( 'wp_enqueue_scripts', 'sydney_child_enqueue_child_styles' );

/*Write here your own functions */
// add new section

function mytheme_customize_register( $wp_customize ) {
	//All our sections, settings, and controls will be added here
	$wp_customize->add_section( 'bwpy_theme_colors', array(
		'title' => __( 'Theme Colors', 'bwpy' ),
		'priority' => 100,
	) );
	
	// add color picker setting
	$wp_customize->add_setting( 'link_color', array(
		'default' => '#ff0000'
	) );
	
	// add color picker control
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label' => 'Link Color',
		'section' => 'bwpy_theme_colors',
		'settings' => 'link_color',
	) ) );
 }
 add_action( 'customize_register', 'mytheme_customize_register' );
 

function mytheme_customize_css()
{
    ?>
         <style type="text/css">
             h2,h3 { color: <?php echo get_theme_mod('header_color', '#252525'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');

function bwpy_customizer_head_styles() {
	$link_color = get_theme_mod( 'link_color' ); 
	
	if ( $link_color != '#ff0000' ) :
	?>
		<style type="text/css">
			a {
				color: <?php echo $link_color; ?> !important;
			}
		</style>
	<?php
	endif;
}
add_action( 'wp_head', 'bwpy_customizer_head_styles' );

?>

