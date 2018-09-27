<?php 

$img = get_field('image'); // This is an image array from Advanced Custom Fields
$img_html = '';

if(!empty($img)) {

	// Setting the assigns higher res images per selected srcset breakpoint

	$img_srcset = wp_get_attachment_image_srcset( $img['id'], 'xxl' );
	$img_sizes = wp_get_attachment_image_sizes( $img['id'], 'full' ); 

	// The initial src attribute is WP's lowly "medium" size. The data-src attribute loads on an event and is high res to accomodate for browsers that don't support srcset (IE 11).

	// Avoid values for the initial srcset attribute as browsers would front load from that attribute.

	$img_html = '<img src="'.$img['sizes']['medium'].'" srcset="" data-src="'.$img['sizes']['xl'].'" data-srcset="'.$img_srcset.'" sizes="'.$img_sizes.'" alt="'.$img['alt'].'" class="lazy_waypoint">'.$img_html.'</div>';

}




?>