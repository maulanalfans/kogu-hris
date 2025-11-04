<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Employee_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Employee_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$this->table = "employees";
	}

	public function get_all_employee($filters = [])
	{
		$this->db->select('e.*, p.position_name, d.division_name, u.unit_name, usr.role_id');
		$this->db->from("$this->table e");
		$this->db->join('positions p', 'p.id = e.position_id', 'left');
		$this->db->join('divisions d', 'd.id = e.division_id', 'left');
		$this->db->join('units u', 'u.id = e.unit_id', 'left');
		$this->db->join('users usr', 'usr.employee_id = e.id', 'left');

		if (!empty($filters)) {
			$this->db->where($filters);
		}

		$this->db->order_by('e.id', 'DESC');
		return $this->db->get()->result();
	}

	public function getEmployeeDetail($id)
	{
		return $this->db->select('e.*, 
            u.unit_name, 
            p.position_name, 
            d.division_name, 
            s.status_name, 
            r.religion_name, 
            ed.education_level')
			->from('employees e')
			->join('units u', 'u.id = e.unit_id', 'left')
			->join('positions p', 'p.id = e.position_id', 'left')
			->join('divisions d', 'd.id = e.division_id', 'left')
			->join('status_types s', 's.id = e.status_id', 'left')
			->join('religions r', 'r.id = e.religion_id', 'left')
			->join('educations ed', 'ed.id = e.education_id', 'left')
			->where('e.id', $id)
			->get()
			->row();
	}

	public function insert($data)
	{
		$this->db->insert(
			$this->table,
			$data
		);
		return $this->db->insert_id();
	}

	public function check_nip_exists($nip, $id)
	{
		$this->db->where('nip', $nip);
		$this->db->where('id !=', $id);
		return $this->db->get('employees')->num_rows() > 0;
	}

	public function check_email_exists($email, $id)
	{
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		return $this->db->get('employees')->num_rows() > 0;
	}

	function get_by_id($id)
	{
		return $this->db->get_where('employees', ['id' => $id])->row();
	}

	function update($id, $data)
	{
		return $this->db->where('id', $id)->update('employees', $data);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete('employees');
	}

	// ------------------------------------------------------------------------

}

/* End of file Employee_model.php */
/* Location: ./application/models/Employee_model.php */