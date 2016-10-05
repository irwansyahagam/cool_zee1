<?php 

class Pengeluaran extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Login Gagal !! Usernamae atau Password Salah !!');
            redirect('');
        };

        $this->load->model('model_app'); 
        $this->load->helper('currency_format_helper');

	}

	function index(){
		$data=array(
			'title'=>'Pengeluaran Barang',
            'active_pengeluaran'=>'active',
            'data_pengeluaran'=>$this->model_app->getalldatapengeluaran(),
			);
		$this->load->view('element/v_header',$data);
        $this->load->view('pages/v_pengeluaran');
        $this->load->view('element/v_footer');

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
	}

    function editbarangpeng(){
        $kode['id']=$this->input->post('idbrgupd'); 
        $data=array(
            'nama'=>$this->input->post('nm_barangupd'), 
            'tgl'=>tglinsertdata($this->input->post('tgledit')), 
            'harga'=>$this->input->post('hrgedit'), 
            'jumlah'=>$this->input->post('jlhedit')
            ); 
        $this->db->update('tbl_pengeluaran',$data,$kode); 
        redirect('pengeluaran'); 
    }

}