<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Student extends REST_Controller {

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

    public function students_get($session='', $class='')
    {
        if (empty($class)) {
            $this->set_response(['status' => 400, 'error' => "Select Class"], REST_Controller::HTTP_OK);
            return;
            // echo json_encode(['status' => 400, 'error' => "Select Class"]);
        }
        $this->load->model('Student_model');
        $data['count'] = $this->Student_model->getGenderCount($session, $class);
        $data['students'] = $this->Student_model->getStudents($session, $class);
        $this->set_response(['status' => 200, 'data' => $data], REST_Controller::HTTP_OK);
        // echo json_encode(['status' => 200, 'data' => $data]);
    }

    public function student_get($id = '')
    {
        if (empty($id)) {
            $this->set_response(['status' => 400, 'error' => ["Select Student"]], REST_Controller::HTTP_OK);
            return;
        }
        $this->load->model('Student_model');
        $data['student'] = $this->Student_model->getStudent($id);
        $data['student']['photo'] = base_url('uploads/photos/' . $data['student']['photo']);
        $this->set_response(['status' => 200, 'data' => $data], REST_Controller::HTTP_OK);
    }

    public function students_post()
    {
        if (empty($this->input->post())) {
            $this->set_response(['status' => 400, 'error' => "Please provide students data"], REST_Controller::HTTP_OK);
            // echo json_encode(['status' => 400, 'error' => "Please provide students data"]);
            return false;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        // $_POST['session'] = null;
        // $_POST['mobile1'] = null;

        $this->form_validation->set_rules('session', 'Session', 'trim|required|integer');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|integer');
        $this->form_validation->set_rules('student_fname', 'Student First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('student_mname', 'Student Middle Name', 'trim|required');
        $this->form_validation->set_rules('student_lname', 'Student Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('father_fname', 'Father First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('father_mname', 'Father First Name', 'trim|required');
        $this->form_validation->set_rules('father_lname', 'Father First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_fname', 'Mother First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_mname', 'Mother Miidle Name', 'trim');
        $this->form_validation->set_rules('mother_lname', 'Mother Last Name', 'trim|alpha');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|alpha');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('birth_place', 'Place of Birth', 'trim|required|alpha');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|alpha');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'trim|alpha');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|alpha');
        $this->form_validation->set_rules('caste', 'Caste', 'trim|required|alpha');
        $this->form_validation->set_rules('sub_caste', 'Sub-Class', 'trim|alpha');
        $this->form_validation->set_rules('aadhar', 'Aadhar No.', 'trim|required|regex_match[/[0-9]{12}/]');
        $this->form_validation->set_rules('mobile1', 'Mobile No. 1', 'trim|regex_match[/[0-9]{10}/]');
        $this->form_validation->set_rules('mobile2', 'Mobile No. 2', 'trim');
        $this->form_validation->set_rules('per_address', 'Permanant Address', 'trim|required');
        $this->form_validation->set_rules('res_address', 'Residential Address', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->set_response(['status' => 400, 'error' => $this->form_validation->error_array()], REST_Controller::HTTP_OK);
            // echo json_encode(['status' => 400, 'error' => $this->form_validation->error_array()]);
            return;
        } else {
            $data = $this->input->post();
            $data['photo'] = $this->do_upload('photo');

            if ($data['photo'] == false) {
                $this->set_response(['status' => 400, 'error' => ['Error in Photo upload.']], REST_Controller::HTTP_OK);
                // echo json_encode(['status' => 400, 'error' => ['Error in Photo upload.']]);
                return;
            }

            $this->load->model('Student_model');
            $id = $this->Student_model->add($data);
            $this->set_response(['status' => 200, 'data' => ['id' => $id]], REST_Controller::HTTP_OK);
            // echo json_encode(['status' => 200, 'data' => ['id' => $id]]);
        }
    }

    public function updatestudent_post($id)
    {
        if (empty($this->input->post()) && empty($id)) {
            $this->set_response(['status' => 400, 'error' => "Please provide students data"], REST_Controller::HTTP_OK);
            return false;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('session', 'Session', 'trim|required|integer');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|integer');
        $this->form_validation->set_rules('student_fname', 'Student First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('student_mname', 'Student Middle Name', 'trim|required');
        $this->form_validation->set_rules('student_lname', 'Student Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('father_fname', 'Father First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('father_mname', 'Father First Name', 'trim|required');
        $this->form_validation->set_rules('father_lname', 'Father First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_fname', 'Mother First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_mname', 'Mother Miidle Name', 'trim');
        $this->form_validation->set_rules('mother_lname', 'Mother Last Name', 'trim|alpha');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|alpha');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('birth_place', 'Place of Birth', 'trim|required|alpha');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|alpha');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required|alpha');
        $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'trim|alpha');
        $this->form_validation->set_rules('category', 'Category', 'trim|required|alpha');
        $this->form_validation->set_rules('caste', 'Caste', 'trim|required|alpha');
        $this->form_validation->set_rules('sub_caste', 'Sub-Class', 'trim|alpha');
        $this->form_validation->set_rules('aadhar', 'Aadhar No.', 'trim|required|regex_match[/[0-9]{12}/]');
        $this->form_validation->set_rules('mobile1', 'Mobile No. 1', 'trim|regex_match[/[0-9]{10}/]');
        $this->form_validation->set_rules('mobile2', 'Mobile No. 2', 'trim');
        $this->form_validation->set_rules('per_address', 'Permanant Address', 'trim|required');
        $this->form_validation->set_rules('res_address', 'Residential Address', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->set_response(['status' => 400, 'error' => $this->form_validation->error_array()], REST_Controller::HTTP_OK);
            return;
        } else {
            $data = $this->input->post();
            $photo = $this->do_upload('photo');

            if ($photo != false) {
               $data['photo'] = $photo;
            } else {
                unset($data['photo']);
            }

            $this->load->model('Student_model');
            $id = $this->Student_model->update($id,$data);
            $this->set_response(['status' => 200, 'data' => ['id' => $id]], REST_Controller::HTTP_OK);
        }
    }

    public function do_upload($fieldName = '', $newFileName = '') {
        if (empty($fieldName) || empty($_FILES[$fieldName])) {
            return false;
        }

        $config['upload_path']          = FCPATH . '/uploads/photos/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_ext_tolower']     = true;
        if (empty($newFileName)) {
            $newFileName = rand(). $_FILES[$fieldName]["name"];
            $config['file_name']        = $newFileName;
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($fieldName)) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }
}
