<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class mahasiswa_model extends CI_Model {

    public function getAllmahasiswa()
{
    return $this->db->get('mahasiswa')->result_array();
}

    public function tambahdatamhs(){
        $data=[
        "nama"=>$this->input->post('nama',true),
        "nim"=>$this->input->post('nim',true),
        "email"=>$this->input->post('email',true),
        "jurusan"=>$this->input->post('jurusan',true)
        ];

        $this->db->insert('mahasiswa',$data);
    }
    public function hapusdatamhs($id){
        $this->db->where('id',$id);
        $this->db->delete('mahasiswa');
    }

    public function getmahasiswaById($id){
        return $this->db->get_where('mahasiswa',['id'=>$id])->row_array();
    }

    public function ubahdatamhs(){
        $data=[
            "nama" => $this->input->post('nama',true),
            "nim" => $this->input->post('nim',true),
            "email" => $this->input->post('email',true),
            "jurusan" => $this->input->post('jurusan',true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mahasiswa',$data);

    }
    public function cariDataMahasiswa(){
        $keyword = $this->input->post('keyword');
        $this->db->like('nama',$keyword);
        $this->db->or_like('jurusan',$keyword);
        return $this->db->get('mahasiswa')->result_array();
    } 



}
/* End of file ModelName.php */
?>