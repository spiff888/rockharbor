<?php global $theme; ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<?php echo $theme->render('meta'); ?>
<title><?php
	wp_title('|', true, 'right');

	// Add the blog name.
	bloginfo('name');

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && is_front_page()) {
		echo " | $site_description";
	}
	?></title>
<link rel="icon" href="<?php echo $theme->info('url'); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 8]>
<link rel="stylesheet" media="all" href="<?php echo $theme->info('base_url'); ?>/css/ie8.css" />
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" media="all" href="<?php echo $theme->info('base_url'); ?>/css/ie7.css" />
<![endif]-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<!--[if lte IE 8]>
<script src="<?php echo $theme->info('base_url'); ?>/js/iefixes.js"></script>
<![endif]-->
<script>
	jQuery(document).ready(function() {
		// core feeds
		jQuery('.core-events').each(function() {
			var self = jQuery(this);
			jQuery.ajax({
				url: self.data('core-feed-url'),
				type: 'get',
				dataType: 'jsonp'
			}).done(function(response, textStatus, jqXHR) {
				if (response.length === 0) {
					self.children('p').html('There are no upcoming events.');
					return;
				}
				self.empty();
				var lastStart = [];
				var months = ['January', 'February', 'March', 'April', 'May',
				'June', 'July', 'August', 'September', 'October', 'November',
				'December'];

				if (self.data('core-limit') > 0) {
					response.length = parseInt(self.data('core-limit'));
				}
				for (var event in response) {
					var date = response[event].start.split(' ')[0].split('-');

					if (date.toString() != lastStart.toString()) {
						var time = document.createElement('time');
						var span = document.createElement('span');
						var month = span.cloneNode();
						month.className = 'month';
						month.innerHTML = months[parseInt(date[1]) - 1];
						var day = span.cloneNode();
						day.className = 'day';
						day.innerHTML = parseInt(date[2]);
						var year = span.cloneNode();
						year.className = 'year';
						year.innerHTML = date[0];
						time.appendChild(month);
						time.appendChild(day);
						time.appendChild(year);

						self.append(time);
					}

					lastStart = date;

					var a = document.createElement('a');
					a.target = '_blank';
					a.href = response[event].url;
					a.innerHTML = response[event].title;

					self.append(a);
				}
			}).fail(function() {
				self.children('p').html('There are no upcoming events.');
			});
		});

		// put galleries in lightboxes
		jQuery('.gallery').each(function() {
			var id = jQuery(this).attr('id');
			jQuery(this).find('.gallery-icon a').attr('rel', 'lightbox['+id+']');
		}).lightbox();

		jQuery('.flash-message').delay(5000).slideUp();
		jQuery('img')
			.removeAttr('width')
			.removeAttr('height');

		var preserveAspectRatio = function(container) {
			var element = $(container).find('video');
			if (element.length === 0 || typeof $(element)[0].player === 'undefined') {
				return;
			}
			var player = $(element)[0].player;
			var w = $(container).width();
			var h = w*9/16;
			player.setPlayerSize(w, h);
		}

		// improve media elements
		jQuery('video')
			.mediaelementplayer({
				pluginPath: '<?php echo $theme->info('base_url'); ?>/swf/',
				success: function(media, node) {
					if (media.pluginType !== 'native' && jQuery(node).attr('data-streamfile')) {
						media.setSrc(jQuery(node).attr('data-streamfile'));
						media.load();
					}
				}
			});
		jQuery('audio').mediaelementplayer({
			pluginPath: '<?php echo $theme->info('base_url'); ?>/swf/',
			audioWidth: 200,
			audioHeight: 20,
			features: ['playpause', 'progress', 'current']
		});

		if (jQuery('video').length > 0) {
			jQuery(window).resize(function() {
				jQuery('.embedded-video').each(function() {
					preserveAspectRatio(this);
				});
			});
		}

		jQuery(window).resize(function() {
			jQuery('.story-box').each(function() {
				var w = $(this).width();
				var h = w*9/16;
				$(this).css('height', h);
			});
		});
		jQuery(window).resize();

		// responsive breakpoints
		mediaCheck({
			media: '(max-width: 569px)',
			entry: RH.mobileEnter,
			exit: RH.mobileExit
		});
		mediaCheck({
			media: '(max-width: 1025px)',
			entry: RH.tabletEnter,
			exit: RH.tabletExit
		});

		jQuery('#access > ul > li').hover(function() {
			var menu = jQuery(this).children('.submenu');
			if (menu.length === 0) {
				return;
			}
			var pos = jQuery(this).position();
			var width = jQuery(window).width();
			if (pos.left + menu.width() > width) {
				menu.css({
					right: 0
				});
			}
		})
	});
</script>
<?php
echo $theme->render('analytics');