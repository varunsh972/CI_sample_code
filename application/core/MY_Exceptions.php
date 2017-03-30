<?php
// application/core/MY_Exceptions.php
class MY_Exceptions extends CI_Exceptions {

    public function show_404($page = '', $log_error = true)
    {
        $CI =& get_instance();
        $CI->load->view('pages/header');
        $CI->load->view('pages/404');
        $CI->load->view('pages/footer_js');
        $CI->load->view('pages/footer');
        echo $CI->output->get_output();
        exit;
    }
}