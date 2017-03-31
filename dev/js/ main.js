function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

(function($,TM){
	var isAdmin = false;
	var app = {
		init : function(){
			if($('body').is("#administration")){isAdmin = true; app.administration.init(); }
			app.files_list.init();
			app.viewer.init();
		}
	};

	/*******************************
	* FILES LIST EVENTS
	*******************************/
	app.files_list = {
		init : function(){
			$('ul#files_list li a').click(function(){
				$('ul#files_list li.clicked').removeClass('clicked');
				$(this).parent().addClass('clicked');
				app.viewer.launch($(this).parent().data('type'),'storage/'+$(this).attr('href'),$(this).parent().data('orientation'),$(this).parent().data('name'));
				return false;
			});
		}
	};

	/*******************************
	* INITIALIZATION VIEWER
	*******************************/
	app.viewer = {
		init : function(){
			$('aside').addClass('hidden');
			app.viewer.navigation.init();
		},
		launch : function(type,src,ort,name){
			if (isAdmin === true){src = '../'+src;}
			$('aside article h2').html(name);
			if (type === 'image'){
				var newImg = '<img src="'+src+'" alt="'+name+'" />';
				$('aside article').append(newImg);
			}else{
				var newVideo = $('<video controls>');
				var source = document.createElement('source');
				source.setAttribute('src', src);
				newVideo.prepend(source);
				$('aside article').append(newVideo);
			}
			if($('aside').hasClass('hidden')){
				$('aside').removeClass('hidden');
				TM.to($('aside'), 0.5, {ease: Circ.easeIn, opacity: 1});
			}
		}
	};

	/*******************************
	* NAVIGATION SLIDES EVENTS
	*******************************/
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
				app.viewer.navigation.closingAside();
			});
			$('#next_slide').click(function(){
				app.viewer.navigation.changingSlide('next');
			});
			$('#prev_slide').click(function(){
				app.viewer.navigation.changingSlide('prev');
			});
			app.viewer.navigation.keyboard();
		},
		keyboard: function(){
			$(document).keydown(function(event) {
				if(!$('aside').hasClass('hidden')){
					switch(event.which) {
						//ESCAPE
						case 27:
							app.viewer.navigation.closingAside();
							break;
						//ARROW LEFT
						case 37:
							app.viewer.navigation.changingSlide('prev');
							return false;
						//ARROW RIGHT
						case 39:
							app.viewer.navigation.changingSlide('next');
							return false;
						//ARROW DOWN
						case 40:
							app.viewer.video.volumeUpDown('down');
							return false;
						//ARROW UP
						case 38:
							app.viewer.video.volumeUpDown('up');
							return false;
						//SPACE BAR
						case 32:
							if($('aside article video').length > 0){
								app.viewer.video.togglePlayPause();
							}
							return false;
						// F (fullscreen)
						case 70:
							if($('aside article video').length > 0){
								app.viewer.video.fullscreen();
							}
							return false;
						default:
							//NOTHING
					}
				}
			});
		},
		closingAside: function(){
			$('ul#files_list li.clicked').removeClass('clicked');
			if($('aside article video').length > 0){
				$('aside article video')[0].pause();
			}
			TM.to($('aside'), 0.5, {ease: Circ.easeIn, opacity: 0, onComplete:function(){
				$('aside').addClass('hidden');
				$('aside article').html('<h2></h2>');
			}});
		},
		changingSlide: function(which){
			var nIndex = 0;
			if($('aside article video').length > 0){
				$('aside article video')[0].pause();
			}
			$('aside article').html('<h2></h2>');
			if(which === 'prev'){
				if($('ul#files_list li.clicked').index() === 0){
					nIndex = $('ul#files_list li').length - 1;
				}else{
					nIndex = $('ul#files_list li.clicked').index() - 1;
				}
			}
			if(which === 'next'){
				if($('ul#files_list li.clicked').index() === $('ul#files_list li').length - 1){
					nIndex = 0;
				}else{
					nIndex = $('ul#files_list li.clicked').index() + 1;
				}
			}
			$('ul#files_list li').eq(nIndex).find('a').trigger('click');
		}
	};

	/*******************************
	* VIDEO PLAYER EVENTS
	*******************************/
	app.viewer.video = {
		togglePlayPause : function(){
			var video = $('aside article video')[0];
			if (video.paused) {
				video.play();
			} else {
				video.pause();
			}
		},
		fullscreen : function(){
			var video = $('aside article video')[0];
			if (video.requestFullscreen) {
				video.requestFullscreen();
			} else if (video.mozRequestFullScreen) {
				video.mozRequestFullScreen();
			} else if (video.webkitRequestFullscreen) {
				video.webkitRequestFullscreen();
			}
		},
		volumeUpDown: function(direction){
			var video = $('aside article video')[0],
				nVol = 0.5;
			if (direction === 'up' && video.volume < 1){
				nVol = video.volume + 0.1;
				video.volume = nVol > 1 ? 1 : nVol;
			}
			if (direction === 'down' && video.volume > 0){
				nVol = video.volume - 0.1;
				video.volume = nVol < 0 ? 0 : nVol;
			}
		}
	};

	app.administration = {
		init: function(){
			if($('body > section').is('#newadmin')){ app.administration.newAdmin(); }
			if($('body > section').is('#connexion')){ app.administration.connexion(); }
			if($('body > section').is('#otheradmin')){ app.administration.otherAdmin(); }
			// FORMS
			if($('body form').length > 0){ app.administration.forms(); }
		},
		newAdmin : function(){
			$('body form').submit(function(event){
				var error = false,
					message = '';
				if ($(this).find('input#pseudo').val() === ''){
					error = true;
					message += '<li>You have to write an Username!</li>';
				}
				if ($(this).find('input#mail').val() === ''){
					error = true;
					message += '<li>You have to write an email!</li>';				
				}else{
					if (!validateEmail($(this).find('input#mail').val())) {
						error = true;
						message += '<li>You have to write a <b>valid</b> email!</li>';
					}else{
						if($(this).find('input#mail').val() !== $(this).find('input#mail_two').val()){
							error = true;
							message += '<li>You had written two different emails!</li>';
						}
					}
				}
				if($(this).find('input#pass').val() === ''){
					error = true;
					message += '<li>You have to write a Password</li>';
				}else{
					if ($(this).find('input#pass').val() !== $(this).find('input#pass_two').val()){
						error = true;
						message += '<li>You had written two different Passwords!</li>';
					}
				}
				if (error === true){
					event.preventDefault();
					if($('ul#error_msg').length > 0){
						$('ul#error_msg').html(message);
					}else{
						$('h1').after('<ul id="error_msg">'+message+'</ul>');
					}
				}
			});
		},
		otherAdmin: function(){
			$('body form').submit(function(event){
				var error = false,
					message = '';
				if($(this).find('input#adminName').val() === ''){
					error = true;
					message += '<li>You have to write your admin name</li>';
				}
				if($(this).find('input#adminPwd').val() === ''){
					error = true;
					message += '<li>You have to write your admin password</li>';
				}
				if($(this).find('input#newAdminName').val() === ''){
					error = true;
					message += '<li>You have to write a new admin name</li>';
				}
				if ($(this).find('input#newAdminMail').val() === ''){
					error = true;
					message += '<li>You have to write an email!</li>';				
				}else{
					if (!validateEmail($(this).find('input#newAdminMail').val())) {
						error = true;
						message += '<li>You have to write a <b>valid</b> email!</li>';
					}else{
						if($(this).find('input#newAdminMail').val() !== $(this).find('input#verifNewAdminMail ').val()){
							error = true;
							message += '<li>You had written two different emails!</li>';
						}
					}
				}
				if($(this).find('input#newAdminPwd').val() === ''){
					error = true;
					message += '<li>You have to write a new admin password</li>';
				}else{
					if ($(this).find('input#newAdminPwd').val() !== $(this).find('input#verifNewAdminPwd').val()){
						error = true;
						message += '<li>You had written two different Passwords!</li>';
					}
				}
				if (error === true){
					event.preventDefault();
					if($('ul#error_msg').length > 0){
						$('ul#error_msg').html(message);
					}else{
						$('h1').after('<ul id="error_msg">'+message+'</ul>');
					}
				}
			});
		},
		connexion: function(){
			$('body form').submit(function(event){
				var error = false,
					message = '';
				if ($(this).find('input#ident').val() === ''){
					error = true;
					message += '<li>You have to write an Username!</li>';
				}
				if ($(this).find('input#pass').val() === ''){
					error = true;
					message += '<li>You have to write a Password</li>';
				}
				if (error === true){
					event.preventDefault();
					if($('ul#error_msg').length > 0){
						$('ul#error_msg').html(message);
					}else{
						$('h1').after('<ul id="error_msg">'+message+'</ul>');
					}
				}
			});
		},
		forms: function(){
			$('body form input').each(function(){
				if ($(this).val() !== '') {
					$(this).parent().addClass('focussed');
				}
			});
			$('body form input').focus(function(){
				if (!$(this).parent().hasClass('focussed')){
					$(this).parent().addClass('focussed');
				}
			});
			$('body form input').focusout(function(){
				if ($(this).val() === ''){
					$(this).parent().removeClass('focussed');
				}
			});
		}
	};

	$(document).ready(function(){
		app.init();
	});

})(jQuery,TweenMax);