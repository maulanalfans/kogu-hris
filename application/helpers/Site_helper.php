<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers Site_helper
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

if (!function_exists('menuAttributes')) {

	function menuAttributes()
	{
		$CI = &get_instance();
		$role = $CI->session->userdata('role_id');

		if ($role == '1') {
			$menu = array(
				array(
					'menu' => 'Dashboard',
					'icon' => 'icofont-ui-home',
					'url' => 'dashboard',
				),
				array(
					'menu' => 'Karyawan',
					'icon' => 'icofont-people',
					'url' => '#',
					'has_child' => TRUE,
					'childMenu' => array(
						array(
							'pos' => 1,
							'childMenu' => "Kelola Karyawan",
							'url' => 'karyawan'
						), array(
							'pos' => 2,
							'childMenu' => "Gaji Karyawan",
							'url' => '#'
						), array(
							'pos' => 3,
							'childMenu' => "Laporan Karyawan",
							'url' => '#'
						)
					)
				),
				array(
					'menu' => 'Kelola Outlet',
					'icon' => 'icofont-building',
					'url' => '#',
				),
			);
		} else if ($role == '2') {
			$menu = array(
				array(
					'menu' => 'Dashboard',
					'icon' => 'icofont-ui-home',
					'url' => '#',
				),
				array(
					'menu' => 'Karyawan',
					'icon' => 'icofont-people',
					'url' => '#',
					'has_child' => TRUE,
					'childMenu' => array(
						array(
							'pos' => 1,
							'childMenu' => "Kelola Karyawan",
							'url' => '#'
						),
					)
				), array(
					'menu' => 'Kelola Outlet',
					'icon' => 'icofont-building',
					'url' => '#',
				),
			);
		}

		return $menu;
	}
}

if (!function_exists('menuActive')) {
	function menuActive($name, $url)
	{
		$active = ($name == $url) ? 'active' : '';
		return $active;
	}
}

if (!function_exists('indonesianDate')) {
	function indonesianDate($date, $format = 'default')
	{
		if (empty($date) || $date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
			return '-';
		}

		$bulanIndo = [
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		];

		$hariIndo = [
			'Sunday' => 'Minggu',
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu'
		];

		try {
			$dt = new DateTime($date);
		} catch (Exception $e) {
			return '-';
		}

		$day = (int)$dt->format('d');
		$month = (int)$dt->format('m');
		$year = $dt->format('Y');
		$time = $dt->format('H:i');
		$dayName = $hariIndo[$dt->format('l')] ?? $dt->format('l');
		$isDatetime = (strpos($date, ':') !== false);

		switch ($format) {
			case 'short':
				return $isDatetime ? "$day/$month/$year $time" : "$day/$month/$year";

			case 'full':
				return $isDatetime
					? "$dayName, $day " . $bulanIndo[$month] . " $year $time"
					: "$dayName, $day " . $bulanIndo[$month] . " $year";

			case 'default':
			default:
				return $isDatetime
					? "$day " . $bulanIndo[$month] . " $year $time"
					: "$day " . $bulanIndo[$month] . " $year";
		}
	}
}

if (!function_exists('generate_breadcrumb')) {
	function generate_breadcrumb()
	{
		$CI = &get_instance();
		$total_segments = $CI->uri->total_segments();
		$breadcrumb = '<nav aria-label="breadcrumb"><ol class="breadcrumb p-2">';

		// Home link
		$breadcrumb .= '<li class="breadcrumb-item"><a href="#">Home</a></li>';

		$link = '';

		for ($i = 1; $i <= $total_segments; $i++) {
			$segment = $CI->uri->segment($i);
			$link .= $segment . '/';

			// Jika ini adalah segment terakhir → aktif
			if ($i == $total_segments) {
				$breadcrumb .= '<li class="breadcrumb-item active" aria-current="page"> <i>'
					. ucfirst(str_replace('-', ' ', $segment)) . '</i></li>';
			} else {
				$breadcrumb .= '<li class="breadcrumb-item"><a href="#">'
					. ucfirst(str_replace('-', ' ', $segment)) . '</a></li>';
			}
		}

		$breadcrumb .= '</ol></nav>';

		return $breadcrumb;
	}
}


// ------------------------------------------------------------------------

/* End of file Site_helper.php */
/* Location: ./application/helpers/Site_helper.php */