<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers Auth_helper
 *
 * This Helpers for ...
 * 
 * @package   CodeIgniter
 * @category  Helpers
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 *
 */

// ------------------------------------------------------------------------

//  * Cek apakah user sudah login
//  * Jika belum, redirect ke halaman login

if (!function_exists('check_logged_in')) {
	function check_logged_in()
	{
		$CI = &get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');

		if (!$CI->session->userdata('logged_in')) {
			$CI->session->set_flashdata('error', [
				'type' => 'error',
				'title' => 'Gagal',
				'message' => 'Silakan login terlebih dahulu untuk melanjutkan.'
			]);
			redirect('login');
			exit;
		}
	}
}


//  * Cek apakah user memiliki role tertentu
//  * Bisa menerima satu role atau array role

if (!function_exists('check_role')) {
	function check_role($roles = [])
	{
		$CI = &get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');

		$user_role = $CI->session->userdata('role_name'); // Pastikan role_name diset di session saat login

		if (empty($user_role)) {
			redirect('login');
			exit;
		}

		if (!is_array($roles)) {
			$roles = [$roles];
		}

		if (!in_array($user_role, $roles)) {
			$CI->session->set_flashdata('error', [
				'type' => 'error',
				'title' => 'Gagal',
				'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.'
			]);
			redirect('dashboard');
			exit;
		}
	}
}


// * Mendapatkan data user aktif dari session

if (!function_exists('current_user')) {
	function current_user()
	{
		$CI = &get_instance();
		$CI->load->library('session');
		return [
			'user_id'   => $CI->session->userdata('user_id'),
			'fullname'  => $CI->session->userdata('fullname'),
			'username'  => $CI->session->userdata('username'),
			'role_id'   => $CI->session->userdata('role_id'),
			'role_name' => $CI->session->userdata('role_name'),
			'is_active' => $CI->session->userdata('is_active'),
			'logged_in' => $CI->session->userdata('logged_in'),
		];
	}
}


//  * Logout user (hapus semua session)

if (!function_exists('logout_user')) {
	function logout_user()
	{
		$CI = &get_instance();
		$CI->load->library('session');
		$CI->session->sess_destroy();
		redirect('login');
	}
}

// ------------------------------------------------------------------------

/* End of file Auth_helper.php */
/* Location: ./application/helpers/Auth_helper.php */