<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Fees extends REST_Controller {

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

    var $feeHeads = [
        [ 'id'=> 1, 'name'=> 'Admission', 'field'=> 'admission' ],
        [ 'id'=> 2, 'name'=> 'Exam' , 'field'=> 'exam' ],
        [ 'id'=> 3, 'name'=> 'Computer' , 'field'=> 'computer' ],
        [ 'id'=> 4, 'name'=> 'E-class' , 'field'=> 'e_class' ],
        [ 'id'=> 5, 'name'=> 'Other' , 'field'=> 'other' ],
        [ 'id'=> 6, 'name'=> 'Late Fees' , 'field'=> 'late' ],
    ];

    public function payfees_post()
    {
        if (empty($this->input->post())) {
            $this->set_response(['status' => 400, 'error' => "Please provide fees data"], REST_Controller::HTTP_OK);
            return false;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('session', 'Session', 'trim|required|integer');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|integer');
        $this->form_validation->set_rules('feeHead', 'Fee Head', 'trim|required');
        $this->form_validation->set_rules('student', 'Student', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->set_response(['status' => 400, 'error' => $this->form_validation->error_array()], REST_Controller::HTTP_OK);
            return;
        } else {
            $data = $this->input->post();

            if (in_array(1, explode(',',$data['feeHead']))) {
                $this->load->model('Particular_model');
                $particulars = $this->Particular_model->getParticulars(1);

                $totalMonths =  ($data['feesTo'] - $data['feesFrom']) + 1;
                $perMonthAmount = $particulars['admission']/12;
                $data['admission'] = $perMonthAmount * $totalMonths;
            }
            $data['total'] = $data['admission'] + $data['exam'] + $data['computer'] + $data['e_class']+ $data['other'] + $data['late'];

            $this->load->model('Fees_model');
            $id = $this->Fees_model->add($data);
            $receipt = $this->Fees_model->getReceipt($id);
            $this->set_response(['status' => 200, 'data' => ['receipt' => $receipt]], REST_Controller::HTTP_OK);
        }
    }

    public function feeDetails_get($session_id  = "", $id = '')
    {
        if (empty($id) || empty($session_id)) {
            $this->set_response(['status' => 400, 'error' => ["Select Student and Session"]], REST_Controller::HTTP_OK);
            return;
        }
        $this->load->model('Fees_model');
        $data['feeDetails'] = $this->Fees_model->getFeeDetails($session_id,$id);
        $data['feeDetails']['months'] = explode(",", $data['feeDetails']['months']);
        $this->set_response(['status' => 200, 'data' => $data], REST_Controller::HTTP_OK);
    }

    public function updateParticulars_post()
    {
        $data = json_decode($this->input->raw_input_stream, true);
        if (empty($data)) {
            $this->set_response(['status' => 400, 'error' => "Please provide fees data"], REST_Controller::HTTP_OK);
            return false;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('session', 'Session', 'trim|required|integer');
        $this->form_validation->set_rules('admission', 'admission', 'trim|required|integer');
        $this->form_validation->set_rules('exam', 'Exam', 'trim|required|integer');
        $this->form_validation->set_rules('computer', 'Computer', 'trim|required|integer');
        $this->form_validation->set_rules('e_class', 'E-class', 'trim|required|integer');
        $this->form_validation->set_rules('other', 'Other', 'trim|required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->set_response(['status' => 400, 'error' => $this->form_validation->error_array()], REST_Controller::HTTP_OK);
            return;
        } else {
            $session = $data['session'];
            unset($data['session']);
            $this->load->model('Particular_model');
            $id = $this->Particular_model->update($session,$data);
            $this->set_response(['status' => 200, 'data' => ['id' => $id]], REST_Controller::HTTP_OK);
        }
    }
}
