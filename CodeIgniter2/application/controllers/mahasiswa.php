<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class mahasiswa extends CI_Controller {

        // fungsi akan dijalankan saat classnya di instansiasi
     public function __construct()
     {
         // digunakan untuk menjalankan fungsi construct pada class parent (ci_controller)
         parent::__construct();
         $this->load->database();
         $this->load->model('mahasiswa_model');

     }

    public function index() 
    {
        // $this->load->model('mahasiswa_model');
        // modul untuk load database
        // $this->load->database();
        $data ['title']='List Mahasiswa';
        $data ['mahasiswa']=$this->mahasiswa_model->getAllmahasiswa();      
        if($this->input->post('keyword')){
            $data['mahasiswa']=$this->mahasiswa_model->cariDataMahasiswa();
        }
        
        $this->load->view('home/header',$data);
        $this->load->view('mahasiswa/index',$data);
        $this->load->view('template/footer');
    }

    public function tambah(){
        $data['title']='Form menambahkan data mahasiswa';
        $data['jurusan']=['Teknik informatika','Teknik Kimia','Teknik Industri','Teknik Mesin'];
        
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('nim','Nim','required|numeric');
        $this->form_validation->set_rules('email','Email','required|valid_email');

        if($this->form_validation->run()== FALSE){
            
        $this->load->view('home/header',$data);
        $this->load->view('mahasiswa/tambah',$data);
        }else {
            # code...
            $this->mahasiswa_model->tambahdatamhs();
            $this->session->set_flashdata('flash-data','ditambahkan');
            redirect('mahasiswa','refresh');
        }    
    }
    public function hapus($id){

        $this->mahasiswa_model->hapusdatamhs($id);
        // untuk     flashdata mempunyai 2 parameter (nama flashdata/alias,isi dari flashdatanya)
        $this->session->set_flashdata('flash-data','dihapus');
        redirect('mahasiswa','refresh');
    }
    public function detail($id){
        $data['title']='Detail Mahasiswa';
        $data['mahasiswa']=$this->mahasiswa_model->getmahasiswaById($id);
        $this->load->view('template/header',$data);
        $this->load->view('mahasiswa/detail',$data);
        $this->load->view('template/footer');
    }
    public function edit($id){
        $data['title']='Form edit data Mahasiswa';
        $data['mahasiswa']=$this->mahasiswa_model->getmahasiswaById($id);
        $data['jurusan']=['Teknik Informatika','Teknik Kimia','Teknik Industri','Teknik Mesin'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'Nim', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($this->form_validation->run()== FALSE){
            
            $this->load->view('template/header',$data);
            $this->load->view('mahasiswa/edit',$data);
            $this->load->view('template/footer');
            }else {
                # code...
                $this->mahasiswa_model->tambahdatamhs();
                $this->session->set_flashdata('flash-data','diedit');
                redirect('mahasiswa','refresh');
            }
            
            
        }

}

/* End of file Home.php */

?>
