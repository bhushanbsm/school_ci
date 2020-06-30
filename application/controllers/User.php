<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    * 		http://example.com/index.php/welcome
    *	- or -
    * 		http://example.com/index.php/welcome/index
    *	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see https://codeigniter.com/user_guide/general/urls.html
    */

    public function authenticate_post()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (empty($data)) {
            $this->set_response(['status' => 400, 'error' => ['Invalid credentials']], REST_Controller::HTTP_OK);
            return true;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->set_response(['status' => 400, 'error' => $this->form_validation->error_array()], REST_Controller::HTTP_OK);
            // echo json_encode(['status' => 400, 'error' => $this->form_validation->error_array()]);
            return;
        }

        $this->load->model('User_model');
        $user = $this->User_model->login($data);

        if (empty($user)) {
            $this->set_response(['status' => 400, 'error' => ['Invalid credentials']], REST_Controller::HTTP_OK);
            // echo json_encode(['status' => 400, 'error' => ['Invalid credentials']]);
            return;
        }

        $tokenData = array(
            'id' => $user['id'],
            'username' => $user['username'],
            'timestamp' => now()
        );

        $user['token'] = AUTHORIZATION::generateToken($tokenData);
        unset($user['password']);
        $this->set_response(['status' => 200, 'data' => ['user' => $user]], REST_Controller::HTTP_OK);
        // echo json_encode(['status' => 200, 'data' => ['user' => $user]]);
    }
}
