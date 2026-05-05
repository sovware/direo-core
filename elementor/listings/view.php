<?php
/**
 * Description.
 *
 * @package WordPress
 * @author  WpWax
 * @since   1.0
 * @version 1.0
 */

use Directorist\Helper;

if ( ! class_exists( 'Directorist_Base' ) ) {
	return;
}

$atts = [
    'header'            => $settings['header'],
    'show_pagination'   => $settings['show_pagination'],
    'header_title'      => $settings['title'],
    'advanced_filter'   => $settings['filter'],
    'view'              => $settings['layout'],
    'listings_per_page' => $settings['number_cat'],
    'columns'           => $settings['row'],
    'category'          => $settings['cat'] ? implode( ',', $settings['cat'] ) : '',
    'location'          => $settings['location'] ? implode( ',', $settings['location'] ) : '',
    'tag'               => $settings['tag'] ? implode( ',', $settings['tag'] ) : '',
    'featured_only'     => $settings['featured'],
    'popular_only'      => $settings['popular'],
    'orderby'           => $settings['order_by'],
    'order'             => $settings['order_list'],
    'map_height'        => $settings['map_height'],
    'user'              => $settings['user'],
    'btn'               => $settings['view_more_url'],
    'sidebar'           => $settings['sidebar'],
    'is_elementor'      => true,
];

$section_title   = $settings['section_title'];
$view_more_label = $settings['view_more_label'];

if ( Helper::multi_directory_enabled() ) {
    if ( $settings['types'] ) {
        $atts['directory_type'] = $settings['types'];
    }
    if ( $settings['default_types'] ) {
        $atts['directory_type'] = $settings['default_types'];
    }
}

if ( ! empty( $settings['view_more_url'] ) ) {
	$attr  = 'href="' . $settings['view_more_url']['url'] . '"';
	$attr .= ! empty( $settings['view_more_url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= ! empty( $settings['view_more_url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( 'carousel' === $settings['layout'] ) {
	add_filter( 'all_listings_wrapper', 'all_listings_wrapper' );
	add_filter( 'all_listings_column', function(){ return ''; } );
	
	if ( $section_title || $view_more_label ) { ?>
		<div class="all_listing_header">
			<h1><?php echo esc_html( $section_title ); ?></h1>
			<a <?php echo $attr; ?>> <?php echo esc_html( $view_more_label ); ?> </a>
		</div>
		<?php
	}
}
?>

<div id="<?php echo esc_attr( 'listing-' . $layout ); ?>">
	<?php direo_wpwax_run_shortcode( 'directorist_all_listing', $atts ); ?>
</div>
