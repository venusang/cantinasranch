var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

jQuery(function() {

	// Text field clearing on focus
	jQuery('.blink').focus(function(){
		if( jQuery(this).val() == jQuery(this).attr('title') ) {
			jQuery(this).val('');
		}
	}).blur(function(){
		if( jQuery(this).val() == '' ) {
			jQuery(this).val( jQuery(this).attr('title') );
		}
	});

	jQuery('.gallery a').colorbox({
		maxWidth:'98%',
		maxHeight:'98%'
	});

	jQuery('nav li.has-dd').hover(function() {
		jQuery(this).toggleClass('hover').find('ul:first').stop(true,true).slideToggle(300);
	});
	
	if($('#countdown').length) {
        var austDay = new Date();
        var date_str = jQuery('#countdown h4 span').text().replace(',', '').split(' ');

        var month_str = date_str[0];
        for(i=0;i<months.length;i++) {
            if(months[i] == month_str) {
                var austMonth = i;
            }
        }
        
        var austDate = parseInt(date_str[1]);
        var austYear = parseInt(date_str[2]);
        var austHours = parseInt(date_str[3]);
        var austMinutes = parseInt(date_str[4]);
        var austTimeZone = parseInt(date_str[5]);
        var austTimeZone = austTimeZone / 60 / 60;
        
        austDay = new Date(austYear, austMonth, austDate, austHours, austMinutes);
        jQuery('#countdown h4').find('span').countdown({until: austDay, timezone: austTimeZone});
    }

    AudioPlayer.setup(rebirth + "/media/player.swf", {
        leftbg: 'ffffff',
        bg: 'ffffff',
        voltrack: 'ffffff',
        rightbghover: 'ffffff',
        righticon: 'ffffff',
        border: 'ffffff',
        volslider: audioPlayerColor,
        lefticon: audioPlayerColor,
        rightbg: audioPlayerColor,
        loader: audioPlayerColor,
        righticonhover: audioPlayerColor
    });  

    if($('.player-container').length) {
        $('.player-container').each(function() {
            var sound_path = $(this).find('.notext').html();
            var sound_id = $(this).attr('id');
            var sound_width = $(this).width();

            var n = navigator.userAgent;
            if(n.match(/iPhone/i) || n.match(/iPad/i) || n.match(/Android/i) || n.match(/android/i)) {
                $("#" + sound_id).append('<audio src="' + sound_path + '" controls="controls" style="width:100%" />');
            } else {
            	$(this).find('audio').remove();

            	if( $(this).find('.flash-player').size() ) {
            		sound_id = 'audio-player-' + (Math.round(Math.random()*999));
            		$(this).find('.flash-player div').attr('id', sound_id);
            	}
                AudioPlayer.embed(sound_id, {
                    soundFile: sound_path,
                    width: sound_width,
                    transparentpagebg: 'yes'
                });
            }
        });
    } 

	jQuery('#slider .slide-link').on('click', function() {
		if(jQuery(this).find('.audio').length) {
			if (audio_link != 1) {
				var p = $(this).parents('li').find('.players');
				var n = navigator.userAgent;
				if(n.match(/iPhone/i) || n.match(/iPad/i) || n.match(/Android/i) || n.match(/android/i)) {
					p.html(p.html()).animate({ bottom: 0 });
					p.find('audio')[0].play();
					$(this).fadeOut();
					return false;
				} else {
					/*
					autoPermOff = true;
				
					jQuery(this).parent().find('.players').animate({
						bottom: 0
					}, {
						duration: 400,
						queue: false,
						complete: function() {
							if (true || jQuery.browser.msie && jQuery.browser.version < 9) {
								var container = jQuery(this).find('.flash-player:eq(0)');
								loadFlashPlayer(container, 900, 'audioPlayer1');
								container.parent().find('audio').hide();
							} else {
								jQuery(this).find('.APV1_play_button').trigger('click');
							};
						}
					});
					*/
					autoPermOff = true;
	                var audio_string = $(this).find('.notext').html();
	                var player_html = '<div id="slider-audio" />';
	                p.find('.flash-player').html(player_html).siblings('.audio-container').hide();

					p.animate({
						bottom: 0
					}, {
						duration: 400,
						queue: false,
						complete: function() {
		                    AudioPlayer.embed('slider-audio', {
		                        soundFile: audio_string,
		                        width: 900,
		                        transparentpagebg: 'yes',
		                        autostart: 'yes'
		                    });							
						}
					});

					homeSlider.stopAuto();
				}
				jQuery(this).fadeOut(400)
				return false;
			}
		} else if(jQuery(this).find('.video').length) {
			if (video_link != 1){
			
				autoPermOff = true;
			
				var vid_string = jQuery(this).find('.notext').html();
				if(jQuery(this).find('.video').attr('rel') == 'youtube') {
					var vid_html = '<iframe width="940" height="410" src="http://www.youtube.com/embed/' + vid_string + '?rel=0&amp;autoplay=1&amp;wmode=transparent" frameborder="0"></iframe>';
				} else if(jQuery(this).find('.video').attr('rel') == 'vimeo') {
					var vid_html = '<iframe src="http://player.vimeo.com/video/' + vid_string + '?title=0&amp;autoplay=1&amp;byline=0&amp;portrait=0" width="940" height="410" frameborder="0"></iframe>';
				}
	
				jQuery(this).fadeOut(300);
				jQuery(this).parent().css('background', 'black').find('img').fadeOut(300);
				jQuery(this).parent().find('.caption').animate({
					top: '-100px'
				}, {
					duration: 300,
					complete: function() {
						jQuery(this).parent().append(vid_html);
					}
				});
	
				return false;
			}
		} else if(jQuery(this).find('.map').length) {
			$(this).parents('li').find('iframe').fadeIn();
			return false;
		}
	});

	jQuery('#recent a').hover(function() {
		if(!jQuery(this).hasClass('clicked')) {
			jQuery(this).find('.overlay').animate({
				opacity: 0.3
			}, {
				duration: 200,
				queue: false
			});
			jQuery(this).find('.icon').animate({
				marginTop: '-32px'
			}, {
				duration: 200,
				queue: false
			});
		}
	}, function() {
		if(!jQuery(this).hasClass('clicked')) {
			jQuery(this).find('.overlay').animate({
				opacity: 0
			}, {
				duration: 200,
				queue: false
			});
			jQuery(this).find('.icon').animate({
				marginTop: 75
			}, {
				duration: 200,
				queue: false
			});
		}
	});

	jQuery('#recent .three-quarters a').bind('click', function(e) {
	
		if(jQuery(e.target).parents('a:eq(0)').find('.audio').length && jQuery(e.target).parents('a:eq(0)').hasClass('clicked') == false) {
		
			if (audio_link != 1){

				jQuery(e.target).parents('a:eq(0)').addClass('clicked');
	
				jQuery(e.target).parents('a:eq(0)').find('.icon').animate({
					marginTop: '-52px'
				}, {
					duration: 200,
					queue: false
				});

				jQuery(e.target).parents('a:eq(0)').find('.mini-player').animate({
					bottom: 10
				}, {
					duration: 200
				});

            	if( !$(this).find('audio').size() ) {
            		var sound_id = 'sound-' + (Math.round(Math.random()*9999));
            		$(this).find('.flash-player').html('<div id="' + sound_id + '" />');
	                AudioPlayer.embed(sound_id, {
	                    soundFile: $(this).find('.notext').text(),
	                    width: $(this).width(),
	                    transparentpagebg: 'yes',
	                    autostart: 'yes'
	                });
            	}

			} else { document.location = jQuery(this).attr('href'); }
			
		} else if(jQuery(e.target).parents('a:eq(0)').find('.video').length) {
		
			if (video_link != 1){
			
				var vid_string = jQuery(this).find('.icon .notext').html();
	
				if(jQuery(this).find('.video').attr('rel') == 'youtube') {
					var vid_href = 'http://www.youtube.com/embed/' + vid_string + '?rel=0&amp;autoplay=1&amp;wmode=transparent';
				} else if(jQuery(this).find('.video').attr('rel') == 'vimeo') {
					var vid_href = 'http://player.vimeo.com/video/' + vid_string + '?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0';
				}
	
				$.colorbox({
					href: vid_href,
					width: 920,
					height: 563,
					iframe: true
				});

			} else { document.location = jQuery(this).attr('href'); }
			
		} else if(jQuery(this).find('.gallery').length) {
			document.location = jQuery(this).attr('href');
		} else if(jQuery(this).find('.post').length) {
			document.location = jQuery(this).attr('href');
		}
		
		return false;
	
	});

	jQuery('#upcoming a').hover(function() {
		jQuery(this).find('.overlay').animate({
			opacity: 0.3
		}, {
			duration: 200,
			queue: false
		});
	}, function() {
		jQuery(this).find('.overlay').animate({
			opacity: 0
		}, {
			duration: 200,
			queue: false
		});
	});

	jQuery(window).load(function() {
		if(jQuery('#slider').length) {
			init_slider();
		}

		if(jQuery('#share-area').length) {
			jQuery('#share-area').css('opacity', 0.5).animate({
				marginLeft: '-605px'
			},function(){
				jQuery(this).css('z-index',10);
			});

			jQuery('#share-area').hover(function() {
				jQuery(this).animate({
					opacity: 0.9
				}, {
					duration: 200,
					queue: false
				});
			}, function() {
				jQuery(this).animate({
					opacity: 0.5
				}, {
					duration: 200,
					queue: false
				});
			});

			jQuery(window).scroll(function() {
				if(jQuery(window).scrollTop() > 150) {
					jQuery('#share-area').css({
						position: 'fixed',
						top: 30
					});
				} else {
					jQuery('#share-area').css({
						position: 'absolute',
						top: 180
					});
				}
			});
		}
	});
	
	/* Ajax Contact form validation and submit */
	jQuery('form#contactForm').submit(function() {
		jQuery(this).find('.error').remove();
		var hasError = false;
		jQuery(this).find('.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				if (jQuery(this).is('textarea')){
					jQuery(this).parent().addClass('input-error');
				} else {
					jQuery(this).addClass('input-error');
				}
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					jQuery(this).addClass('input-error');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			jQuery(this).find('#born-submit').fadeOut('normal', function() {
				jQuery(this).parent().parent().find('.sending-message').show('normal');
			});
			var formInput = jQuery(this).serialize();
			var contactForm = jQuery(this);
			jQuery.ajax({
				type: "POST",
				url: jQuery(this).attr('action'),
				data: formInput,
				success: function(data){
					contactForm.parent().fadeOut("normal", function() {
						jQuery(this).prev().prev().show('normal'); // Show success message
					});
				},
				error: function(data){
					contactForm.parent().fadeOut("normal", function() {
						jQuery(this).prev().show('normal');  // Show error message
					});
				}
			});
		}
		
		return false;
		
	});
	
	jQuery('.requiredField').blur(function() {
		if(jQuery.trim(jQuery(this).val()) != '' && !jQuery(this).hasClass('email')) {
			if (jQuery(this).is('textarea')){
				jQuery(this).parent().removeClass('input-error');
			} else {
				jQuery(this).removeClass('input-error');
			}
		} else {
			if (jQuery(this).is('textarea')){
				jQuery(this).parent().addClass('input-error');
			} else {
				jQuery(this).addClass('input-error');
			}
		}
	});
	
	jQuery('.email').blur(function() {
		var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		if(emailReg.test(jQuery.trim(jQuery(this).val())) && jQuery(this).val() != '') {
			jQuery(this).removeClass('input-error');
		} else {
			jQuery(this).addClass('input-error');
		} 
	});
	
});

function page_loaded() {
	jQuery('nav > ul li').each(function() {
		if(jQuery(this).find('ul').length) {
			jQuery(this).addClass('has-dd').find('li:last').addClass('last');
		}
	});

	if(jQuery('#slider').length) {
		load_slider();
	}

	if(jQuery('#recent').length) {
		jQuery('#recent .overlay').css('opacity', 0);
	}

	if(jQuery('#upcoming').length) {
		jQuery('#upcoming .overlay').css('opacity', 0);
	}

	if(jQuery('.entry aside').length) {
		jQuery('.entry aside').each(function() {
			jQuery(this).find('img').wrap('<span class="thumbnail" />');
		});
	}

	if(jQuery('#recent audio').length) {
		jQuery('#recent audio').attr('width', 200);
	}

	if (video_link != 1){
		if(jQuery('#recent span.video').length) {
			jQuery('#recent span.video').each(function() {
				if(jQuery(this).find('.notext').text().indexOf('www.') != -1) {
					var remove_www = jQuery(this).text().toString().replace('www.', '');
					jQuery(this).find('.notext').text(remove_www);
				}
				if(jQuery(this).find('.notext').text().indexOf('youtube') != -1) {
					jQuery(this).attr('rel', 'youtube');
					var replaced_string = jQuery(this).text().toString().replace('http://youtube.com/watch?v=', '');
					jQuery(this).find('.notext').text(replaced_string);
				} else if(jQuery(this).find('.notext').text().indexOf('youtu.be') != -1) {
					jQuery(this).attr('rel', 'youtube');
					var replaced_string = jQuery(this).text().toString().replace('http://youtu.be/', '');
					jQuery(this).find('.notext').text(replaced_string);
				} else if(jQuery(this).text().indexOf('vimeo') != -1) {
					jQuery(this).attr('rel', 'vimeo');
					var replaced_string = jQuery(this).text().toString().replace('http://vimeo.com/', '');
					jQuery(this).find('.notext').text(replaced_string);
				}
			});
		}
	}
	
}

function load_slider() {
	jQuery('#slider').addClass('loading').find('.container').css('opacity', 0);
	jQuery('#slider').after('<div class="dots" />');

	if(jQuery('#slider audio').length) {
		jQuery('#slider audio').attr('width', 900);
	}

	var slides_leng = jQuery('#slider .container li').length;
	for(i=0;i<slides_leng;i++) {
		jQuery('.dots').append('<span />');
	}
	jQuery('#slider .overlay').css({ opacity: 0 });
	jQuery('#slider .caption').css({ top : '-100px' });
}

function init_slider() {

	jQuery('.dots').slideDown(200);
	jQuery('#slider .container').animate({
		opacity: 1
	}, {
		duration: 800,
		easing: 'easeInOutQuint',
		complete: function() {
			jQuery('#slider').removeClass('loading');
			if (auto_cycle == 'yes'){ cycle_speed = cycle_speed; } else { cycle_speed = 0; }
			jQuery('#slider .container > ul').jcarousel({
				scroll: 1,
				auto: cycle_speed,
				animation: animation_speed,
				wrap: 'both',
				easing: 'easeInOutQuint',
				initCallback: function(carousel) {
					window.homeSlider = carousel;

					if (video_link != 1){
						if(jQuery('#slider span.video').length) {
							jQuery('#slider span.video').each(function() {
								if(jQuery(this).find('.notext').text().indexOf('www.') != -1) {
									var remove_www = jQuery(this).text().toString().replace('www.', '');
									jQuery(this).find('.notext').text(remove_www);
								}
								if(jQuery(this).find('.notext').text().indexOf('youtube') != -1) {
									jQuery(this).attr('rel', 'youtube');
									var replaced_string = jQuery(this).text().toString().replace('http://youtube.com/watch?v=', '');
									jQuery(this).find('.notext').text(replaced_string);
								} else if(jQuery(this).find('.notext').text().indexOf('youtu.be') != -1) {
									jQuery(this).attr('rel', 'youtube');
									var replaced_string = jQuery(this).text().toString().replace('http://youtu.be/', '');
									jQuery(this).find('.notext').text(replaced_string);
								} else if(jQuery(this).text().indexOf('vimeo') != -1) {
									jQuery(this).attr('rel', 'vimeo');
									var replaced_string = jQuery(this).text().toString().replace('http://vimeo.com/', '');
									jQuery(this).find('.notext').text(replaced_string);
								}
							});
						}
					}

					jQuery('#slider').hover(function() {
						jQuery(this).find('.overlay').animate({
							opacity: 0.3
						}, {
							duration: 300,
							queue: false
						});
						jQuery(this).find('.icon').animate({
							opacity:1
						}, {
							duration: 600,
							queue: false
						});
						jQuery('.jcarousel-prev').animate({
							left: 15
						}, {
							duration: 300,
							queue: false
						});
	
						jQuery('.jcarousel-next').animate({
							right: 15
						}, {
							duration: 300,
							queue: false
						});
						jQuery('#slider').find('.caption').animate({
							top: 0
						}, {
							duration: 300,
							queue: false
						});
						carousel.stopAuto();
					}, function() {
						jQuery(this).find('.overlay').animate({
							opacity: 0
						}, {
							duration: 300,
							queue: false
						});
						jQuery(this).find('.icon').animate({
							opacity:0
						}, {
							duration: 500,
							queue: false
						});
						jQuery('.jcarousel-prev').animate({
							left: -40
						}, {
							duration: 300,
							queue: false
						});
	
						jQuery('.jcarousel-next').animate({
							right: -40
						}, {
							duration: 300,
							queue: false
						});
						jQuery('#slider').find('.caption').animate({
							top: -100
						}, {
							duration: 300,
							queue: false
						});
						if (!autoPermOff) { carousel.startAuto(); }
					});

					jQuery('.dots span').live('click', function() {
						var dot_idx = jQuery(this).index() + 1;
						carousel.scroll($.jcarousel.intval(dot_idx));
					});
				},
				itemFirstInCallback: {
					onBeforeAnimation: function(carousel,item,idx,state) {
						if(state != 'init') {
							if(jQuery('#slider iframe').not('[src*=maps]').length) {
								jQuery('#slider iframe').not('[src*=maps]').fadeOut(300, function() {
									jQuery(this).parent().find('img, .slide-link').fadeIn(400);
									jQuery(this).remove();
								});
							}
							if(jQuery('#slider .players').length) {
								jQuery('#slider .players').animate({
									bottom: '-80px'
								}, {
									duration: 400,
									queue: false,
									complete: function() {
										jQuery(this).parent().find('img, .slide-link').fadeIn(400);
									}
								});
								$('#slider .flash-player').html('');
							}
						}
						jQuery('.dots span').eq(idx-1).addClass('current').siblings('.current').removeClass('current');
					}
				}
			});
		}
	});
}

function loadFlashPlayer(container, playerWidth, playerId) {
	var song = container.attr('rel');
	if (container.find('div').length == 0) {
		container.append('<div id="'+ playerId +'"></div>');
	};
	var flashvars = {};
	var params = {};
	var attributes = {};
	
	flashvars.autoLoad = "true";
	flashvars.autoPlay = "true";
	flashvars.repeat = "true";
	flashvars.volume = "1";
	flashvars.width = playerWidth;
	flashvars.song1url = song;
	// END SETUP
	
	params.play = "true";
	params.scale = "noscale";
	params.salign = "tl";
	params.wmode = "transparent";
	params.swliveconnect = "true";
	params.allowscriptaccess = "always";
	
	attributes.id = "mp3player";
	
	embedCode(playerId, playerWidth, flashvars, params, attributes);
	container.show();
}