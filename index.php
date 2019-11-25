<?php

// a function to make a thumbnail
function make_thumb( $src, $dest, $desired_width ) {

	/* read the source image */
	$source_image = imagecreatefromjpeg( $src );
	$width = imagesx( $source_image );
	$height = imagesy( $source_image );
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor( $height * ( $desired_width / $width ) );
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor( $desired_width, $desired_height );
	
	/* copy source image at a resized size */
	imagecopyresampled( $virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height );
	
	/* create the physical thumbnail image to its destination */
	imagejpeg( $virtual_image, $dest, 100 );

}


// a function to check if we're running CLI or in browser.
function is_cli() {
	return defined( 'STDIN' );
}


if ( !is_cli() ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Photo Gallery</title>
	<style>
	body {
		margin: 0;
		padding: 0;
		background-color: #313131;
	}
	
	.photo {
		float: left;
		width: 50%;
		background-size: cover;
		background-position: center center;
		box-sizing: border-box;
	}
	.no-touch .photo {
		filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 10+, Firefox on Android */
		filter: gray; /* IE6-9 */
		-webkit-filter: grayscale( 100% ); /* Chrome 19+, Safari 6+, Safari 6+ iOS */
		opacity: .7;
		transition: all 400ms ease-in-out;
	}
	.no-touch .photo:hover {
	    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
		-webkit-filter: grayscale(0%);
		opacity: 1;
	}

	@media screen and ( min-width: 768px ) {
		.photo { width: 33.3333%; }
	}
	@media screen and ( min-width: 1023px ) {
		.photo { width: 25%; }
	}
	@media screen and ( min-width: 1220px ) {
		.photo { width: 20%; }
	}

	.photo:after {
		content: "";
		display: block;
		padding-bottom: 100%;
	}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>
<?php
}


// scan the current directory to get a list of files.
$photos = scandir( '.' );


if ( is_cli() ) print "Generating thumbnails...\n";

// if there are photos in the same directory as this script
if ( !empty( $photos ) ) {

	// loop through the photos array
	foreach ( $photos as $photo ) {

		// get the extension
		$path = './' . $photo;
		$ext = pathinfo( $path, PATHINFO_EXTENSION );

			// only output tiles for image files.
			if ( in_array( $ext, array( 'png', 'jpg', 'jpeg' ) ) && substr( $photo, 0, 1 ) != '_' ) { 

			$thumb = './_' . $photo;
			if ( !file_exists( $thumb ) ) {
				make_thumb( $path, $thumb, '300' );
				if ( is_cli() ) print "Thumbnail created: " . $thumb . ".\n";
			} else {
				if ( is_cli() ) print "Thumbnail exists: " . $thumb . ".\n";
			}

			if ( !is_cli() ) {
				?><a href="<?php print $photo ?>" class="photo" style="background-image: url(_<?php print $photo ?>);"></a><?php
			}
		}
	}
}

if ( !is_cli() ) {
?>
<div style="clear: both"></div>
</body>
</html>
<?php
}


?>