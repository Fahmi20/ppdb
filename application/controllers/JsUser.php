<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JsUser extends CI_Controller {
	
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

    function save_hobi(){
    
        $arr = array(
            'hobi' => $this->input->post('hobi'),
            'alamatsurat' => $this->input->post('alamatsurat'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->m_user->update_calonsiswa($this->input->post('replid'), $arr);

    }


    function save_sekolah(){

        if($this->input->post('asalsekolah') == ''){
            $a = 'BELUM SEKOLAH';
        }else{
            $a = $this->input->post('asalsekolah');
        }
        $arr = array(
            'ketsekolah' => $a,
            'noijasah' => $this->input->post('noijasah'),
            'tglijasah' => $this->input->post('tglijasah'),
            'darah' => $this->input->post('darah'),
            'berat' => $this->input->post('berat'),
            'tinggi' => $this->input->post('tinggi'),
            'kesehatan' => $this->input->post('kesehatan')
        );

        $this->m_user->update_calonsiswa($this->input->post('replid'), $arr);

    }

    function save_data_wali(){
        $replid = $this->input->post('replid');
        $data = $this->input->post('data');
        $obj = new stdClass();

        $array = json_decode($data, true);

        $tgl_lahir_ayah = $array['6']['value'].'-'.$array['5']['value'].'-'.$array['4']['value'];
        $tgl_lahir_ibu = $array['17']['value'].'-'.$array['16']['value'].'-'.$array['15']['value'];
        
        unset($array['4']);
        unset($array['5']);
        unset($array['6']);
        unset($array['15']);
        unset($array['16']);
        unset($array['17']);

        foreach($array as $var){
            $obj->{$var['name']}=$var['value']; 
        }
        
        $this->m_user->update_calonsiswa_v3($replid, $obj, $tgl_lahir_ayah, $tgl_lahir_ibu);

    }

    function save_data_pribadi(){
        $replid = $this->input->post('replid');
        $data = $this->input->post('data');

        // $replid = 497;

        // $data = '[{"name":"nisn","value":"TKhao a ta"},{"name":"nik","value":"K"},{"name":"noun","value":"PhhD iraaao"},{"name":"nama","value":"Aath og k imhel"},{"name":"panggilan","value":"Nnkont"},{"name":"tmplahir","value":"Bi na"},{"name":"tgl_lahir","value":"01"},{"name":"bln_lahir","value":"12"},{"name":"thn_lahir","value":"1990"},{"name":"status","value":"Eksklusif"},{"name":"agama","value":"Budha"},{"name":"suku","value":"BUGIS"},{"name":"warga","value":"WNA"},{"name":"anakke","value":"0"},{"name":"jsaudara","value":"0"},{"name":"statusanak","value":"Kandung"},{"name":"jkandung","value":"0"},{"name":"jtiri","value":"0"},{"name":"bahasa","value":"Ph"},{"name":"alamatsiswa","value":"Aie  te"},{"name":"kodepossiswa","value":"83"},{"name":"jarak","value":"0"},{"name":"emailsiswa","value":"zee.fandy@gmail.com"},{"name":"telponsiswa","value":"212"},{"name":"hpsiswa","value":"350"}]';

        $obj = new stdClass();

        $array = json_decode($data, true);

        $tgl_lahir = $array['8']['value'].'-'.$array['7']['value'].'-'.$array['6']['value'];
        
        unset($array['6']);
        unset($array['7']);
        unset($array['8']);

        foreach($array as $var){
            $obj->{$var['name']}=$var['value']; 
        }
             
        $this->m_user->update_calonsiswa_v2($replid, $obj, $tgl_lahir);

    }

    function save_penerimaan(){
        
        $arr = array(
            'idproses' => $this->input->post('penerimaan'),
            'idkelompok' =>$this->input->post('kelompok'),
            'tahunmasuk' => date('Y')
        );

        // $last = $this->m_user->
        // $kodeawal = $this->m_user->get_kodeawal($this->input->post('penerimaan'));


        $this->m_user->update_calonsiswa($this->input->post('replid'), $arr);
    }

    function select_penerimaan(){
        $departement = $this->input->post('departement');
        $penerimaan = $this->m_user->get_penerimaan($departement);
        
        $vp = $this->m_user->get_v_penerimaan($this->input->post('replid'));

        echo '<select class="select22" id="penerimaan" name="penerimaan" data-minimum-results-for-search="Infinity" onchange="select_kelompok(this.value);">';
        foreach ($penerimaan as $pd) {
            if($vp == $pd->replid){
                echo '<option selected value="'.$pd->replid.'">'.$pd->proses.'</option>';
            }else{
                echo '<option value="'.$pd->replid.'">'.$pd->proses.'</option>';
            }
        }
        echo '</select>';
        echo '<script>$(".select22").select2({
            minimumResultsForSearch: Infinity
        });</script>';
    }

    function select_kelompok(){
        $penerimaan = $this->input->post('penerimaan');
        $kelompok = $this->m_user->get_kelompok($penerimaan);

        $vk = $this->m_user->get_v_kelompok($this->input->post('replid'));

        echo '<select class="select222" id="kelompok" name="kelompok">';
        foreach ($kelompok as $kd) {
            if($vk == $kd->replid){
                echo '<option selected value="'.$kd->replid.'">'.$kd->kelompok.', Kapasitas '.$kd->kapasitas.', Terisi </option>';
            }else{                
                echo '<option value="'.$kd->replid.'">'.$kd->kelompok.', Kapasitas '.$kd->kapasitas.', Terisi </option>';
            }
        }
        echo '</select>';
        echo '<script>$(".select222").select2({
            minimumResultsForSearch: Infinity
        });</script>';
    }

}