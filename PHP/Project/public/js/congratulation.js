function Congratulation() {
	
	$('#congrats_bg').show();

	var numberOfStars = 20;							
	for (var i = 0; i < numberOfStars; i++) {
		$('.congrats').append('<div class="blob fa fa-star ' + i + '"><img src="image/star.png" width="30px"></div>');
	}	
	animateText();
								
	animateBlobs();
							

	$('#congrats_bg').delay(2000).fadeOut(300);
							
}

function animateText() {
	TweenMax.from($('h5'), 0.8, {
		scale: 0.4,
		opacity: 0,
		rotation: 15,
		ease: Back.easeOut.config(4),
	});
}
								
function animateBlobs(i) {
								
	var xSeed = _.random(350, 380);
	var ySeed = _.random(120, 170);
								
	$.each($('.blob'), function() {
		var $blob = $(this);
		var speed = _.random(1, 2);
		var rotation = _.random(5, 100);
		var scale = _.random(0.8, 1.5);
		var x = _.random(-xSeed, xSeed);
		var y = _.random(-ySeed, ySeed);

		TweenMax.to($blob, speed, {
			x: x,
			y: y,
			ease: Power1.easeOut,
			opacity: 0,
			rotation: rotation,
			scale: scale,
			onStartParams: [$blob],
			onStart: function($element) {
				$element.css('display', 'block');
			},
			onCompleteParams: [$blob],
			onComplete: function($element) {
				$element.css('display', 'none');
			}
		});
	});
}