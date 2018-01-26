<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sirket_Model extends CI_Model{
	
	public function sirketleri_Getir(){
		$query = $this->db->query('SELECT * FROM tbl_stajyeri where durum=1');
		return $query->result();
	}
	
	public function onaylanmamıs_sirketleri_Getir()
	{
		$query = $this->db->query('SELECT * FROM `tbl_ogrenciler` INNER JOIN tbl_stajyeri on tbl_ogrenciler.ogrenci_sirket_id=tbl_stajyeri.id where durum=0');
		return $query->result();
	}
	public function reddedilen_sirketleri_Getir()
	{
		$query = $this->db->query('SELECT * FROM `tbl_ogrenciler` INNER JOIN tbl_stajyeri on tbl_ogrenciler.ogrenci_sirket_id=tbl_stajyeri.id where durum=2');
		return $query->result();
	}
	public function reddedilmeyen_sirketleri_Getir()
	{
		$query = $this->db->query('SELECT * FROM `tbl_stajyeri` WHERE durum=0 or durum=1');
		return $query->result();
	}
	public function sirket_Ekle($data){
		$this->db->insert('tbl_stajyeri',$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function idye_göre_sirket_Getir($id){
	$result = $this->db->get_where("tbl_stajyeri",array('id' => $id))->result();
	return $result;
	}

	public function sirket_Guncelle($id,$data){
		$this->db->where('id', $id);
		$this->db->update('tbl_stajyeri',$data);
	}
	
	public function sirket_Sil($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_stajyeri');
		}


}
?>