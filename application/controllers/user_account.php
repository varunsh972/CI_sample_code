<?php

/**
 * User_Account Controller
 *
 * @project 
 * @since 25 Sept 2015
 * @version CI Php 2.3.8
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Method Name : checkEmailExists
     
     * Description : check email exists in our database
     */
    public function checkEmailExists($email) {
        $conditions = $params = array();
        $params['table'] = 'tbl_user';
        $conditions['email'] = $email;
        $params['single_row'] = TRUE;
        $loginCheck = $this->common_model->get_data($conditions, $params);
        return $loginCheck;
    }

    /**
     * Method Name : checkEmailExists
     
     * Description : check email exists in our database
     */
    public function checkUsernameExists($username) {
        $conditions = $params = array();
        $params['table'] = 'tbl_user';
        $conditions['user_name'] = $username;
        $params['single_row'] = TRUE;
        $loginCheck = $this->common_model->get_data($conditions, $params);
        return $loginCheck;
    }

    /**
     * Method Name : checkAccountExists
     
     * Description : validate login and password
     */
    public function checkAccountExists($username, $password, $type = NULL) {
        $conditions = $params = array();
        $params['table'] = 'tbl_user';
        $conditions['email'] = $username;
        //$conditions['user_type'] = $type;
        $conditions['password'] = md5($password);
        $params['single_row'] = TRUE;
        $loginCheck = $this->common_model->get_data($conditions, $params);
        return $loginCheck;
    }

   
    /**
     * Method Name : verifyEmail
     
     * Date : 28 Sept 2015
     * Description : verify email exists in our database
     */
    public function verify_email() {
        $token = $this->uri->segment(3);
        if (!empty($token)) {
            $conditions = $params = array();
            $params['table'] = 'who_user_details';
            $conditions['verify_token'] = $token;
            $conditions['is_authenticated'] = 0;
            $params['single_row'] = TRUE;
            $check = $this->common_model->get_data($conditions, $params);
            if (!empty($check)) {
                $conditions = $params = array();
                $conditions['where']['id'] = $check->id;
                $conditions['value']['is_authenticated'] = 1;
                $params['table'] = 'who_user_details';
                $this->common_model->update($conditions, $params);
                $this->session->set_flashdata('success', 'Email Verified successfully');
                redirect('user_account/notify');
            } else {
                $this->session->set_flashdata('error', 'Invalid link');
                redirect('user_account/notify');
            }
        } else {
            show_404();
        }
    }

    /**
     * Method Name : login
     
     * Date : 29 Sept 2015
     * Description : admin login
     */
    public function login() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
            if ($this->form_validation->run() == true) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $conditions = $params = array();
                $params['table'] = 'tbl_user';
                $conditions['user_name'] = $username;
                $conditions['password'] = $password;
                $conditions['role'] = 0;
                $params['single_row'] = TRUE;
                $loginCheck = $this->common_model->get_data($conditions, $params);

                if (!empty($loginCheck) && $loginCheck == 1) {
                    $this->register_session($username);
                    redirect(base_url('merchant/'));
                } else {
                    $this->session->set_flashdata('error', 'Login Error: Invalid Username or Password');
                    redirect('/');
                }
            } else {
                $errors_message = 'Please enter username and password';
                $this->session->set_flashdata('error', 'Please enter username and password');
                redirect('/');
            }
        } else {
            $this->load->view('pages/header');
            $this->load->view('pages/login');
            $this->load->view('pages/footer_js');
            $this->load->view('pages/validate_js');
            $this->load->view('pages/footer');
        }
    }

    public function register() {
        $this->load->view('pages/header');
        $this->load->view('pages/register');
        $this->load->view('pages/footer_js');
        $this->load->view('pages/validate_js');
        $this->load->view('pages/footer');
    }

    /**
     * Method Name : signUpManually_post
     
     * Description : Register new user into app by conventional method
     */
    public function signUp() {

        if ($this->input->post('email') && $this->input->post('password') && $this->input->post('user_name')) {
            $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');

            if ($this->form_validation->run() == true) {
                $username = $this->input->post('user_name');
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                //check email exists
                $loginCheck = $this->checkEmailExists($email);
                $userCheck = $this->checkUsernameExists($username);

                if (!empty($loginCheck) && is_object($loginCheck)) {
                    $msg = 'Email already exists in database';
                    $data = array(
                        'status' => FALSE,
                        'message' => $msg,
                    );
                    echo json_encode($data);
                    exit;
                } elseif (!empty($userCheck) && is_object($userCheck)) {
                    $msg = 'Username already exists in database';
                    $data = array(
                        'status' => FALSE,
                        'message' => $msg,
                    );
                    echo json_encode($data);
                    exit;
                } else {
                    $verfy_token = md5($password) . md5(time());
                    $conditions = $params = array();
                    $conditions['email'] = $email;
                    $conditions['password'] = md5($password);
                    $conditions['user_name'] = $username;
                    $conditions['company'] = $this->input->post('name');
                    $conditions['is_authenticated'] = NOT_AUTHENTICATED;
                    $conditions['verify_token'] = $verfy_token;
                    $conditions['date_created'] = current_date();
                    $conditions['date_modified'] = current_date();
                    $params['table'] = 'tbl_user';
                    $user_id = $this->common_model->insert_data($conditions, $params);
                    $user_type = 'User';
                    $subject = 'Verfiy your email';
                    $auth_url = base_url() . "user_account/verify_email/" . $verfy_token;
                    $message = "<pre>Hello {$this->input->post('name')},<br/>Welcome to Who'is In! You've registered as a new {$user_type}. <br/>To start using application, please confirm your email by clicking <a href='{$auth_url}'>here</a>.";
                    send_email($email, $message, $subject, $from = null, $from_name = null, $cc = null, $bcc = null, $attachments = null);

                    $data = array(
                        'status' => TRUE,
                        'message' => 'User successfully registered',
                    );
                    echo json_encode($data);
                    exit;
                }
            } else {
                $msg = 'Please enter username and password';
                $data = array(
                    'status' => FALSE,
                    'message' => $msg,
                );
                echo json_encode($data);
                exit;
            }
        } else {
            $msg = 'Please enter username and password';
            $data = array(
                'status' => FALSE,
                'message' => $msg,
                'data' => (object) array(),
            );
            echo json_encode($data);
            exit;
        }
    }

    /**
     * Method Name : register_session
     
     * Date : 01 Oct 2015
     * Description : create session for admin user 
     */
    public function register_session($username) {
        if (!empty($username)) {
            $conditions = $params = array();
            $conditions['user_name'] = $username;
            $params['table'] = 'tbl_user';
            $params['single_row'] = true;
            $user = $this->common_model->get_data($conditions, $params);
            $user_details = array(
                'role' => $user->role,
                'user_id' => $user->id,
                'login' => true
            );
            $this->session->set_userdata($user_details);
        }
    }

    /**
     * Method Name : logout
     
     * Date : 01 Oct 2015
     * Description : logout admin and destroy session cookies.
     */
    public function logout() {
        $this->load->helper('cookie');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    /**
     * Method Name : reset_password
     
     * Date : 30 Sept 2015
     * Description : verify token and show forgot password screen
     */
    public function reset_password() {
        $token = $this->uri->segment(3);
        if (!empty($token)) {
            $conditions = $params = array();
            $params['table'] = 'who_user_details';
            $conditions['reset_token'] = $token;
            $params['single_row'] = TRUE;
            $params['fields'] = array('id');
            $check = $this->common_model->get_data($conditions, $params);
            if (!empty($check)) {
                $data['token'] = $token;
                $this->load->view('pages/header');
                $this->load->view('pages/reset_password', $data);
                $this->load->view('pages/footer_js');
                $this->load->view('pages/validate_js');
                $this->load->view('pages/footer');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    /**
     * Method Name : update_password
     
     * Date : 30 Sept 2015
     * Description : update password
     */
    public function update_password() {
        if ($this->input->post('token')) {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            $token = $this->input->post('token');
            $conditions = $params = array();
            $params['table'] = 'who_user_details';
            $conditions['reset_token'] = $token;
            $params['single_row'] = TRUE;
            $params['fields'] = array('id');
            $check = $this->common_model->get_data($conditions, $params);
            if (!empty($check)) {
                if ($password != $cpassword) {
                    $this->session->set_flashdata('error', 'Password not matched');
                    redirect('user_account/reset_password/' . $token);
                } else {
                    $conditions = $params = array();
                    $conditions['where']['id'] = $check->id;
                    $conditions['value']['password'] = md5($password);
                    $conditions['value']['reset_token'] = '';
                    $params['table'] = 'who_user_details';
                    $this->common_model->update($conditions, $params);
                    $this->session->set_flashdata('success', 'Password updated successfully');
                    redirect('user_account/notify');
                }
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    /**
     * Method Name : notify
     
     * Date : 29 Sept 2015
     * Description : show messages to user
     */
    public function notify() {

        $this->load->view('pages/header');
        $this->load->view('pages/notify');
        $this->load->view('pages/footer_js');
        $this->load->view('pages/footer');
        $this->session->sess_destroy();
    }

}
