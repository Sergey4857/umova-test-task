<?php
/**
 * umova functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package umova
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.54');
}


//инициализация стандартных настроек
function umova_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


}
add_action('after_setup_theme', 'umova_setup');

/**
 * Подключение скриптов и стилей
 */
function umova_scripts()
{
	wp_enqueue_style('umova-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('umova-main', get_template_directory_uri() . '/dist/main.css', array(), _S_VERSION);

	wp_enqueue_script("jquery");
	wp_enqueue_script('umova-main-js', get_template_directory_uri() . '/dist/main.js', array(), _S_VERSION);

}

add_action('wp_enqueue_scripts', 'umova_scripts');


// Подключение возможности добавления svg
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');



//Подключяение и обработка аякс запроса при сабмите формы

add_action('wp_ajax_my_action', 'my_action_callback');
add_action('wp_ajax_nopriv_my_action', 'my_action_callback');

function my_action_callback()
{


	if ($_SERVER["REQUEST_METHOD"] == "POST") {



		//Почта на которую будут приходить письма
		$mail_to = "yasak.sergey@gmail.com";

		//Сбор данных с формы
		$name = sanitize_text_field($_POST["name"]);
		$email = sanitize_text_field($_POST["email"]);
		$number = sanitize_text_field($_POST["number"]);
		$password = sanitize_text_field($_POST["password"]);
		$city = sanitize_text_field($_POST["city"]);
		$privacy = sanitize_text_field($_POST["privacy"]);

		//Проверка на пустые поля
		if (empty($name) || empty($email) || empty($number) || empty($password) || empty($city) || empty($privacy)) {
			//Ответ на неудачный запрос
			http_response_code(400);
			echo "Please complete the form and try again.";
			exit;
		}


		$content = "Name: $name\n";
		$content .= "Email: $email\n\n";
		$content .= "Number:\n$number\n";
		$content .= "Password:\n$password\n";
		$content .= "City:\n$city\n";
		$content .= "Privacy:\n$privacy\n";
		$headers = "From: $name <$email>";

		//Ответ на удачный запрос
		$success = wp_mail($mail_to, $content, $headers);
		if ($success) {
			http_response_code(200);
			echo '<div class="form-submitted">Form has been submitted successfully!</div>';

		} else {
			//Ошибка сервера
			http_response_code(500);
			echo '<div class="form-submitted">"Oops! Something went wrong, we couldnt send your message."</div>';
		}
	} else {
		http_response_code(403);
		echo "There was a problem with your submission, please try again.";
	}


	wp_die();
}

// настройка SMTP
// add_action('phpmailer_init', 'smtp_phpmailer_init');
// function smtp_phpmailer_init($phpmailer)
// {

// 	$phpmailer->IsSMTP();

// 	$phpmailer->CharSet = 'UTF-8';

// 	$phpmailer->Host = 'mail.adm.tools';
// 	$phpmailer->Username = 'no-reply@mailer.Megasite.com';
// 	$phpmailer->Password = '6AAAuuSSS2k';
// 	$phpmailer->SMTPAuth = true;
// 	$phpmailer->SMTPSecure = 'ssl';

// 	$phpmailer->Port = 465;
// 	$phpmailer->From = 'Umova-form.com';
// 	$phpmailer->FromName = 'Umova-form';

// 	$phpmailer->isHTML(true);
// }