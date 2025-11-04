<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model User_model
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

class User_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$this->table = "users";
	}

	public function get_user($username, $password)
	{
		$this->db->select('u.*, r.role_name, e.nip, e.name');
		$this->db->from($this->table . ' u');
		$this->db->join('roles r', 'r.id = u.role_id', 'left');
		$this->db->join('employees e', 'e.id = u.employee_id', 'left');
		$this->db->where('u.username', $username);
		$this->db->where('u.password', md5($password));
		$this->db->where('u.is_active', 1);
		return $this->db->get()->row();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update($this->table, $data);
	}

	public function get_users_role($id)
	{
		return $this->db->where('employee_id', $id)->get('users')->row();
	}

	public function get_by_employee($employee_id)
	{
		return $this->db->where('employee_id', $employee_id)->get('users')->row();
	}

	public function delete_by_employee_id($employee_id)
	{
		return $this->db->where('employee_id', $employee_id)->delete('users');
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */