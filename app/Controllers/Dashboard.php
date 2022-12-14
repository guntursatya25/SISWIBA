<?php

namespace App\Controllers;

use App\Models\DataModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$Query = new DataModel();
		$data = [
			'title' => "Sistem Informasi Sekolah Wilayah Banyumas",
			'appname' => "SISWIBA",
			'heading' => "Dashboard",
			'data' => $Query->getSekolah(),
			'sd' => $Query->countSekolah("SD"),
			'smp' => $Query->countSekolah("SMP"),
			'sma' => $Query->countSekolah("SMA"),
			'smk' => $Query->countSekolah("SMK")
		];
		return view('v_dashboard', $data);
	}

	//--------------------------------------------------------------------

}
