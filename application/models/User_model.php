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

	public function getRoles()
	{
		return $this->db->get('roles')->result();
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */