(function($){
	$(document).ready(function() {
		
		if( !(typeof $.farbtastic === 'function') ) {
			return;
		}
		
		$('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color_picker')
			.hide()
			.farbtastic('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color');
			
		var toggle_once_color_picker = function() {
			$('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color').one('click', function(){
				if($(this).val() == '') {
					$(this).val('#ffffff');
				}
				$('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color_picker')
					.slideToggle()
					.append('<a href="#" class="fcm-close-color-picker"><?php esc_html_e( 'Remove color', 'fcmpn' ); ?></a>');
			});
		};
		
		toggle_once_color_picker();
		
		$(document).on('click', '.fcm-close-color-picker', function(e){
			e.preventDefault();
			$('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color').val('').css({
				backgroundColor : '',
				color : ''
			});
			$('#<?php echo esc_attr(self::OPTION_NAME); ?>_notification_color_picker').slideToggle();
			$(this).remove();
			toggle_once_color_picker();
		});
	});
}(jQuery||window.jQuery));