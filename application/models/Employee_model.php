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
		$this->db->select('e.*, p.position_name, d.division_name, u.unit_name');
		$this->db->from("$this->table e");
		$this->db->join('positions p', 'p.id = e.position_id', 'left');
		$this->db->join('divisions d', 'd.id = e.division_id', 'left');
		$this->db->join('units u', 'u.id = e.unit_id', 'left');

		if (!empty($filters)) {
			$this->db->where($filters);
		}

		$this->db->order_by('e.id', 'DESC');
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		$this->db->insert(
			$this->table,
			$data
		);
		return $this->db->insert_id();
	}

	public function getUnits()
	{
		return $this->db->get('units')->result();
	}

	public function getPositions()
	{
		return $this->db->get('positions')->result();
	}

	public function getDivisions()
	{
		return $this->db->get('divisions')->result();
	}

	public function getEducations()
	{
		return $this->db->get('educations')->result();
	}

	public function getReligions()
	{
		return $this->db->get('religions')->result();
	}

	// ------------------------------------------------------------------------

}

/* End of file Employee_model.php */
/* Location: ./application/models/Employee_model.php */