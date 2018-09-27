
var imgEl = document.getElementsByClassName('lazy_waypoint');

for (var i=0; i<imgEl.length; i++) {

	var waypoint = new Waypoint({
		element: imgEl[i],
		handler: function(direction) {

			var thisEl = this.element;

			if(thisEl.getAttribute('data-src'))
				thisEl.setAttribute('src',thisEl.getAttribute('data-src'));

			if(thisEl.getAttribute('data-srcset'))
				thisEl.setAttribute('srcset',thisEl.getAttribute('data-srcset'));

			this.destroy();
		},
		offset: '100%'
	});
}




/*
// jQuery equivalent


// $.waypoint() also acts as $.each()

if($('.lazy_waypoint')) {
	$('.lazy_waypoint').waypoint(function(direction) {
		
		var thisEl = $(this.element);

		thisEl.attr('src', (thisEl.data('src')));
		thisEl.attr('srcset', (thisEl.data('srcset')));

		this.destroy();
	}, {
		offset: '100%'
	});
}


*/



