## Photo Gallery
An all-in-one PHP photo gallery script intended to be simply dropped into a directory of images. It lists all the images in a simple visual interface, as well as generating thumbnails of each photo to make the gallery load quickly and be quick on mobile.

![Preview](preview.gif)

### Generating thumbnails.
There are two methods of generating thumbnails:

1. **Refresh the page several times** in a browser to generate thumbnails for a large number of images. This method is slower, and may take several refreshes, because the script may exceed the maximum execution time. Not to worry though, it skips images for which it has already created thumbnails, so each refresh, it just starts from the next image that needs a thumbnail, and will eventually make it through all the images.
2. **Run the script in the command line.** This usually bypasses any script execution time limits in your PHP installation. The script is developed to detect when you're in the command line (CLI), and not output HTML, instead creating a log as it goes through and generates thumbnails of each image. This method is quicker, and will generate all your thumbnails at once, so that when you view the gallery in a browser, it just works right away.

*****

Developed with love by [James Pederson](https://jpederson.com).