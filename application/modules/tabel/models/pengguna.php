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

	function tampil()
	{
		$kueri = $this->db->get($this->tabel);
		if($kueri->num_rows() > 0)
		{
			return $kueri->result_array();
		}
		else
		{
			return false;
		}
	}

	function cek($id)
	{
		$this->db->where('id',$id);
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

	function ceksandi($id,$sandi)
	{
		$this->db->where('id',$id);
		$this->db->where('sandi',$sandi);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function cekuname($namaPengguna)
	{
		$this->db->where('nama_pengguna',$namaPengguna);
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

	function cekemail($email)
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

	function pilih($id)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 1)
		{
			return $kueri->result_array();
		}
		else
		{
			return false;
		}
	}

	function tambah($data)
	{
		$kueri = $this->db->insert($this->tabel,$data);
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function ubah($id,$data)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->update($this->tabel,$data);
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function hapus($id)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->delete($this->tabel);
		if($kueri)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>