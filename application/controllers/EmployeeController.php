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
 * @link 	  https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EmployeeController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_logged_in();
		$this->load->model('Employee_model');
		$this->load->model('User_model');
		check_role(['superadmin', 'manager_outlet']);
	}

	public function index()
	{
		$this->load->view('layouts/index', [
			'page_title' => 'Daftar Karyawan',
			'section_title' => 'Daftar Karyawan',
			'content' => 'employee/index',
			'employees' => $this->Employee_model->get_all_employee()
		]);
	}

	function form_create()
	{
		$this->load->view('layouts/index', [
			'page_title' => 'Tambah Karyawan',
			'section_title' => 'Tambah Karyawan Baru',
			'content' => 'employee/create',
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
		$this->form_validation->set_rules('city', 'Kota', 'trim|required');
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
				'nik_ktp' => $this->input->post('nik_ktp'),
				'phone_number' => $this->input->post('phone_number'),
				'gender' => $this->input->post('gender'),
				'city' => $this->input->post('city'),
				'birth_date' => $this->input->post('birth_date'),
				'unit_id' => $this->input->post('unit_id'),
				'position_id' => $this->input->post('position_id'),
				'division_id' => $this->input->post('division_id'),
				'education_id' => $this->input->post('education_id'),
				'religion_id' => $this->input->post('religion_id'),
				'join_date' => $this->input->post('join_date'),
				'contract_start' => $this->input->post('contract_start'),
				'contract_end' => $this->input->post('contract_end'),
				'status_id' => $this->input->post('status_id'),
				'created_by' => $this->session->userdata('user_id'),
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
					'role_id' => $this->input->post('role_id'),
					'is_active' => 1,
					'created_at' => date('Y-m-d H:i:s')
				];

				$this->User_model->insert($userData);

				$this->session->set_flashdata('toastr', [
					'type' => 'success',
					'title' => 'Berhasil!',
					'message' => 'Data karyawan berhasil ditambahkan dan akun login dibuat otomatis.'
				]);
			} else {
				$this->session->set_flashdata('toastr', [
					'type' => 'error',
					'title' => 'Gagal!',
					'message' => 'Terjadi kesalahan saat menyimpan data karyawan.'
				]);
			}
			redirect('karyawan');
		}
	}

	function import_xlsx()
	{
		$this->form_validation->set_rules('importEmployee', 'File Karyawan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('toastr', [
				'type' => 'error',
				'title' => 'Gagal!',
				'message' => validation_errors()
			]);
			redirect('karyawan');
		}
	}

	function view($id)
	{
		$employee = $this->Employee_model->getEmployeeDetail($id);
		if (!$employee) {
			show_404();
		}
		$this->load->view('layouts/index', [
			'page_title' => 'Detail Karyawan',
			'section_title' => $employee->name,
			'content' => 'employee/view',
			'employee_data' => $employee,
		]);
	}

	public function update($id)
	{
		$employee = $this->Employee_model->get_by_id($id);
		$employee_roles = $this->User_model->get_users_role($employee->id);

		if (!$employee) {
			show_404();
		}

		// ======= Validation Rules =======
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|callback__check_unique_nip[' . $id . ']');
		$this->form_validation->set_rules('city', 'Kota', 'trim|required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'trim|required|regex_match[/^08[0-9]{7,12}$/]', [
			'regex_match' => 'Nomor HP harus diawali 08 dan terdiri dari 9-14 digit.'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__check_unique_email[' . $id . ']');
		$this->form_validation->set_rules('nik_ktp', 'NIK', 'trim|numeric|min_length[16]|max_length[16]');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('layouts/index', [
				'page_title' => 'Edit Data Karyawan',
				'section_title' => 'Edit Data Karyawan',
				'content' => 'employee/edit',
				'employee' => $employee,
				'employee_roles' => $employee_roles,
				'statuses' => $this->db->get('status_types')->result(),
				'units' => $this->db->get('units')->result(),
				'positions' => $this->db->get('positions')->result(),
				'divisions' => $this->db->get('divisions')->result(),
				'educations' => $this->db->get('educations')->result(),
				'religions' => $this->db->get('religions')->result(),
				'roles' => $this->db->get('roles')->result()
			]);
		} else {
			// ======= Prepare Updated Data =======
			$employeeData = [
				'nip' => $this->input->post('nip'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'nik_ktp' => $this->input->post('nik_ktp'),
				'phone_number' => $this->input->post('phone_number'),
				'gender' => $this->input->post('gender'),
				'city' => $this->input->post('city'),
				'birth_date' => $this->input->post('birth_date'),
				'unit_id' => $this->input->post('unit_id'),
				'position_id' => $this->input->post('position_id'),
				'division_id' => $this->input->post('division_id'),
				'education_id' => $this->input->post('education_id'),
				'religion_id' => $this->input->post('religion_id'),
				'join_date' => $this->input->post('join_date'),
				'contract_start' => $this->input->post('contract_start'),
				'contract_end' => $this->input->post('contract_end'),
				'status_id' => $this->input->post('status_id'),
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->Employee_model->update($id, $employeeData);

			// ======= Update ke tabel Users =======
			$user = $this->User_model->get_by_employee($id);
			if ($user) {
				// Jika NIP berubah, update username juga
				if ($user->username !== $employeeData['nip']) {
					$this->User_model->update($user->id, [
						'username' => $employeeData['nip'],
						'role_id' => $this->input->post('role_id'),
						'updated_at' => date('Y-m-d H:i:s')
					]);
				} else {
					// Jika NIP sama, update role saja
					$this->User_model->update($user->id, [
						'role_id' => $this->input->post('role_id'),
						'updated_at' => date('Y-m-d H:i:s')
					]);
				}
			} else {
				$this->session->set_flashdata('toastr', [
					'type' => 'error',
					'title' => 'Gagal',
					'message' => 'Harap periksa form.'
				]);
			}

			$this->session->set_flashdata('toastr', [
				'type' => 'success',
				'title' => 'Berhasil!',
				'message' => 'Data karyawan berhasil diperbarui.'
			]);

			redirect('karyawan/' . $id);
		}
	}

	/**
	 * Custom Validation: Check Unique NIP except current employee
	 */
	public function _check_unique_nip($nip, $id)
	{
		$exists = $this->Employee_model->check_nip_exists($nip, $id);
		if ($exists) {
			$this->form_validation->set_message('_check_unique_nip', 'NIP sudah digunakan karyawan lain.');
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Custom Validation: Check Unique Email except current employee
	 */
	public function _check_unique_email($email, $id)
	{
		$exists = $this->Employee_model->check_email_exists($email, $id);
		if ($exists) {
			$this->form_validation->set_message('_check_unique_email', 'Email sudah digunakan karyawan lain.');
			return FALSE;
		}
		return TRUE;
	}

	public function delete($id)
	{
		// Cek apakah data karyawan ada
		$employee = $this->Employee_model->get_by_id($id);
		if (!$employee) {
			$this->session->set_flashdata('toastr', [
				'type' => 'error',
				'title' => 'Gagal!',
				'message' => 'Data karyawan tidak ditemukan.'
			]);
			redirect('karyawan');
			return;
		}

		// Hapus akun user terkait (jika ada)
		$this->User_model->delete_by_employee_id($id);

		// Hapus data employee
		$this->Employee_model->delete($id);

		// Flash message
		$this->session->set_flashdata('toastr', [
			'type' => 'success',
			'title' => 'Berhasil!',
			'message' => 'Data karyawan berhasil dihapus.'
		]);
		redirect('karyawan');
	}
}

/* End of file EmployeeController.php */
/* Location: ./application/controllers/EmployeeController.php */