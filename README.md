# Bubble Art
Modern version of Koalas To The Max with simplified JavaScript, a PHP backend for generating the image, modern UI and integration with a random image API

## Choosing an image

### Upload image
Images can be uploaded at `/upload-img` and are stored on the server in the `img-uploaded` folder. File names are passed to `index.php` via the `upload` GET parameter to load the image. An example URL would look like:
```
www.example.com?upload=example.jpg
```

### Adding image via URL
Images can be loaded from an external with their URL by submitting the URL, with the protocol, at `/add-url`. The image is NOT downloaded on the server - the image is only loaded from the JavaScript when the page is loaded. The encoded URL is passed to `index.php` via the `url` GET parameter. An example URL would look like:
```
www.example.com?url=http%3A%2F%2Fimage-host.com%2Fimg.jpg
```

### Selecting a random image (default)
By default, if `index.php` is loaded without a `url` or `upload` parameter, a random image is chosen. There are 4 different ways of generating an image, which is selected by generating a random number.

1. A random image of an animal is generated from the Unsplash Random Image URL by requesting `https://source.unsplash.com/500x500/?pet`

2. A random image of city landscapes and landmarks is generated from the Unsplash Random Image URL by requesting `https://source.unsplash.com/500x500/?city,landmark`

3. A random image of a car is generated from the Unsplash Random Image URL by requesting `https://source.unsplash.com/500x500/?car`

4. A random image is selected from the `/img/` folder

## How it works

### Bubbles
All of the main logic for creating the bubbles is taken from the Koalas To The Max project. All of that JavaScript uses the D3.js library. All of these files for this are located in the `/bubble/` folder, which includes `bubble.css`, `bubble.js` and `d3.min.js`.

### Loading the image
The URL for the image is generated by the PHP in `index.php` and stored in the `$img` variable. The logic for generating the URL is described above. The `$img` variable is then outputted out to the JavaScript code at the bottom of the page.
```JavaScript
var file = '<?php echo $img; ?>';
```

The URL can either be a relative path on the same server or can be an absolute path on an external server. In order to support using a URL from an external server, the following line is used to allow a cross origin image:
```JavaScript
img.crossOrigin = "Anonymous";
```

### Unsplash Random Image API
The syntax for receiving a random image is as follows:
```
https://source.unsplash.com/{width}x{height}/?{search_query1},{search_query2}
```

That URL redirects to the URL of the random image, so needs to be returned to the program. Unsplash also provides a more advanced API which returns a detailed JSON response. For more information on both methods visit [Unsplash](https://source.unsplash.com).

The API can sometimes generate an image without a clear subject, which leads to a poor result when the bubbles are completed, which can make it hard to tell what the images are. This is the reason why the program generates some of its images from a set of pre-selected ones from the `/img/` folder and also why it gets images from specific catagories: animals, cityscapes/landmarks and cars. 

## Future Development
- Find a better solution to only loading clear images (see above)
- Improve the UI design for the nav menu and upload pages
- Show full image on completion with message

## Credits
Based on Koalas To The Max by Vadim Ogievetsky at https://github.com/vogievetsky/KoalasToTheMax
