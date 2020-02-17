<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index($name='') 
    {
        $data['title']='Home';
        $data['name']=$name;
        $this->load->view('home/header',$data);
       
        $this->load->view('home/index',$data);
        $this->load->view('home/footer');
    }

}

/* End of file Home.php */

?>
