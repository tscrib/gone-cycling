<?php
/*
* WordPress Sample function and action
* for loading scripts in themes
*/


// Let's hook in our function with the javascript files with the wp_enqueue_scripts hook
add_action( 'wp_enqueue_scripts', 'wptimca_load_javascript_files' );
 
// Register some javascript files, because we love javascript files. Enqueue a couple as well
function wptimca_load_javascript_files() {
 	wp_register_script( 'trackmytour', 'http://trackmytour.com/static/embed/tmt.js' );
 
	if ( is_front_page() ) {
		wp_enqueue_script( 'trackmytour' );
	}
}


// Fix compatibility issue between NextGen Gallery and this theme
function Display_Featured_Image_URL ($IMGid, $ImageSize)
{
     // Check to see if it's a NGG Featured Picture 
     if(stripos($IMGid,'ngg-') !== false && class_exists('nggdb'))
     {
          // So it is. Now, look for the ngg- tag and match it up with the Post's Image ID 
          $ParseNGG = nggdb::find_image(str_replace('ngg-','',$IMGid));
          // Get the URL of the NextGen Pic that was set as a Featured Pic
          $imageURL = array($ParseNGG->imageURL,$ParseNGG->width,$ParseNGG->height);
     } 
     else
     {
          // No NGG Picture used as featured, default to regular featured pic
           $imageURL = wp_get_attachment_image_src($IMGid,$ImageSize, true);
     }
return $imageURL;
 }

function TS_get_the_alt($IMGid)
{
	// Check to see if it's a NGG Featured Picture 
     if(stripos($IMGid,'ngg-') !== false && class_exists('nggdb'))
     {
		// So it is. Now, look for the ngg- tag and match it up with the Post's Image ID 
          $ParseNGG = nggdb::find_image(str_replace('ngg-','',$IMGid));
          // Get the URL of the NextGen Pic that was set as a Featured Pic
		$title = $ParseNGG-> alttext;
      } 
     else
     {
          // No NGG Picture used as featured, default to regular featured pic
           $title = get_post_meta($IMGid, '_wp_attachment_image_alt', true );
     }
	return $title;
}

// Modify the default snippet length
function custom_excerpt_length($length)
{
return 160;
}
add_filter('excerpt_length', 'custom_excerpt_length');


/* Load the Theme class. */
require_once (TEMPLATEPATH . '/framework/theme.php');

$theme = new Theme();
$theme->init(array(
	'theme_name' => 'Travel', 
	'theme_slug' => 'travel'
));

require_once (TEMPLATEPATH . '/travel/travel.php');
?>