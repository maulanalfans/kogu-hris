<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller DashboardController
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

class DashboardController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_logged_in();
		check_role(['superadmin', 'manager_outlet']);
	}

	public function index()
	{
		$this->load->view('dashboard/layouts/index', [
			'page_title' => 'Dashboard',
			'section_title' => 'Dashboard',
			'current_user' => (object) current_user(),
			'content' => 'dashboard/index',
		]);
	}
}


/* End of file DashboardController.php */
/* Location: ./application/controllers/DashboardController.php */