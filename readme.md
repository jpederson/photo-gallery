## Photo Gallery
A simple all-in-one php photo gallery script intended to be simply dropped into a directory of photos. It displays all the photos (jpg/jpeg only) in a simple visual interface, generating thumbnails on the fly to make the gallery load fast.

145 lines of clean, well-commented php/html/css (no js). Enjoy!

![Preview](preview.gif)

Live demo: http://gallery.jpederson.com

*****

### Quick Install (cli)
To quickly install the script from the command line, navigate to the directory you'd like to install this script to (inside a folder of photos), and execute the following command.

```
curl -O https://raw.githubusercontent.com/jpederson/photo-gallery/master/index.php
```

And then, while you're in the command line, run the index.php file to generate all the thumbnails for this gallery. Continue reading to find out why php on the command line is preferred to using a web browser.

```
php index.php
```

*****

## Generating Thumbnails
There are two methods of generating thumbnails:

1. **Run the script in the command line. (preferred)** This method usually bypasses any script execution time limits in your PHP installation. The script is developed to detect when you're in the command line (CLI), and not output HTML, instead creating a log as it goes through and generates thumbnails of each image. This method is quicker, and will pre-generate all your thumbnails at once, so that when you view the gallery in a browser, it just works right away.
2. **Refresh the page several times** in a browser to generate thumbnails for a large number of images. This method is slower, and may take several refreshes, because the script may exceed the maximum execution time. Not to worry though, it skips images for which it has already created thumbnails, so each refresh, it just starts from the next image that needs a thumbnail, and will eventually make it through all the images.

*****

### Notes
The only important thing to note is that any photos whose filenames begin with an underscore (`_`) are ignored by the script - when thumbnails are generated, they're saved to filenames beginning with an underscore, so you can manually override your thumbnails by saving versions of your photos with an underscore in front of their filename. Equally, if you'd like to regenerate the thumbnials, just delete the `_` version of the photo, and the script will detect that the thumbnail was deleted (on the next pageload or script execution) and regenerate the thumbnail for that photo.

*****

Developed with love by [James Pederson](https://jpederson.com).