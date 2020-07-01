<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public $dbCols = array(
        'session' => 'session_id',
        'class' => 'class_id',
        'admission_no' => 'admission_no',
        'admission_date' => 'admission_date',
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
        $this->table = 'students';
    }

    public function getStudents($session='1', $class='')
    {
        if (empty($class)) {
            return [];
        }
        $this->db->select("id");
        $this->db->select("concat_ws(' ', fname, lname) AS name");
        foreach ($this->dbCols as $uiCol => $dbCol) {
            if (in_array($dbCol, ['admission_date','dob'])) {
                $this->db->select("DATE_FORMAT($dbCol,'%d-%m-%Y') AS " . $uiCol);
            } else {
                $this->db->select($dbCol . " AS " . $uiCol);
            }
        }
        if (is_array($class)) {
            $this->db->where_in('class_id', $class);
            return $this->db->get($this->table)->result_array();
        } else {
            $this->db->where('class_id', $class);
            return $this->db->get($this->table)->result_array();
        }
    }

    public function getStudent($admission_no='')
    {
        if (empty($admission_no)) {
            return [];
        }
        $this->db->select("id");
        $this->db->select("concat_ws(' ', fname, lname) AS name");
        foreach ($this->dbCols as $uiCol => $dbCol) {
            if (in_array($dbCol, ['admission_date','dob'])) {
                $this->db->select("DATE_FORMAT($dbCol,'%d-%m-%Y') AS " . $uiCol);
            } else {
                $this->db->select($dbCol . " AS " . $uiCol);
            }
        }
        return $this->db->get_where($this->table,array('admission_no' => $admission_no))->row_array();
    }

    public function getGenderCount($session='1', $class='')
    {
        $this->db
        ->select('count(students.id) AS total')
        ->select('count(IF(students.gender = "Male", students.id,null)) AS male')
        ->select('count(IF(students.gender like "female", students.id,null)) AS female')
        ->select('count(IF(students.gender = "Transgender", students.id,null)) AS transgender');
        if (empty($class)) {
            return [];
        } else {
            if (is_array($class)) {
                $this->db->where_in('class_id', $class);
                return $this->db->get($this->table)->result_array();
            } else {
                $this->db->where('class_id', $class);
                return $this->db->get($this->table)->row_array();
            }
        }
    }

    public function add($data='')
    {
        $saveData = array();
        foreach ($data as $formKey => $formValue) {
            $saveData[$this->dbCols[$formKey]] = ($formValue != 'null') ? $formValue: null;
        }
        $saveData['dob'] = date('Y-m-d',strtotime($saveData['dob']));
        $saveData['admission_date'] = date('Y-m-d',strtotime($saveData['admission_date']));

        $this->db->insert($this->table, $saveData);
        return $this->db->insert_id($this->table);
    }

    public function update($admission_no,$data='')
    {
        $saveData = array();
        foreach ($data as $formKey => $formValue) {
            $saveData[$this->dbCols[$formKey]] = ($formValue != 'null') ? $formValue: null;
        }

        $saveData['dob'] = date('Y-m-d',strtotime($saveData['dob']));
        $saveData['admission_date'] = date('Y-m-d',strtotime($saveData['admission_date']));

        $this->db->update($this->table, $saveData, array('admission_no' => $admission_no));
        return $this->db->insert_id($this->table);
    }

}
