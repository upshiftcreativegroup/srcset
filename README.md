# Responsive and lazy loading images


## The objectives of setting up images this way include
- Serving responsive image appropriate to user screen size
- Accomodate for retina or high DPI screens
- Staggering the loading of images via *waypoints.js* to miminize front-loading of data on page load
- Front-loading low-res images to provide a progressive loading effect and to minimize DOM thrash



## Included components
- Establish additional image sizes in *functions.php* (WordPress)
- `<img>` tag output php in template file(s) (WordPress)
- Dependency-free JS to trigger image load (jQuery equivalent also included in case you're into that)
- Waypoints 4.0.1: dependency-free and jQuery variants



## Explain

This template PHP uses WordPress methods to call values for the **srcset** and **sizes** attributes:

```
$img = get_field('image'); // image array

$img_srcset = wp_get_attachment_image_srcset( $img['id'], 'xxl' );
$img_sizes = wp_get_attachment_image_sizes( $img['id'], 'xxl' );
```


Here is the **srcset** value output:
```
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-300x188.jpg 300w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-768x480.jpg 768w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-1024x640.jpg 1024w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-1400x875.jpg 1400w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-2000x1250.jpg 2000w,
```


And the the **sizes** value output; at browser widths of 2000px and higher, users will be served the 2000px image.
```
(max-width: 2000px) 100vw, 2000px
```


It would be more retina-friendly if the **sizes** attribute showed larger images per srcset increment (above). So offset the **sizes** attribute with the next largest image size:
```
$img_sizes = wp_get_attachment_image_sizes( $img['id'], 'full' ); // instead of "xxl"; sorry, magic mike.
```


Here's the rest of the template PHP that incorporates the **srcset** and **sizes** attributes into the `<img>` element:
```
$img_html = '<img src="'.$img['sizes']['medium'].'" srcset="" data-src="'.$img['sizes']['xl'].'" data-srcset="'.$img_srcset.'" sizes="'.$img_sizes.'" alt="'.$img['alt'].'" class="lazy_waypoint">'.$img_html.'</div>';
```


Final image output, where the higher quality image+srcset images will be loaded in via [waypoints implementation](#waypoints-implementation):
```
<img
src="https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-300x188.jpg"
srcset=""
data-src="https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-1400x875.jpg"
data-srcset="
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-300x188.jpg 300w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-768x480.jpg 768w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-1024x640.jpg 1024w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-1400x875.jpg 1400w,
https://upshiftdemo.com/wp-content/uploads/2049/10/big_image-2000x1250.jpg 2000w,
"
sizes="
(max-width: 5500px) 100vw, 5500px" alt="" class="lazy_waypoint
">
```

#Waypoints Implementation


Get the images to be lazy-loaded, loop through them and create a waypoint for each one.

Full JS:
```
// Get all elements to be lazy-loaded, by ".lazy_waypoint" class
var imgEl = document.getElementsByClassName('lazy_waypoint');

for (var i=0; i<imgEl.length; i++) {


	// Create waypoints for each elements
	var waypoint = new Waypoint({
		element: imgEl[i],
		handler: function(direction) {

			var thisEl = this.element;

			// Get data-src and data-srcset attribute values and set them to the element's src and srcset attributes
			if(thisEl.getAttribute('data-src'))
				thisEl.setAttribute('src',thisEl.getAttribute('data-src'));

			if(thisEl.getAttribute('data-srcset'))
				thisEl.setAttribute('srcset',thisEl.getAttribute('data-srcset'));

			this.destroy();
		},
		offset: '100%'
	});
}

```


### To-do
- Test XD

