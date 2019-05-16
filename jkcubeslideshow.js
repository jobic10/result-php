

(function($){

	var defaults = {
		slideshowmarkup: '<div><div class="side1"></div><div class="side2"></div></div></div>',
		pause: 0,
		fxduration: 1000,
		swipethreshold: [50, 300], // distance traveled within x milliseconds before it is considered a swipe [pixels, milliseconds]
		linktarget: '_new'
	}

	var transform3d = typeof $(document.documentElement).css('perspective') != "undefined" // test for support for 3D transform

	function setslidehtml(el, options){
		var slidehtml = ''
		if (el[1])
			slidehtml += '<a href="' + el[1] + '" target="' + options.linktarget + '">'
			slidehtml += '<img src="' + el[0] + '"/>'
		if (el[1])
			slidehtml +='</a>'
			return slidehtml
	}

	function constructTransform(deg, x, y, z){
		return 'rotateY(' + deg + 'deg) translate3D(' + x + 'px,' + y + 'px,' + z + 'px)'
	}

	window.jkcubeslideshow = function(settings){
		var thisinst = this
		var s = $.extend({}, defaults, settings)
		var transitionendCount = 0
		var transitioninProgress = false
		var preloadimages = []
		var curimage = 0
		var totalimages = s.images.length
		var $maincontainer = $('#' + s.id)
		if (s.dimensions && s.dimensions[0])
			$maincontainer.css({width: s.dimensions[0], height: s.dimensions[1]})
		var containerwidth = $maincontainer.width()
		$maincontainer.html(s.slideshowmarkup) // populate empty maincontainer with skeleton cube markup
		var mousemoveevtstr = 'mousemove.dragstart' + s.id + ' touchmove.dragstart' + s.id
		var mouseupevtstr= 'mouseup.dragend' + s.id + ' touchend.dragend' + s.id
		var dragdist
		var $innercontainer = $maincontainer.find('> div').css({transformStyle: 'preserve-3d'})
		var $sides = $innercontainer.find('> div')
		var animatetimer = null
		var autorotatetimer = null
		var autorotatepause = (transform3d)? s.pause + s.fxduration : s.pause
		var panelClasses ={
			frontpanel: 'rotateY(0deg) translate3D(0, 0, 0)',
			leftpanel: constructTransform(-90, -containerwidth/2, 0, containerwidth/2),
			rightpanel: constructTransform(90, containerwidth/2, 0, containerwidth/2),
			front_to_right: constructTransform(90, containerwidth/2, 0, containerwidth/2),
			front_to_left: constructTransform(-90, -containerwidth/2, 0, containerwidth/2),
			to_front: 'rotateY(0deg) translate3D(0, 0, 0)'
		}
			
		$maincontainer.data('info', {frontside: 0, otherside: 1, width: containerwidth, $sides: $sides})
		$sides
			.eq(0)
				.html( setslidehtml(s.images[0], s) ) // populate front slide with first image
				.css({transform: panelClasses.frontpanel})
				.end().eq(1).css({visibility: 'hidden'}) // hide other panel

		this.rotatecube = function(dir, autocall){ // Public method to rotate panel. 1st parameter = "back" or "forward"
			if (transform3d && transitioninProgress)
				return
			transitioninProgress = true
			if (typeof autocall == 'undefined')
				clearInterval(autorotatetimer)
			var dir = (dir == 'back')? 'right' : (dir == 'forward')? 'left' : dir // translate 'back' or 'forward' to 'right' and 'left' internally, respectively
			var nextimage = (dir == 'left')? (curimage < totalimages-1? curimage+1 : 0) : (curimage == 0? totalimages-1 : curimage-1)
			if (transform3d){
				var cubeinfo = $maincontainer.data('info')
				var curfront = cubeinfo.frontside
				var curotherside = cubeinfo.otherside		
				cubeinfo.$sides
					.css({transitionDuration: '0s'})
					.eq(cubeinfo.otherside)
						.html( setslidehtml(s.images[nextimage], s) )
						.css({visibility: 'visible', transform: dir=='right'? panelClasses.leftpanel : panelClasses.rightpanel})
				curimage = nextimage
				clearTimeout(animatetimer)
				animatetimer = setTimeout(function(){ // assign CSS3 classes to animate after 500 millisec delay
					cubeinfo.$sides
						.css({transitionDuration: s.fxduration + 'ms'})		
						.eq(curfront)
							.css({transform: dir=='right'? panelClasses.front_to_right : panelClasses.front_to_left})
						.end().eq(curotherside)
							.css({transform: panelClasses.to_front})
				}, 50)
			}
			else{ // no css3 3d transform, just change image
				$sides.eq(0)
					.html( setslidehtml(s.images[nextimage], s) )
					curimage = nextimage
			}
		}

		for (var i=0; i<s.images.length; i++){ // preload images
			preloadimages[i] = new Image()
			preloadimages[i].src = s.images[i][0]
		}

		if (s.pause > 0){
			autorotatetimer = setInterval(function(){
				thisinst.rotatecube('forward', true)
			}, autorotatepause)
		}

  	$maincontainer.on('mousedown touchstart', function(e){ // set up swipe/ mouse drag behavior
  		var e = (e.type.indexOf('touch') != -1)? e.originalEvent.changedTouches[0] : e
			var mousex = e.pageX
			var clicktime = new Date().getTime()
			dragdist = 0
  		$(document).on(mousemoveevtstr, function(e){
  			var e = (e.type.indexOf('touch') != '-1')? e.originalEvent.changedTouches[0] : e
  			dragdist=e.pageX-mousex //distance moved horizontally
  			return false //cancel default drag action
  		})
	  	$(document).on(mouseupevtstr, function(e){
	  		var e = (e.type.indexOf('touch') != -1)? e.originalEvent.changedTouches[0] : e
	  		$(document).unbind(mousemoveevtstr)
	  		$(document).unbind(mouseupevtstr)
				var dragtime = new Date().getTime() - clicktime
				if ( Math.abs(dragdist) > s.swipethreshold[0] && dragtime < s.swipethreshold[1] ){
					var dir = (dragdist < 0)? 'forward' : 'back'
					thisinst.rotatecube(dir)
				}
				return false
	  	})
  		return false //cancel default drag action
  	})

		$maincontainer.on('click', function(e){
			if (Math.abs(dragdist) > 0 && e.target.tagName == 'IMG') // cancel click on image link if dragdist is greater than 0
				return false
		})

		if (transform3d){
			$sides.on('transitionend webkitTransitionEnd', function(e){
				var $target = $(e.target) // target
				if (/transform/i.test(e.originalEvent.propertyName)){ // check event fired on "transform" prop
					transitionendCount++
					if (transitionendCount == 2){ // check transitionend has finished firing on both relevant panel DIVs
						var cubeinfo = $maincontainer.data('info')
						cubeinfo.otherside = cubeinfo.frontside // switch frontside and otherside panel assignments
						cubeinfo.frontside = (cubeinfo.otherside == 0)? 1 : 0					
						$sides
							.css({transitionDuration: '0s', transform: 'none'})
							//.removeClass('frontpanel leftpanel rightpanel front_to_right front_to_left to_front')
							.eq(cubeinfo.frontside)
								.css({transform: panelClasses.frontpanel})
							.end().eq(cubeinfo.otherside)
							.css({visibility: 'hidden'})
						transitionendCount = 0
						transitioninProgress = false
					}
	
				}
			}) // end transitionend
		}

	}


})(jQuery);