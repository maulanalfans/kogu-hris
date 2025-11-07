<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OutletController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Outlet_model');
		check_role(['superadmin', 'manager_outlet']);
	}

	public function index()
	{
		$this->load->view('layouts/index', [
			'page_title' => 'Daftar Outlet',
			'section_title' => 'Daftar Outlet',
			'content' => 'outlet/index',
			'outlets' => $this->Outlet_model->get_all()
		]);
	}

	public function create()
	{
		$this->_rules();

		// hanya jalankan validasi jika request method adalah POST
		if ($this->input->method() === 'post') {
			if ($this->form_validation->run() == FALSE) {
				// hanya tampilkan toastr saat user submit form dan gagal validasi
				$this->session->set_flashdata('toastr', [
					'type' => 'error',
					'title' => 'Gagal!',
					'message' => 'Mohon periksa kembali form.'
				]);
			} else {
				// validasi sukses → simpan data baru
				$insertData = [
					'unit_name'   => $this->input->post('unit_name', true),
					'description' => $this->input->post('description', true),
					'latitude'    => $this->input->post('latitude', true),
					'longitude'   => $this->input->post('longitude', true),
				];

				$this->Outlet_model->insert($insertData);
				$this->session->set_flashdata('toastr', [
					'type' => 'success',
					'title' => 'Berhasil!',
					'message' => 'Outlet baru berhasil ditambahkan.'
				]);
				redirect('outlet');
			}
		}

		// load view (baik pertama kali GET maupun setelah submit gagal)
		$this->load->view('layouts/index', [
			'page_title' => 'Tambah Outlet',
			'section_title' => 'Tambah Outlet Baru',
			'content' => 'outlet/form'
		]);
	}

	public function update($id)
	{
		$outlet = $this->Outlet_model->get_by_id($id);
		if (!$outlet) {
			show_404();
		}

		$this->_rules();

		if ($this->input->method() === 'post') {
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('toastr', [
					'type' => 'error',
					'title' => 'Gagal!',
					'message' => 'Mohon periksa kembali form.'
				]);
			} else {
				$updateData = [
					'unit_name'   => $this->input->post('unit_name', true),
					'description' => $this->input->post('description', true),
					'latitude'    => $this->input->post('latitude', true),
					'longitude'   => $this->input->post('longitude', true),
				];

				$this->Outlet_model->update($id, $updateData);
				$this->session->set_flashdata('toastr', [
					'type' => 'success',
					'title' => 'Berhasil!',
					'message' => 'Data outlet berhasil diperbarui.'
				]);
				redirect('outlet');
			}
		}

		// tampilkan form (baik pertama kali GET maupun jika validasi gagal)
		$this->load->view('layouts/index', [
			'page_title' => 'Edit Outlet',
			'section_title' => 'Edit Outlet ' . $outlet->unit_name,
			'content' => 'outlet/form',
			'outlet' => $outlet
		]);
	}

	public function delete($id)
	{
		$outlet = $this->Outlet_model->get_by_id($id);
		if (!$outlet) {
			show_404();
		}

		$this->Outlet_model->delete($id);
		$this->session->set_flashdata('toastr', [
			'type' => 'success',
			'title' => 'Berhasil!',
			'message' => 'Outlet berhasil dihapus.'
		]);
		redirect('outlet');
	}

	private function _rules()
	{
		$this->form_validation->set_rules('unit_name', 'Nama Unit', 'required|trim|max_length[100]');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required|decimal');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required|decimal');
	}
}
