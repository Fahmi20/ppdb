<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	   function __construct()
    {
        parent::__construct();
	    
		$this->load->model('m_user');
        $this->load->library('Toast');
        date_default_timezone_set('Asia/Jakarta');
        if($this->session->userdata('validated') != true){
            redirect('login');  
        }
        
    }

    function form_pdf(){
        
        $id = $this->uri->segment('3');
		$is_admin = $this->session->userdata('jenis_user') == '1';
        $data['siswa'] = $this->m_user->get_calon_siswa_by_id_join($id);
        if ($is_admin || !empty($data['siswa'])) {
            $this->load->view('user/v_form_pdf', $data);            
        }else{
            show_404();
        }
    }

    function verify_form(){
        $id = $this->uri->segment('3');
        $this->m_user->verify_form($id);
        
        redirect('user/form_data/'.$id);
    }

    function index(){

    	$this->load->view('user/v_header');
    	$this->load->view('user/v_dashboard');
    	$this->load->view('user/v_footer');

    }


    function cek_payment(){

        $trx_id = $this->input->post('trx_id');
        $jml = $this->m_user->get_jml_form($trx_id);
      
		$url = 'https://cekbsi.arraafi.id/api/inquiry';

        $post = array(
            'trx_id' => $trx_id
        );

        $post_string = http_build_query($post);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); //timeout in seconds

        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($curl, CURLOPT_URL, $url);

        $result = curl_exec($curl);
        file_put_contents('bsi_cek.html', $result);
        $arr_result = json_decode($result, true);

        if(count($arr_result['payment']) != 0){
            $va = $arr_result['virtual_account'];
            $this->m_user->update_status_payment($trx_id, $va);
            for ($i=0; $i < $jml[0]->jml_formulir ; $i++) { 
                $last_calonsiswa = $this->m_user->get_last_calonsiswa();
                $nopend = str_pad($last_calonsiswa, 4, "0", STR_PAD_LEFT);
                $no_fix = $jml[0]->kodeawalan.$nopend;
                $arr = array(
                    'email' => $this->session->userdata('email'),
                    'nopendaftaran' => $no_fix
                );
                $this->m_user->insert_calonsiswa($arr);
            }
            echo 1;
        }else{
            echo 0;
        }
    }

    function form_data(){
        $id = $this->uri->segment('3');
        $data['siswa'] = $this->m_user->get_calon_siswa_by_id_join($id);
		$is_admin = $this->session->userdata('jenis_user') == '1';
        if ($is_admin || !empty($data['siswa'])) {
            if($data['siswa'][0]->form_submit != 1){
                redirect('user/data_formulir');
            }else{
                $data['departement'] = $this->m_user->get_departement();
                $data['agama'] = $this->m_user->get_agama();
                $data['suku'] = $this->m_user->get_suku();
                $data['pekerjaan'] = $this->m_user->get_pekerjaan();
    
                $this->load->view('user/v_header');
                $this->load->view('user/v_data_form', $data);
                $this->load->view('user/v_footer');
            }
            
        }else{
            show_404();
        }
    }

    function form_input() {
    $id = $this->uri->segment('3');
    $data['siswa'] = $this->m_user->get_calon_siswa_by_id($id);
    $is_admin = $this->session->userdata('jenis_user') == '1';

    if ($is_admin || !empty($data['siswa'])) {
        if (!empty($data['siswa']) && $data['siswa'][0]->form_submit == 1) {
            // Jika form sudah disubmit, redirect ke form_data
            redirect('user/form_data/'.$id);
        } else {
            // Jika admin atau form belum disubmit, tampilkan form input
            $data['departement'] = $this->m_user->get_departement();
            $data['agama'] = $this->m_user->get_agama();
            $data['suku'] = $this->m_user->get_suku();
            $data['pekerjaan'] = $this->m_user->get_pekerjaan();

            $this->load->view('user/v_header');
            $this->load->view('user/v_form_input', $data);
            $this->load->view('user/v_footer');
        }
    } else {
        show_404();
    }
}

    function profile(){
        $data['profile'] = $this->m_user->get_profile($this->session->userdata('email'));

        $this->load->view('user/v_header');
    	$this->load->view('user/v_profile', $data);
    	$this->load->view('user/v_footer');
    }

    function change_password(){

        $email = $this->session->userdata('email');
        $cek = $this->m_user->cek_password($email);

        if($cek == md5($this->input->post('old_password'))){
            if($this->input->post('new_password') == $this->input->post('confirm_new_password')){
                $this->m_user->update_password($email, md5($this->input->post('new_password')));
                echo "<script>
                alert('Password berhasil di ubah');
                window.location.href='".base_url()."user/password';  
                </script>";
            }else{
                echo "<script>
                alert('Konfirmasi password tidak cocok');
                window.location.href='".base_url()."user/password';  
                </script>";
            }
        }else{
            echo "<script>
            alert('Password lama tidak cocok');
            window.location.href='".base_url()."user/password';  
            </script>";
        }

    }

    function password(){
        $this->load->view('user/v_header');
    	$this->load->view('user/v_password');
    	$this->load->view('user/v_footer');
    }

    function form(){
    $this->load->model('M_user');
    $data['all_users'] = $this->M_user->get_all_users();
    $selected_email = $this->input->get('search_formulir');
    $data['selected_email'] = $selected_email;

    // Mendapatkan formulir sesuai dengan email yang dipilih
    if (!empty($selected_email)) {
        $data['formulirs'] = $this->M_user->get_id_formulir($selected_email);
    } else {
        // Jika tidak ada email yang dipilih, gunakan email dari session
        $session_email = $this->session->userdata('email');
        $data['formulirs'] = $this->M_user->get_id_formulir($session_email);
    }

    $this->load->view('user/v_header');
    $this->load->view('user/v_form', $data);
    $this->load->view('user/v_footer');
}


    function invoice(){

        $email = $this->session->userdata('email');
        $data['invoice'] = $this->m_user->get_invoice_by_email($email);

        $this->load->view('user/v_header');
    	$this->load->view('user/v_invoice', $data);
    	$this->load->view('user/v_footer');
    }

    function payment(){
        
        $uri = $this->uri->segment('3');
        $email = $this->session->userdata('email');
        $data['invoice'] = $this->m_user->get_invoice($uri, $email);

        if(!empty($data['invoice'])){
            $this->load->view('user/v_header');
            $this->load->view('user/v_payment', $data);
            $this->load->view('user/v_footer');
        }else{
            show_404();
        }
    }




    function buy_form(){

        
        $startDate = time();
        $limit = date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
        
        $replid = $this->input->post('departemen');
        $departemen = $this->m_user->get_price_departemen($replid);

        foreach ($departemen as $dd) {
            $awalan = $dd->kodeawalan;
            $price = $dd->form_price;
        }
  

        $jml = $price*$this->input->post('jml_form');
        
        $profil = $this->m_user->get_profile($this->session->userdata('email'));
        $id_form = $this->m_user->get_form_last_id();
	
        foreach ($profil as $pd) {
            $post = array(
                'trx_nim' => substr($pd->phone,8),
                'trx_id' => $id_form,
                'billing_type' => 'c',
                'trx_amount' => $jml,
                'customer_name' => $pd->nama_user,
                'customer_email' => $this->session->userdata('email'),
                'customer_phone' => $pd->phone,
                'min' => $jml,
                'max' => $jml,
                'description' => "Pembelian Formulir ".$pd->nama_user,
                'datetime_expired' => $limit
            );
        }
	
  
        $url = 'https://cekbsi.arraafi.id/api/register';
        $post_string = http_build_query($post);

		//echo substr($pd->phone,8) . '-'.$id_form.'-c-'.$jml.'-'.$pd->nama_user.'-'.$this->session->userdata('email').'-'.$pd->phone.'-'.$pd->nama_user.'-'.$limit;
		//exit;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); //timeout in seconds

        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($curl, CURLOPT_URL, $url);

        $result = curl_exec($curl);

        $arr_result = json_decode($result, true);
        //file_put_contents('bsix.html', $result);

      		
        if(isset($arr_result['virtual_account'])){
            
            $arr = array(
                'jml_formulir' => $this->input->post('jml_form'),
                'email' => $this->session->userdata('email'),
                'datetime_expired' => $limit,
                'virtual_account' => $arr_result['virtual_account'],
                'trx_amount' => $arr_result['trx_amount'],
                'kodeawalan' => $awalan,
                'trx_id' => $arr_result['trx_id'],
                'description' => $arr_result['description']
            );


        
            $last_id = $this->m_user->buy_formulir($arr);

 	
            $notif = $this->toast->alert("Virtual account berhasil di generate", "success");
			$this->session->set_flashdata('notif', $notif);

            redirect('user/payment/'.$last_id);
        
        }else{
            $notif = $this->toast->alert("Terjadi kesalahan, Mohon diulangi", "alert");
			$this->session->set_flashdata('notif', $notif);
            redirect('user/form');

        }

    }

    function data(){
        $this->load->view('user/v_header');
    	$this->load->view('user/v_data');
    	$this->load->view('user/v_footer');
    }

}