<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller EmployeeController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class EmployeeController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_logged_in();
		$this->load->model('Employee_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		$this->load->view('dashboard/layouts/index', [
			'page_title' => 'Daftar Karyawan',
			'section_title' => 'Daftar Karyawan',
			'content' => 'dashboard/employee/index',
			'employees' => $this->Employee_model->get_all_employee()
		]);
	}

	function form_create()
	{
		$this->load->view('dashboard/layouts/index', [
			'page_title' => 'Tambah Karyawan',
			'section_title' => 'Tambah Karyawan Baru',
			'content' => 'dashboard/employee/create',
			'statuses' => $this->db->get('status_types')->result(),
			'units' => $this->db->get('units')->result(),
			'positions' => $this->db->get('positions')->result(),
			'divisions' => $this->db->get('divisions')->result(),
			'educations' => $this->db->get('educations')->result(),
			'religions' => $this->db->get('religions')->result(),
			'roles' => $this->db->get('roles')->result()
		]);
	}

	function create()
	{
		// Set rules
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[employees.nip]');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'trim|required|regex_match[/^08[0-9]{7,12}$/]', [
			'regex_match' => 'Nomor HP harus diawali 08 dan terdiri dari 9-14 digit.'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('nik_ktp', 'NIK', 'trim|numeric|min_length[16]|max_length[16]');

		if ($this->form_validation->run() === FALSE) {
			// Jika gagal, tampilkan form ulang
			$this->session->set_flashdata('toastr', [
				'type' => 'error',
				'title' => 'Gagal',
				'message' => 'Harap periksa form.'
			]);
			$this->form_create();
		} else {
			// Ambil input
			$employeeData = [
				'nip' => $this->input->post('nip'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone_number' => $this->input->post('phone_number'),
				'gender' => $this->input->post('gender'),
				'unit_id' => $this->input->post('unit_id'),
				'position_id' => $this->input->post('position_id'),
				'division_id' => $this->input->post('division_id'),
				'education_id' => $this->input->post('education_id'),
				'religion_id' => $this->input->post('religion_id'),
				'join_date' => $this->input->post('join_date'),
				'contract_start' => $this->input->post('contract_start'),
				'contract_end' => $this->input->post('contract_end'),
				'status_id' => $this->input->post('status_id'),
				'created_at' => date('Y-m-d H:i:s')
			];

			// Simpan ke tabel employees
			$employee_id = $this->Employee_model->insert($employeeData);

			if ($employee_id) {
				// Insert ke tabel users
				$userData = [
					'employee_id' => $employee_id,
					'username' => $employeeData['nip'],
					'password' => md5('123456'), // default password
					'role_id' => 4, // misal role default = staff
					'is_active' => 1,
					'created_at' => date('Y-m-d H:i:s')
				];

				$this->User_model->insert($userData);

				$this->session->set_flashdata('toastr', [
					'type' => 'success',
					'title' => 'Berhasil!',
					'message' => 'Data karyawan berhasil ditambahkan dan akun login dibuat otomatis.'
				]);
				redirect('karyawan');
			} else {
				$this->session->set_flashdata('toastr', [
					'type' => 'error',
					'title' => 'Gagal!',
					'message' => 'Terjadi kesalahan saat menyimpan data karyawan.'
				]);
				redirect('karyawan');
			}
		}
	}
}

/* End of file EmployeeController.php */
/* Location: ./application/controllers/EmployeeController.php */