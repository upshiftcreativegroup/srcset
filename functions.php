<?php

// add new image sizes
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );


	// This is going to be our intermediate size between "large" (1024px wide) and "xl" below
	add_image_size( 'xl', 1400, 9999, false );

	// 2000px wide is going to be our max size that will ever show on pages
	add_image_size( 'xxl', 2000, 9999, false );
}





?>