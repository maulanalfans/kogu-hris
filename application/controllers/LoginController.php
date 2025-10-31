<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller LoginController
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

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		// print_r(current_user());
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}
		$this->load->view('login/index');
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login/index');
		} else {
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$user = $this->User_model->get_user($username, $password);

			if ($user && $user->is_active == 1) {
				$session_data = [
					'user_id'   => $user->id,
					'username'  => $user->username,
					'fullname'  => $user->name,
					'role_id'   => $user->role_id,
					'role_name' => $user->role_name,
					'is_active' => $user->is_active,
					'logged_in' => TRUE
				];
				// dd($session_data);
				$this->session->set_userdata($session_data);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', [
					'type' => 'error',
					'title' => 'Gagal',
					'message' => 'Username atau password salah.'
				]);
				redirect('login');
			}
		}
	}

	public function logout()
	{
		logout_user();
	}
}


/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */