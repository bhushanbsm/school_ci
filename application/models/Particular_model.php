<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Particular_model extends CI_Model {
	private $table = 'particulars';

	function __construct()
    {
        parent::__construct();
    }

	public function getParticulars($id='')
	{
		$this->db->join('sessions', 'sessions.id = particulars.session_id', 'left')
		->select('particulars.*')
		->select('sessions.year');
		if (empty($id)) {
			return $this->db->get($this->table)->result_array();
		} else {
			if (is_array($id)) {
				$this->db->where_in('particulars.id', $id);
				return $this->db->get($this->table)->result_array();
			} else {
				$this->db->where('particulars.id', $id);
				return $this->db->get($this->table)->row_array();
			}
		}
	}

}
