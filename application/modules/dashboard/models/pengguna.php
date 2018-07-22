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

	function tampil($limit)
	{
		$this->db->limit($limit);
		$this->db->order_by('id','DESC');
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

	function pilih($id)
	{
		$this->db->where('id',$id);
		$kueri = $this->db->get_where($this->tabel);
		if($kueri->num_rows() == 1)
		{
			foreach($kueri->result() as $result)
			{
                $data = array(
                	'nama_lengkap' => $result->nama_lengkap,
                	'email' => $result->email,
                	'nama_pengguna' => $result->nama_pengguna,
                	'jenis_kelamin' => $result->jenis_kelamin,
                	'tgl_lahir' => $result->tgl_lahir,
                    'photo' => $result->photo);
            }
        }
        return $data;
	}
}

?>