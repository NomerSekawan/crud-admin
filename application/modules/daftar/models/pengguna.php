<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengguna extends CI_Model
{
	private $tabel = 'pengguna';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function cekmail($email)
	{
		$this->db->where('email',$email);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function cekname($nama_pengguna)
	{
		$this->db->where('nama_pengguna',$nama_pengguna);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function daftar($data)
	{
		$kueri = $this->db->insert($this->tabel,$data);
		if($kueri)
		{
			$this->db->where('nama_pengguna',$data['nama_pengguna']);
			$this->db->where('sandi',$data['sandi']);
			$kueri = $this->db->get_where($this->tabel);
			if($kueri->num_rows() == 1)
			{
				return $kueri->row();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}

?>