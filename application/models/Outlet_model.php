<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Outlet_model
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

class Outlet_model extends CI_Model
{

	private $table = 'units';

	public function get_all()
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get($this->table)->result();
	}

	public function get_by_id($id)
	{
		return $this->db->where('id', $id)->get($this->table)->row();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data)
	{
		return $this->db->where('id', $id)->update($this->table, $data);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete($this->table);
	}
}

/* End of file Outlet_model.php */
/* Location: ./application/models/Outlet_model.php */