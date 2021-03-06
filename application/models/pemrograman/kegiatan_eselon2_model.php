<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 @author     :  Yusup JS
 @date       : 2014-08-22 23:30
 @fungsi	 : 
 @revision	 :
*/
	

class Kegiatan_eselon2_model extends CI_Model
{ 
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['kode_e1'])) $where .= " and prog.kode_e1='".$params['kode_e1']."'";
			if (isset($params['kode_e2'])) $where .= " and f.kode_e2='".$params['kode_e2']."'";
			if (isset($params['tahun'])) $where .= " and f.tahun ='".$params['tahun']."'";
		}
		$sql = "select f.*, e2.nama_e2,prog.nama_program from anev_kegiatan_eselon2 f inner join anev_eselon2 e2 on e2.kode_e2=f.kode_e2 and f.tahun between left(e2.tahun_renstra,4) and right(e2.tahun_renstra,4) left join anev_program_eselon1 prog on f.kode_program = prog.kode_program and f.tahun = prog.tahun".$where;
		$sql .= " group by f.kode_kegiatan order by f.tahun desc, f.kode_kegiatan";
		echo $sql;
		return $this->mgeneral->run_sql($sql);
	}
	
	function get_list($params) {
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['kode_program'])) $where .= " and kode_program='".$params['kode_program']."'";
			if (isset($params['tahun'])) $where .= "and tahun = ".$params['tahun'];
			if (isset($params['tahun_renstra'])) $where .= " and tahun between left('".$params['tahun_renstra']."',4) and right('".$params['tahun_renstra']."',4)";
		}
		$sql = "select distinct distinct kode_kegiatan, nama_kegiatan from anev_kegiatan_eselon2 ".$where;
		//$this->db->escape($tahun_renstra);
		$result = $this->mgeneral->run_sql($sql);
		$list[0] = 'Pilih Kegiatan';
		if (isset($params['isNotMandatory'])) $list[0] = 'Semua Kegiatan';
		if (isset($result)){
			foreach ($result as $i) {
				$list[$i->kode_kegiatan] = $i->nama_kegiatan;
			}
		}
		return $list;	
	}
	
	function get_jml_kegiatan($params){		
		$rs = $this->mgeneral->run_sql('select count(distinct kode_kegiatan) as jml_kegiatan from anev_kegiatan_eselon2 f inner join anev_eselon2 e on  f.kode_e2=e.kode_e2 and f.tahun between left(e.tahun_renstra,4) and right(e.tahun_renstra,4) where 1=1  '.$params);
		//var_dump($rs);
		return $rs[0]->jml_kegiatan;
		//$this->mgeneral->getValue('count(kode_e1)', $params, 'anev_program_eselon1');
	}

	function get_renstra($params){
		$where = ' where 1=1 ';
		if (isset($params)){
			if (isset($params['kode_e1'])) $where .= " and e.kode_e1='".$params['kode_e1']."'";
			if (isset($params['kode_e2'])) $where .= " and f.kode_e2='".$params['kode_e2']."'";
			if (isset($params['tahun_renstra'])) $where .= " and f.tahun between left('".$params['tahun_renstra']."',4) and right('".$params['tahun_renstra']."',4)";
		}
		$sql = "select distinct kode_kegiatan, nama_kegiatan,e.nama_e2,f.kode_e2,e1.nama_e1,e.kode_e1 from anev_kegiatan_eselon2 f inner join anev_eselon2 e on f.kode_e2=e.kode_e2 and f.tahun between left(e.tahun_renstra,4) and right(e.tahun_renstra,4) inner join anev_eselon1 e1 on e1.kode_e1=e.kode_e1 and e.tahun_renstra = e1.tahun_renstra ".$where;
		return $this->mgeneral->run_sql($sql);
	}
	
	function get_kegiatan_list($tahun_awal, $tahun_akhir,$e1,$mandatory) {
		$where = '';
		if ($e1!=0) $where = " and kode_e2 LIKE '".$e1."%'";
		
		$sql = "select distinct kode_sk_e2, deskripsi from anev_sasaran_kegiatan where tahun<=$tahun_akhir and tahun>=$tahun_awal".$where;
		$result = $this->mgeneral->run_sql($sql);
		if($mandatory=="no"): $list[0] = "Semua Sasaran Strategis"; else: $list[0] = 'Pilih Sasaran Strategis'; endif;
		foreach ($result as $i) {
			$list[$i->kode_sk_e2] = $i->deskripsi;
		}
		return $list;	
	}
	
	function get_pendanaan($params)
	{
		$where = " where a.tahun_renstra = '".$params['tahun_renstra']."'";
		
		if (isset($params)){
			if (isset($params['kode_e1'])) $where .= " and c.kode_e1='".$params['kode_e1']."'";
			if (isset($params['kode_e2'])) $where .= " and a.kode_e2='".$params['kode_e2']."'";
		}
		$sql = "SELECT * FROM anev_pendanaan_kegiatan a inner join anev_kegiatan_eselon2 b ON a.kode_kegiatan = b.kode_kegiatan inner join anev_eselon2 c ON b.kode_e2 = c.kode_e2 ".$where." group by a.kode_kegiatan";
		//echo $sql;
		return $this->mgeneral->run_sql($sql);
	}
	
	function get_ikk($e2) {
		
		$sql = "select distinct kode_ikk, deskripsi from anev_ikk where kode_e2 = '".$e2."'";
		$result = $this->mgeneral->run_sql($sql);
		$list[0] = 'Pilih IKK';
		foreach ($result as $i) {
			$list[$i->kode_ikk] = $i->deskripsi;
		}
		return $list;	
	}
}

