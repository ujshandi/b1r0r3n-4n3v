<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 @author     :  Yusup JS
 @date       : 2014-08-16 00:00
 @revision	 :
*/

class Profil_eselon1 extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
		$this->load->model('/admin/eselon1_model','eselon1');
		$this->load->model('/admin/eselon2_model','eselon2');
		$this->load->model('/admin/fungsi_eselon1_model','fungsi_e1');
	}	
	function index()
	{
		#settingan untuk static template file
		$setting['sd_left']	= array('cur_menu'	=> "LAPORAN");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file		
		$data['eselon1'] = $this->eselon1->get_all(null);
		$template['konten']	= $this->load->view('laporan/profil_eselon1_v',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container',$template);
	}
	
	
	function get_unit_kerja($e1){
		$data = $this->eselon2->get_all(array("kode_e1"=>$e1));
		//var_dump($data);
		$rs = '<ol>';
		foreach($data as $d){
			$rs .= '<li>'.$d->nama_e2.'</li>';
		 }
		 $rs .= '</ol>';
		echo $rs;
	}
	
	function get_fungsi($tahun,$e1){
		$data = $this->fungsi_e1->get_all(array("kode_e1"=>$e1,"tahun_renstra"=>$tahun));
		
		$rs = '<ol>';
		foreach($data as $d){
			$rs .= '<li>'.$d->fungsi_e1.'</li>';
		 }
		 $rs .= '</ol>';
		echo $rs;
	}

}