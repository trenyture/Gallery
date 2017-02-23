(function($,TM){

	var app = {
		init : function(){
			app.files_list.init();
			app.viewer.init();
		}
	};

	app.files_list = {
		init : function(){
			$('ul#files_list li a').click(function(){
				$('ul#files_list li.clicked').removeClass('clicked');
				$(this).parent().addClass('clicked');
				app.viewer.launch($(this).attr('href'),$(this).parent().data('orientation'),$(this).data('name'));
				return false;
			});
		}
	};

	app.viewer = {
		init : function(){
			$('aside').addClass('hidden');
			app.viewer.navigation.init();
		},
		launch : function(img,ort,name){
			$('aside article h2').html(name);
			console.log(ort);
			$('aside article img').attr({
				'src':img,
				'alt':name
			});
			$('aside').removeClass('hidden');
			TM.to($('aside'), 0.5, {ease: Circ.easeIn, opacity: 1});
		}
	};

	app.viewer.navigation = {
		init : function(){
			$('aside').append('<span class="lnr lnr-cross" id="close_aside"></span>');
			if($('ul#files_list li').length > 1){
				$('aside').append('<span class="lnr lnr-chevron-left" id="prev_slide"></span>');
				$('aside').append('<span class="lnr lnr-chevron-right" id="next_slide"></span>');
			}
			app.viewer.navigation.launch();
		},
		launch : function(){
			$('#close_aside').click(function(){
				$('ul#files_list li.clicked').removeClass('clicked');
				TM.to($('aside'), 0.5, {ease: Circ.easeIn, opacity: 0, onComplete:function(){
					$('aside').addClass('hidden');
					$('aside article h2').html('');
					$('aside article img').attr({
						'src':'',
						'alt':''
					});
				}});
			});
			$('#next_slide').click(function(){

			});
			$('#prev_slide').click(function(){

			});
			app.viewer.navigation.keyboard();
		},
		keyboard: function(){
			$(document).keydown(function(event) {
				if(!$('aside').hasClass('hidden')){
					switch(event.which) {
						//ESCAPE
						case 27:
							$('#close_aside').trigger('click');
							break;
						//ARROW LEFT
						case 37:
							$('#prev_slide').trigger('click');
							break;
						//ARROW RIGHT
						case 39:
							$('#next_slide').trigger('click');
							break;
						default:
							//Nothing
					}
				}
			});
		}
	};

	$(document).ready(function(){
		app.init();
	});

})(jQuery,TweenMax);