<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees_model extends CI_Model {

    public $dbCols = array(
        'session' => 'session_id',
        'class' => 'class_id',
        'student_fname' => 'fname',
        'student_mname' => 'mname',
        'student_lname' => 'lname',
        'father_fname' => 'father_fname',
        'father_mname' => 'father_mname',
        'father_lname' => 'father_lname',
        'mother_fname' => 'mother_fname',
        'mother_mname' => 'mother_mname',
        'mother_lname' => 'mother_lname',
        'gender' => 'gender',
        'dob' => 'dob',
        'birth_place' => 'birth_place',
        'nationality' => 'nationality',
        'religion' => 'religion',
        'mother_tongue' => 'mother_tongue',
        'category' => 'category',
        'caste' => 'caste',
        'sub_caste' => 'sub_caste',
        'aadhar' => 'aadhar',
        'mobile1' => 'mobile1',
        'mobile2' => 'mobile2',
        'per_address' => 'per_address',
        'res_address' => 'res_address',
        'photo' => 'photo',
    );

    function __construct()
    {
        parent::__construct();
        $this->table = 'fees';
    }

    public function getReceipt($id)
    {
        if (empty($id)) {
            return [];
        }
        $this->db->select('students.fname,students.lname,sessions.year,receipts.*')
        ->join('students', 'students.id = receipts.student_id', 'inner')
        ->join('sessions', 'sessions.id = receipts.session_id', 'inner')
        ->where('receipts.id', $id);
        return $this->db->get('receipts')->row_array();
    }

    public function getFeeDetails($session_id,$id)
    {
        if (empty($id) || empty($session_id)) {
            return [];
        }
        $this->db->select('students.fname,students.lname,sessions.year,fees.*')
        ->join('students', 'students.id = fees.student_id', 'inner')
        ->join('sessions', 'sessions.id = fees.session_id', 'inner')
        ->where('fees.student_id', $id)
        ->where('fees.session_id', $session_id);
        return $this->db->get('fees')->row_array();
    }

    public function add($data='')
    {
        $admission = 0;
        $late = 0;
        $months = '';
        $saveData = array();
        $fees = $this->db->get_where($this->table,array('student_id' => $data['student'],'class_id' => $data['class']))
        ->row_array();

        if (!empty($fees)) {
            $admission = $fees['admission'];
            $late = $fees['late'];
            $months = $fees['months'] . ",";

            $receiptData['session_id'] = 1;
            $receiptData['class_id'] = $data['class'];
            $receiptData['student_id'] = $data['student'];
        } else {
            $saveData['session_id'] = 1;
            $saveData['class_id'] = $data['class'];
            $saveData['student_id'] = $data['student'];

            $receiptData['session_id'] = 1;
            $receiptData['class_id'] = $data['class'];
            $receiptData['student_id'] = $data['student'];
        }

        if (!empty($data['admission']) && $data['admission'] != 'null' && in_array(1, explode(',',$data['feeHead']))) {
            $saveData['admission'] = $admission + $data['admission'];
            $saveData['months'] = $months . implode(",",range($data['feesFrom'],$data['feesTo']));
        }

        if (!empty($data['exam']) && $data['exam'] != 'null' && in_array(2, explode(',',$data['feeHead']))) {
            $saveData['exam'] = $data['exam'];
            $receiptData['exam'] = $data['exam'];
        }
        if (!empty($data['computer']) && $data['computer'] != 'null' && in_array(3, explode(',',$data['feeHead']))) {
            $saveData['computer'] = $data['computer'];
            $receiptData['computer'] = $data['computer'];
        }
        if (!empty($data['e_class']) && $data['e_class'] != 'null' && in_array(4, explode(',',$data['feeHead']))) {
            $saveData['e_class'] = $data['e_class'];
            $receiptData['e_class'] = $data['e_class'];
        }
        if (!empty($data['other']) && $data['other'] != 'null' && in_array(5, explode(',',$data['feeHead']))) {
            $saveData['other'] = $data['other'];
            $receiptData['other'] = $data['other'];
        }
        if (!empty($data['late']) && $data['late'] != 'null' && in_array(6, explode(',',$data['feeHead']))) {
            $saveData['late'] = $late + $data['late'];
            $receiptData['late'] = $late + $data['late'];
        }

        if (!empty($fees)) {
            $this->db->update($this->table, $saveData, array('id' => $fees['id']));
            $feesId = $fees['id'];
        } else {
            $this->db->insert($this->table, $saveData);
            $feesId = $this->db->insert_id($this->table);
        }

        if (!empty($feesId)) {
            $this->load->model('User_model');
            $receiptData['admission'] = $data['admission'];
            $receiptData['fromMonth'] = $data['feesFrom'];
            $receiptData['toMonth'] = $data['feesTo'];
            $receiptData['toMonth'] = $data['feesTo'];
            $receiptData['total'] = $data['total'];
            $receiptData['created_by'] = $this->User_model->userId;
            $this->db->insert('receipts', $receiptData);
            return $this->db->insert_id('receipts');
        }
        return $feesId;
    }

}
