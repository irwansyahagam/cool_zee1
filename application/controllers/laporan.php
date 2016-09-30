<?php
class Laporan extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
        $this->load->model('model_app');
        $this->load->helper('currency_format_helper');
    }

    function index(){
        $data=array(
            'title'=>'Laporan Penjualan',
            'active_laporan'=>'active',
            'data_penjualan'=>$this->model_app->getAllDataPenjualan(),
        );
        $this->session->unset_userdata('tgl_awal');
        $this->session->unset_userdata('tgl_akhir');

        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_lap_penjualan');
        $this->load->view('element/v_footer');
    }

    function cari(){
        $tgl_awal= date("Y-m-d",strtotime($this->input->post('tgl_awal')));
        $tgl_akhir= date("Y-m-d",strtotime($this->input->post('tgl_akhir')));
        $sess_data=array(
            'tgl_awal'=>$tgl_awal,
            'tgl_akhir'=>$tgl_akhir
        );
        $this->session->set_userdata($sess_data);
        $data=array(
            'dt_result'=> $this->model_app->getLapPenjualan($tgl_awal,$tgl_akhir),
            'tgl_awal'=>date("d M Y",strtotime($this->session->userdata('tgl_awal'))),
            'tgl_akhir'=>date("d M Y",strtotime($this->session->userdata('tgl_akhir'))),
        );
        $this->load->view('pages/v_result_laporan',$data);
    }

    function reppenjualan(){
        $tgl_awal=$this->uri->segment(3); 
        $tgl_akhir= $this->uri->segment(4); 
        $tgl_awal1= date("Y-m-d",strtotime($tgl_awal));
        $tgl_akhir1= date("Y-m-d",strtotime($tgl_akhir));
        $sql=$this->model_app->getLapPenjualan($tgl_awal1,$tgl_akhir1); 
        $html='<table align="center" style="width: 100%;  
         font-size: 7pt;padding:0px;margin:1px;border: solid 1px #000000;border-collapse: collapse"">
              <tr>
              <td style="border: solid 1px #000000;text-align:center; width:6%;">No</td>
              <td style="border: solid 1px #000000;text-align:center; width:18%;">Tanggal</td>
              <td style="border: solid 1px #000000;text-align:center; width:19%;">Kode Penjualan</td>
              <td style="border: solid 1px #000000;text-align:center; width:18%;">Nama Pelanggan</td>
              <td style="border: solid 1px #000000;text-align:center; width:18%;">Total Harga (Rp)</td>
              </tr>'; 
              $no=1; 
             foreach($sql as $row){
                $html.='<tr>
                <td style="border: solid 1px #000000;text-align:center; width:6%;">'.$no++.'</td>
                <td style="border: solid 1px #000000;text-align:center; width:18%;">'.date("d M Y",strtotime($row->tanggal_penjualan)).'</td>
                <td style="border: solid 1px #000000;text-align:center; width:19%;">'.$row->kd_penjualan.'</td>
                <td style="border: solid 1px #000000;text-align:center; width:18%;">'.$row->nm_pelanggan.'</td>
                <td style="border: solid 1px #000000;text-align:center; width:18%;">'.currency_format($row->total_harga).'</td>
            </tr>'; 

            $html.='<tr>
                <td colspan="4" style="border: solid 1px #000000;text-align: center; background: #49afcd"><strong>Total Seluruh Penjualan</strong></td>
                <td style="border: solid 1px #000000;">'.currency_format($row->total_all).'</td>
            </tr>'; 
             } 
              $html.='</table>'; 
        $param=array(
            'tgl1'=>$tgl_awal, 
            'tgl2'=>$tgl_akhir, 
            'html'=>$html
            ); 
        $this->load->view('report/rep_penjualan',$param); 
    }

    function rep_detail(){
        $id=$this->uri->segment(3); 
                $data=array(
            'title'=>'Detail Penjualan Barang',
            'active_penjualan'=>'active',
            'dt_penjualan'=>$this->model_app->getDataPenjualan($id),
            'barang_jual'=>$this->model_app->getBarangPenjualan($id),
        );
        $this->load->view('report/rep_detail',$data); 
    }
}
