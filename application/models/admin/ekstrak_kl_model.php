<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 @author     :  Yusup JS
 @date       : 2014-08-31
 @fungsi	 : 
 @revision	 :
*/
	

class Ekstrak_kl_model extends CI_Model
{ 
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	
	
	function get_datatables($params){
		$this->datatables->select('kode_kl,nama_kl ');
		$this->datatables->from('anev_kl');
		if (isset($params)){
			if (isset($params['tahun_renstra']))
			$this->datatables->where('tahun_renstra',$params['tahun_renstra']);
		}
		$aOrder =isset($_POST['iSortCol_0'])?$_POST['iSortCol_0']:0;
		$aOrderDir =isset($_POST['sSortDir_0'])?$_POST['sSortDir_0']:"ASC";
		$sOrder = "";
	/*	if ( isset( $aOrder ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<count($aOrder) ; $i++ )
			{
				if ( $aCols[intval($aOrder[$i]['column'])]['orderable'] == "true" )
				{
					$sOrder .= $aCols[intval($aOrder[$i]['column'])]['data']." ".($aOrder[$i]['dir']=='asc' ? 'ASC' : 'DESC') .", ";
				}
			}
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}*/
		//$this->datatables->join('anev_eselon1 e1', 'e1.kode_e1=e2.kode_e1 and e1.tahun_renstra=e2.tahun_renstra', 'left');
		//$this->datatables->add_column('aksi', '$1','e2_action(e2.kode_e2)');
		return $this->datatables->generate();
	
	}
	
	function save_ekstrak($data){
		$this->db->trans_start();
		// foreach($data as $d){
			// $this->db->insert('anev_matriks_pembangunan', $d);
		// }
		
		foreach ($data as $update_item) {
			// $insert_query = $this->db->insert_string('anev_kl', $update_item);
			// $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
			//var_dump($insert_query);
			// $this->db->query($insert_query);  
			$sql = 'INSERT INTO anev_kl (tahun_renstra,kode_kl,nama_kl,singkatan)
					VALUES (?, ?,?,?)
					ON DUPLICATE KEY UPDATE 
						nama_kl=VALUES(nama_kl),singkatan=VALUES(singkatan)';

			$query = $this->db->query($sql, array( $update_item['tahun_renstra'], 
												  $update_item['kode_kl'],$update_item['nama_kl'],$update_item['singkatan']
												  )); 
		}
		
		$this->db->trans_complete();
			//print_r($this->db);die;
	    return $this->db->trans_status();
	
	}


}

