$(document).ready(function(){

	var typed = new Typed("#command", {
		strings: ["Hello Guys :D", "Spade Was Here :p", "Thanks for visiting my Website.", "Enjoy!"],
		typeSpeed: 20
	});

	var index = 0;
	$(document).scroll(function(){
		var top = $('.technical').height() - $(window).scrollTop();
		if(top<-300){
			if(index == 0){
				$('.chart').easyPieChart({
					easing: 'easeOutBounce',
					onStep: function(from, to, percent){
						$(this.el).find('.percent').text(Math.round(percent));
					},
					lineCap: 'round',
					trackColor: '#bdc3c7',
					barColor: '#e74c3c',
					size: 152,
					scaleColor: '#bdc3c7',
					scaleLength: 5
				});
			}
			index++;
		}
	});
	
});