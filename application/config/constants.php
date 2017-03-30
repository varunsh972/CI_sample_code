<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
 * Global Path
 */
define('IMAGES_URL_PATH_GLOBAL', 'assets/global/images/');
define('IMG_URL_PATH_GLOBAL', 'assets/global/img/');
define('ASSET_URL_PATH', 'assets/');
define('PUBLIC_URL_PATH', 'public/');


/*
 * API Token Secret
 */
define('API_TOKEN', '*****************************');

/*
 * Google Timezone Key
 */
define('GOOGLE_KEY', 'xxxxxxxxxxxx');

/*
 * Status Code
 */
//define('API_TOKEN', 				  'HJKNB67HG65PAN4567GHY789FGS345');

/*
 * Levels
 */
define('HIGH', '1');
define('MEDIUM', '2');
define('LOW', '3');
define('ALL', '4');
/*
 * User Types
 */
define('INDIVIDUAL_USER', '1');
define('BUSINESS_USER', '2');
define('SOCIAL_CATEGORY', '1');
define('BUSINESS_CATEGORY', '2');
define('PUBLIC_EVENT', '1');
define('PRIVATE_EVENT', '2');

define('PUBLIC_DEAL', '1');
define('PRIVATE_DEAL', '2');
    
define('FRIEND_REQUESTED', '0');
define('FRIEND_ACCEPTED', '1');
define('FRIEND_DECLINED', '2');

define('INVITE_REQUESTED', '0');
define('INVITE_ACCEPTED', '1');
define('INVITE_DECLINED', '2');
define('INVITE_MAYBE', '3');

define('DISABLED', '0');
define('ENABLED', '1');
define('CANCELED', '2');
define('ACTIVE', '1');

define('EVENT_CREATED', '1');
define('ADDED_PHOTOS', '2');
define('ADDED_COMMENTS', '3');
define('EVENT_ACCEPTED', '4');
define('EVENT_CANCELED', '5');
define('JUST_JOINED', '6');
define('DEAL_CREATED', '1');
define('NOTIFY_EVENT_COMMENT', '3');
define('NOTIFY_EVENT_CREATED', '4');
define('NOTIFY_EVENT_UPDATED', '5');
define('NOTIFY_EVENT_CANCELED', '6');

/*
 * image Url Thumb 200
 */
define('PROFILE_IMG', '/assets/');
define('VIDEO_URL', '/assets/');
define('IMAGE_MAIN_PATH', './assets/bar_images/main_image');
define('IMAGE_GALLERY', '/assets/bar_images/gallery_image');
define('IMAGE_COUPON', '/assets/bar_images/coupon_image');
define('IMAGE_GALLERY_PATH', './assets/bar_images/gallery_image');
define('IMAGE_COUPON_PATH', './assets/bar_images/coupon_image');
/*
 * Path For images upload
 */
define('EVENT_FOLDER', 'assets/event_images');
define('DEAL_FOLDER', 'assets/deals_images');
/* define('CSS_URL_PATH_GLOBAL', 					    'assets/global/css/');
  define('JS_URL_PATH_GLOBAL', 					     'assets/global/scripts/');
  define('IMAGES_URL_PATH_GLOBAL', 				 'assets/global/images/');
  define('FONTS_URL_PATH_GLOBAL', 				  'assets/fonts/'); */
/*
 * DELETE FLAG
 */
define('NOT_DELETED', '0');
define('DELETED', '1');
define('NOT_AUTHENTICATED', '0');
define('AUTHENTICATED', '1');

/*
 * Near by restaurant distance for search in KM
 */
define("CLOSEST", 5);

/*
 * Stripe API Credentials
 */
define('ADMIN_KEY','**************************');
define('STRIPE_SECRET_KEY','xxxxxxx');
define('STRIPE_PUBLISHABLE_KEY','xxxxxxx');
define('REQUIERAUTH', '1');
/* End of file constants.php */
/* Location: ./application/config/constants.php */