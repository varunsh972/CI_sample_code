<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function css_url($file_name) {
    return base_url() . CSS_URL_PATH . $file_name;
}

function js_url($file_name) {
    return base_url() . JS_URL_PATH . $file_name;
}

function images_url_global($file_name) {
    return base_url() . IMAGES_URL_PATH_GLOBAL . $file_name;
}

function img_url_global($file_name) {
    return base_url() . IMG_URL_PATH_GLOBAL . $file_name;
}

function asset_url($file_name) {
    return base_url() . ASSET_URL_PATH . $file_name;
}

function p($value) {
    echo '<pre>';
    print_r($value);
    echo'</pre>';
}

function p_d($value) {
    echo '<pre>';
    print_r($value);
    echo'</pre>';
    die();
}

function p_v($value) {
    echo '<pre>';
    var_dump($value);
    echo'</pre>';
}

function p_vd($value) {
    echo '<pre>';
    var_dump($value);
    echo'</pre>';
    die();
}

function messages($var) {
    $CI = &get_instance();
    $message_array = $CI->config->item('wesbite_messages');
    $message = null;
    //p($var);
    //die();


    if (isset($var) && !empty($var) && is_array($var)) {
        //p($var);
        //die();
        $message_var = each($var);
        $key = $message_var['key'];
        $value = $message_var['value'];
        //echo $message_var['key'];
        //echo $message_var['value'];
        $message = str_replace("{{var}}", $value, $message_array[$key]);
        //echo $message;
        //die();
    }
    return $message;
}

function current_date($format = false) {
    $date = new DateTime();
    if ($format != false) {
        $current_date = $date->format($format);
    } else {
        $current_date = $date->format('Y-m-d H:i:s');
    }
    return $current_date;
}

function send_email($to, $message, $subject, $from = null, $from_name = null, $cc = null, $bcc = null, $attachments = null) {
    $CI = & get_instance();
    $CI->load->library('email');
    $CI->load->helper('email');
    $config['word_wrap'] = true;
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);

    $CI->email->clear();
    if (valid_email($to)) {
        $CI->email->to($to);
    } else {
        return;
    }
    $CI->email->message($message);
    $CI->email->subject($subject);
    if (empty($from)) {
        $from = 'noreply@xicom.biz';
    }
    if (empty($from_name)) {
        $from_name = 'xicom';
    }
    $CI->email->from($from, $from_name);
    if (!empty($cc)) {
        $CI->email->cc($cc);
    }
    if (!empty($bcc)) {
        $CI->email->bcc($bcc);
    }
    if (!empty($attachments)) {
        if (is_array($attachments)) {
            foreach ($attachments as $attachment) {
                $CI->email->attach($attachment);
            }
        } else {
            $CI->email->attach($attachments);
        }
    }
    if ($CI->email->send()) {
        return true;
    }
}

function slug_clean($val) {
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $val);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    return $clean;
    //echo $clean;
    //die();
}

function make_date($format, $date, $time_zone = null) {
    $default_time = date_default_timezone_get();
    if (!empty($time_zone)) {
        //$default_time = date_default_timezone_get();
        $old_date = $date;
        $date = new DateTime($date, new DateTimeZone("{$default_time}"));
        $date->setTimezone(new DateTimeZone($time_zone));
    } else {
        $date = new DateTime($date, new DateTimeZone("{$default_time}"));
    }
    $result = $date->format($format);
    return $result;
}

//function upload_file($path = NULL, $allowed_types = NULL, $min_width = NULL, $min_height = NULL, $max_width = NULL, $max_height = NULL, $file_name = NULL)

function upload_file($path = NULL, $allowed_types = NULL, $file_name = NULL) {
    //echo $file_name;
    //die();
    $CI = & get_instance();
    $config = array(
        'upload_path' => !empty($path) ? $path : './assets/bar_images/',
        'max_size' => '1048',
        'remove_spaces' => TRUE,
    );
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777);
    }
    if (!empty($allowed_types)) {
        $config['allowed_types'] = $allowed_types;
    }

    $CI->load->library('upload');
    $CI->upload->initialize($config);

    if (!empty($file_name)) {
        $file = $CI->upload->do_upload($file_name);
    } else {
        $file = $CI->upload->do_upload();
    }

    if (!$file) {
        return $CI->upload->display_errors();
    } else {
        //$data = $CI->upload->data();
        return $CI->upload->data();
        /*
          $data = $CI->upload->data();
          $img_details = getimagesize($data['full_path']);

          if ((!empty($min_width) && $img_details[0] < $min_width) || (!empty($min_height) && $img_details[1] < $min_height))
          {
          unlink($data['full_path']);
          return "Image Should Be atleast $min_width x $min_height";
          }

          elseif((!empty($max_width) && $img_details[0] > $max_width) || (!empty($max_height) && $img_details[1] > $max_height))
          {
          resize_image($data['full_path'], $max_width, $max_height, '', false, false);
          $aspect_ratio = $img_details[0]/$img_details[1];
          if($img_details[0] > $img_details[1])
          {
          $height_new = floor($max_width/$aspect_ratio);
          if(isset($height_new) && $height_new >= $min_height && $height_new <= $max_height)
          {
          resize_image($data['full_path'], $max_width, $height_new);
          }
          else
          {
          if($img_details[1] > $max_height)
          {
          crop_image($data['full_path'], '', $max_width, $max_height);
          }
          else
          {
          crop_image($data['full_path'], '', $max_width, $img_details[1]);
          }
          }
          //unlink($data['full_path']);
          //return "Image new height $height_new {$data['full_path']}";
          //if($height
          }
          else
          {
          $width_new = floor($max_height * $aspect_ratio);
          if(isset($width_new) && $width_new >= $min_width && $width_new <= $max_width)
          {
          resize_image($data['full_path'], $width_new, $max_height);
          }
          else
          {
          if($img_details[0] > $max_width)
          {
          crop_image($data['full_path'], '', $max_width, $max_height);
          }
          else
          {
          crop_image($data['full_path'], '', $img_details[0], $max_height);
          }
          }
          }
          }
          return $data;
         */
        //p($data);
        //die();
        //return $data;
    }
}

function resize_image($s, $w, $h, $d = NULL, $new_image = FALSE, $maintain_ratio = TRUE) {
    if (file_exists($d) || file_exists($s) == FALSE) {
        return;
    }

    $img_details = getimagesize($s);
    $master_dim = 'height';

    if ($img_details[1] > $img_details[0]) {
        $master_dim = 'width';
    }
    $CI = & get_instance();
    $config = array();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $s;
    if ($new_image == TRUE) {
        $config['new_image'] = $d;
    }
    $config['height'] = $h;
    $config['width'] = $w;
    $config['maintain_ratio'] = $maintain_ratio;
    $config['master_dim'] = $master_dim;
    $CI->load->library('image_lib', $config);

    if (!$CI->image_lib->resize()) {
        //echo $CI->image_lib->display_errors();
    }
    $CI->image_lib->clear();
    return $d;
}

function crop_image($s, $d, $w, $h, $x = NULL, $y = NULL) {
    if ((file_exists($s) == FALSE)) {
        return;
    }
    $img_details = getimagesize($s);
    $CI = & get_instance();
    $config = array();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $s;
    $config['new_image'] = $d;
    $config['x_axis'] = $x;
    $config['y_axis'] = $y;
    $config['height'] = $h;
    $config['width'] = $w;
    $config['maintain_ratio'] = FALSE;
    $CI->load->library('image_lib', $config);

    if (!$CI->image_lib->crop()) {
        //echo $CI->image_lib->display_errors();
    }
}

function nicetime($date) {
    if (empty($date)) {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();
    $unix_date = strtotime($date);

    // check validity of date
    if (empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "ago";
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}

function delete_directory($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            delete_directory(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}

/**
 * Method Name : get_states
 * Author Name : Jasbir Singh
 * Date : 21 Sept 2015
 * Description : return all states of given country
 */
if (!function_exists('get_states')) {

    function get_states($country) {
        $CI = & get_instance();
        $CI->load->model('common_model');
        $states = $CI->common_model->getState($country);
        return $states;
    }

}

/**
 * Method Name : get_cities
 * Author Name : Jasbir Singh
 * Date : 21 Sept 2015
 * Description : return all cities of given state
 */
if (!function_exists('get_cities')) {

    function get_cities() {
        $CI = & get_instance();
        $CI->load->model('common_model');
        $cities = $CI->common_model->getCities();
        return $cities;
    }

}

/**
 * Method Name : get_states
 * Author Name : Jasbir Singh
 * Date : 21 Sept 2015
 * Description : return all states of given country
 */
if (!function_exists('get_category_name')) {

    function get_category_name($id) {
        $CI = & get_instance();
        $CI->load->model('common_model');
        $name = $CI->common_model->get_category_name($id);
        return $name;
    }

}

if (!function_exists('get_cars')) {

    function get_cars() {
        $CI = & get_instance();
        $CI->load->model('common_model');
        $cars = $CI->common_model->getCars();
        return $cars;
    }

}

    

$date = "2009-03-04 17:45";
$result = nicetime($date); // 2 days ago

