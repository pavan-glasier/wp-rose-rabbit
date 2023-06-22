<?php
/**
 * Rose and Rabbit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rose_and_Rabbit
 */

// Custom Admin Color Scheme
function custom_color_admin_color_scheme()
{
	//Get the theme directory
	$theme_dir = get_stylesheet_directory_uri();
	//Custom Color
	wp_admin_css_color(
		'custom_color',
		__('Custom Color'),
		$theme_dir . '/custom-admin.css',
		array('#f2a5a2', '#f8f8f8', '#d54e21', '#f2a5a2')
	);
}
add_action('admin_init', 'custom_color_admin_color_scheme');



if (!function_exists('rose_and_rabbit_register_nav_menu')) {

	function rose_and_rabbit_register_nav_menu()
	{
		$args = array();
		if (have_rows('register_menus', 'option')):
			while (have_rows('register_menus', 'option')):
				the_row();
				$args = array_merge($args, array(
					get_sub_field('name') => __(get_sub_field('label'), 'rose_and_rabbit'),
				)
				);
			endwhile;
		endif;
		register_nav_menus($args);
	}
	add_action('after_setup_theme', 'rose_and_rabbit_register_nav_menu', 0);
}

if (!function_exists('rose_and_rabbit_style_css')) {
	function rose_and_rabbit_style_css()
	{
		wp_register_style('marcellus', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Marcellus&amp;display=swap');
		wp_enqueue_style('marcellus');

		wp_register_style('font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
		wp_enqueue_style('font_awesome');

		wp_register_style('slick_carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
		wp_enqueue_style('slick_carousel');

		wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), 'all');
	}
	add_action('wp_head', 'rose_and_rabbit_style_css', 1);
}

if (!function_exists('rose_and_rabbit_script_js')) {
	function rose_and_rabbit_script_js()
	{

		// wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js', null, null, true );
		// wp_enqueue_script('jquery');

		wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), true);
		wp_enqueue_script('slick');

		wp_enqueue_script('index-js', get_template_directory_uri() . '/assets/js/index.js', array(), true);
		wp_enqueue_script('sick-js', get_template_directory_uri() . '/assets/js/sick.js', array(), true);
		wp_enqueue_script('multistepform-js', get_template_directory_uri() . '/assets/js/multistepform.js', array(), true);
	}
	add_action('wp_footer', 'rose_and_rabbit_script_js');
}

// add css file in admin for acf
function acf_admin_theme_style()
{
	wp_enqueue_style('acf-admin', get_template_directory_uri() . '/assets/css/acf-admin.css');
}
add_action('admin_enqueue_scripts', 'acf_admin_theme_style');
add_action('login_enqueue_scripts', 'acf_admin_theme_style');



// Allow to upload svg
function rose_and_rabbit_mime_types($mimes)
{
	$mimes['webp'] = 'image/webp';
	$mimes['ico'] = 'image/x-icon';
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'rose_and_rabbit_mime_types');
add_filter('mime_types', 'rose_and_rabbit_mime_types');


//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path)
{
	if ($result === false) {
		$displayable_image_types = array(IMAGETYPE_WEBP);
		$info = @getimagesize($path);
		if (empty($info)) {
			$result = false;
		} elseif (!in_array($info[2], $displayable_image_types)) {
			$result = false;
		} else {
			$result = true;
		}
	}
	return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);




function fields_list()
{
	return array(
		'active-megamenu' => 'Active MegaMenu',
		// 'active-column-divider' => 'Column Divider',
		'active-divider' => 'Inline Divider',
		'active-featured-image' => 'Featured Image',
	);
}


// Setup fields
function megamenu_fields($id, $item, $depth, $args)
{
	$fields = fields_list();
	foreach ($fields as $_key => $label):
		$key = sprintf('menu-item-%s', $_key);
		$id = sprintf('edit-%s-%s', $key, $item->ID);
		$name = sprintf('%s[%s]', $key, $item->ID);
		$value = get_post_meta($item->ID, $key, true);
		$class = sprintf('field-%s', $_key);
		?>
		<p class="description description-wide <?php echo esc_attr($class) ?>">
			<label for="<?php echo esc_attr($id); ?>">
				<input type="checkbox" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="1"
					<?php echo ($value == 1) ? 'checked="checked"' : ''; ?> /><?php echo esc_attr($label); ?></label>
		</p>
		<?php
	endforeach;
}
add_action('wp_nav_menu_item_custom_fields', 'megamenu_fields', 10, 4);


// Create Columns
function megamenu_columns($columns)
{
	$fields = fields_list();
	$columns = array_merge($columns, $fields);
	return $columns;
}
add_filter('manage_nav-menus_columns', 'megamenu_columns', 99);

// Save fields
function megamenu_save($menu_id, $menu_item_db_id, $menu_item_args)
{
	if (defined('DOING_AJAX') && DOING_AJAX) {
		return;
	}

	check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

	$fields = fields_list();

	foreach ($fields as $_key => $label) {
		$key = sprintf('menu-item-%s', $_key);

		// Sanitize.
		if (!empty($_POST[$key][$menu_item_db_id])) {
			// Do some checks here...
			$value = $_POST[$key][$menu_item_db_id];
		} else {
			$value = null;
		}

		// Update.
		if (!is_null($value)) {
			update_post_meta($menu_item_db_id, $key, $value);
			// echo "key:$key<br />";
		} else {
			delete_post_meta($menu_item_db_id, $key);
		}
	}
}
add_action('wp_update_nav_menu_item', 'megamenu_save', 10, 3);




function post_thumb_image()
{
	$attr = ['title' => get_the_title(), 'alt' => get_the_title(), 'loading' => 'lazy'];
	if (has_post_thumbnail()):
		echo the_post_thumbnail(array(200, 200), $attr);
	else: ?>
		<img width="200" height="200" src="<?php echo site_url('/wp-content/uploads/2023/05/no-img.webp'); ?>"
			loading="<?php echo $attr['loading']; ?>" title="<?php echo $attr['title']; ?>" alt="<?php echo $attr['alt']; ?>"
			decoding="async">
	<?php endif;
}
add_shortcode('thumb_image', 'post_thumb_image');



function post_featured_image()
{
	$attr = ['title' => get_the_title(), 'alt' => get_the_title(), 'loading' => 'lazy'];
	if (has_post_thumbnail()):
		echo the_post_thumbnail(array(450, 450), $attr);
	else: ?>
		<img width="450" height="450" src="<?php echo site_url('/wp-content/uploads/2023/05/no-img.webp'); ?>"
			loading="<?php echo $attr['loading']; ?>" title="<?php echo $attr['title']; ?>" alt="<?php echo $attr['alt']; ?>"
			decoding="async">
	<?php endif;
}
add_shortcode('featured_image', 'post_featured_image');


function post_single_image()
{
	$attr = ['title' => get_the_title(), 'alt' => get_the_title(), 'loading' => 'lazy'];
	if (has_post_thumbnail()):
		echo the_post_thumbnail('full', $attr);
	else: ?>
		<img src="<?php echo site_url('/wp-content/uploads/2023/05/no-img.webp'); ?>" loading="<?php echo $attr['loading']; ?>"
			title="<?php echo $attr['title']; ?>" alt="<?php echo $attr['alt']; ?>" decoding="async">
	<?php endif;
}
add_shortcode('single_image', 'post_single_image');





function rose_and_rabbit_pagination()
{
	$allowed_tags = [
		'span' => [
			'class' => []
		],
		'i' => [
			'class' => [],
		],
		'a' => [
			'class' => [],
			'href' => [],
		],
		'li' => [
			'class' => [],
		],
	];

	$args = [
		'type' => 'list',
		// 'before_page_number' => '<span class="paginate-btn">',
		// 'after_page_number' => '</span>',
		'prev_text' => __('<i class="fa fa-arrow-left"></i>'),
		'next_text' => __('<i class="fa fa-arrow-right"></i>'),
	];
	$paginationLink = paginate_links($args);
	$paginationLink = str_replace('page-numbers', 'vs-btn', $paginationLink);
	$paginationLink = str_replace('<li>', '<li class="me-2">', $paginationLink);
	$paginationLink = str_replace(
		'<li class="me-2"><span aria-current="page" class="vs-btn current">',
		'<li class="me-2"><span aria-current="page" class="vs-btn bg-black">',
		$paginationLink
	);
	printf('<ul class="pagination justify-content-center">%s</ul>', wp_kses($paginationLink, $allowed_tags));
}
add_shortcode('rose_and_rabbit_pagination', 'rose_and_rabbit_pagination');




add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{
	if (function_exists('acf_add_options_page')) {
		// Theme General Options
		$general_options = array(
			'page_title' => __('Theme General Options', 'rose_and_rabbit'),
			'menu_title' => __('Theme Options', 'rose_and_rabbit'),
			'menu_slug' => 'theme-general-options',
			'capability' => 'edit_posts',
			'redirect' => true,
			'icon_url' => 'dashicons-screenoptions',
			'position' => 2
		);
		acf_add_options_page($general_options);

		acf_add_options_sub_page(
			array(
				'page_title' => 'Header',
				'menu_title' => 'Theme Header',
				'parent_slug' => 'theme-general-options',
			)
		);
		acf_add_options_sub_page(
			array(
				'page_title' => 'Footer',
				'menu_title' => 'Theme Footer',
				'parent_slug' => 'theme-general-options',
			)
		);
	}
}

add_filter('get_the_archive_title_prefix', '__return_empty_string');



// add_action( 'phpmailer_init', 'send_smtp_email' );
// function send_smtp_email( $phpmailer ) {
//     $phpmailer->isSMTP();
//     $phpmailer->Host       = 'smtp-relay.sendinblue.com';
//     $phpmailer->Port       = '587';
//     $phpmailer->SMTPSecure = 'tls';
//     $phpmailer->SMTPAuth   = true;
//     $phpmailer->Username   = 'pavan@glasier.in';
//     $phpmailer->Password   = '4tD3PXKsgTRvb8wF';
//     $phpmailer->From       = 'pavanvish001@yopmail.com';
//     $phpmailer->FromName   = 'Rose & Rabbit';
//     // $phpmailer->addReplyTo('pavanvish001@yopmail.com', 'Information');
// }

// add_filter( 'wp_mail_content_type','set_my_mail_content_type' );
// function set_my_mail_content_type() {
//     return "text/html";
// }


function rose_and_rabbit_load_wp_customizer($wp_customize)
{
	// customizer code
	// add section
	$wp_customize->add_section("sec_copyright", array(
		"title" => "Copyright Section",
		"description" => "This is the copyright section",
	)
	);

	// add setting/field
	$wp_customize->add_setting("set_copyright", array(
		"type" => "theme_mod",
		"default" => "",
		"sanitize_callback" => "sanitize_text_field",
	)
	);

	// add control
	$wp_customize->add_control("set_copyright", array(
		"label" => "Copyright",
		"description" => "Please fill the copyright text",
		"section" => "sec_copyright",
		"type" => "text"
	)
	);

	$wp_customize->add_setting('image_icon_upload', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'type' => 'option',

	)
	);

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_icon_upload', array(
		'label' => __('Icons', 'rose_and_rabbit'),
		'section' => 'sec_copyright',
		'settings' => 'image_icon_upload',
	)
	));
}
add_action("customize_register", "rose_and_rabbit_load_wp_customizer");





add_action('woocommerce_after_quantity_input_field', 'rose_and_rabbit_display_quantity_plus');
function rose_and_rabbit_display_quantity_plus()
{
	echo '<button type="button" class="plus qty-btn"><i class="fal fa-plus" aria-hidden="true"></i></button>';
}


add_action('woocommerce_before_quantity_input_field', 'rose_and_rabbit_display_quantity_minus');
function rose_and_rabbit_display_quantity_minus()
{
	echo '<label> QUANTITY: </label><button type="button" class="minus qty-btn"><i class="fal fa-minus" aria-hidden="true"></i></button>';
}

// -------------
// 2. Trigger update quantity script
add_action('wp_footer', 'rose_and_rabbit_add_cart_quantity_plus_minus');
function rose_and_rabbit_add_cart_quantity_plus_minus()
{
	if (!is_product() && !is_cart())
		return;
	wc_enqueue_js("
      $(document).on( 'click', 'button.plus, button.minus', function() {
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
      });
   ");

	wc_enqueue_js("
	  $('.woocommerce p.stars a').click(function(e){ e.preventDefault();
		$( '.dis-none' ).removeClass( 'dis-none' );
	  });
   ");
}



function login_form_woocommerce($atts)
{
	if (!is_user_logged_in()) {
		if (
			function_exists('woocommerce_login_form') &&
			function_exists('woocommerce_output_all_notices')
		) {
			//render the WooCommerce login form   
			ob_start();
			woocommerce_output_all_notices();
			woocommerce_login_form();
			return ob_get_clean();
		} else {
			//render the WordPress login form
			return wp_login_form(array('echo' => false));
		}
	} else {
		return "Hello there! Welcome back.";
	}
}
add_shortcode('login_form_wc', 'login_form_woocommerce');



add_shortcode('wc_login_form_bbloomer', 'bbloomer_separate_login_form');

function bbloomer_separate_login_form()
{
	if (is_user_logged_in())
		return '<p>You are already logged in</p>';
	ob_start();
	do_action('woocommerce_before_customer_login_form');
	woocommerce_login_form(array('redirect' => wc_get_page_permalink('myaccount')));
	return ob_get_clean();
}