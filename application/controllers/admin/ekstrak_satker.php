<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 @author     : Yusup JS
 @date       : 2014-08-31 00:00
 @revision	 :
*/

class Ekstrak_satker extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
		$this->load->library('datatables');
		$this->load->model('/admin/satker_model','satker');
		$this->load->model('/admin/tahun_renstra_model','tahun_renstra');
		$this->load->model('/unit_kerja/eselon1_model','eselon1');
		
	}
	function index()
	{
		#settingan untuk static template file
		$setting['sd_left']	= array('cur_menu'	=> "ADMIN");
		$setting['page']	= array('pg_aktif'	=> "datatables");
		$template			= $this->template->load($setting); #load static template file
		
		$data['data']		= null;//
		$template['konten']	= $this->load->view('admin/ekstrak_v',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container',$template);
	}
	
	
	function loadpage($tahun_renstra,$kode)
	{
		
		$data['data'] = null;//$this->fungsi->get_all(null);
		//$data['tipe_data'] = $this->eperformance->get_list();
		$data['eselon1']	= $kode;//$this->eselon1->get_list(null);
		$data['tahun_renstra']	= $tahun_renstra;// // $this->tahun_renstra->get_list(null);
		echo $this->load->view('admin/satker_v',$data,true); #load konten template file		
	}
	
	
	function add()
	{
		#settingan untuk static template file
		$setting['sd_left']	= array('cur_menu'	=> "ADMIN");
		$setting['page']	= array('pg_aktif'	=> "form");
		$template			= $this->template->load($setting); #load static template file
		
		$data['url']		= base_url()."unit_kerja/anev_kl/save";
		$template['konten']	= $this->load->view('unit_kerja/anev_kl_form',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container',$template);
	}
	function getdata_satker($tahun_renstra,$kode){
		$params = null;
		//echo $this->satker->get_datatables($params);
		$data = $this->satker->get_datatables(array("tahun_renstra"=>$tahun_renstra,"kode_e1"=>$kode));
		//var_dump($data);
		//echo json_encode($data);
		echo $data;
	}
	
	function save()
	{
		$kode	= $this->input->post("kode");
		$nama	= $this->input->post("nama");
		$singkat= $this->input->post("singkatan");
		
		$varData	= array('kode_kl'	=> $kode,
							'nama_kl'	=> $nama,
							'singkatan'	=> $singkat);
		$this->mgeneral->save($varData,"anev_kl");
		
		$msg = '<div class="alert alert-success" style="text-align:center"> 
					<strong><i class="fa fa-check-square-o"></i> Sukses</strong> Data berhasil ditambahkan.  
					<button id="autoClose" data-dismiss="alert" class="close" type="button">×</button>
				</div>';
				
		$this->session->set_flashdata('msg', $msg);
		redirect("unit_kerja/anev_kl","refresh");	
	}
	
	function edit($id)
	{
		#settingan untuk static template file
		$setting['sd_left']	= array('cur_menu'	=> "UNIT_KERJA");
		$setting['page']	= array('pg_aktif'	=> "form");
		$template			= $this->template->load($setting); #load static template file
		
		$data['data']		= $this->mgeneral->getWhere(array('kode_kl'=>$id),"anev_kl");
		$data['url']		= base_url()."unit_kerja/anev_kl/update";
		$template['konten']	= $this->load->view('unit_kerja/anev_kl_form',$data,true); #load konten template file
		
		#load container for template view
		$this->load->view('template/container',$template);
	}
	
	function update()
	{
		$id		= $this->input->post("id");
		$kode	= $this->input->post("kode");
		$nama	= $this->input->post("nama");
		$singkat= $this->input->post("singkatan");
		
		$varData	= array('kode_kl'	=> $kode,
							'nama_kl'	=> $nama,
							'singkatan'	=> $singkat);
		$this->mgeneral->update(array('kode_kl'=>$id),$varData,"anev_kl");
		
		$msg = '<div class="alert alert-success" style="text-align:center"> 
					<strong><i class="fa fa-check-square-o"></i> Sukses</strong> Data berhasil diubah.  
					<button id="autoClose" data-dismiss="alert" class="close" type="button">×</button>
				</div>';
				
		$this->session->set_flashdata('msg', $msg);
		redirect("unit_kerja/anev_kl","refresh");
	}
	
	function hapus($id)
	{
		$this->mgeneral->delete(array('kode_kl'=>$id),"anev_kl");
		
		$msg = '<div class="alert alert-success" style="text-align:center"> 
					<strong><i class="fa fa-check-square-o"></i> Sukses</strong> Data berhasil dihapus.  
					<button id="autoClose" data-dismiss="alert" class="close" type="button">×</button>
				</div>';
				
		$this->session->set_flashdata('msg', $msg);
		redirect("unit_kerja/anev_kl","refresh");
	}
}