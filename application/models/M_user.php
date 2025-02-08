<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    

    function get_price_departemen($replid){
        $query = $this->db->query("SELECT kodeawalan, form_price from prosespenerimaansiswa where replid = '$replid'");
        return $query->result();
    }

    function get_name_departemen(){
        $query = $this->db->query("SELECT replid, departemen from prosespenerimaansiswa where aktif = 1");
        return $query->result();
    }

    function verify_form($id){
        $email = $this->session->userdata('email');
        $pin = rand(10000,99999);
        $this->db->query("UPDATE calonsiswa set form_submit = 1, info2 = '$pin', pinsiswa = '$pin' where replid = '$id' and email = '$email'");
    }

    function get_pekerjaan(){
        $query = $this->db->get('jbsumum.jenispekerjaan');
        return $query->result();
    }

    function get_suku(){
        $query = $this->db->get('jbsumum.suku');
        return $query->result();
    }

    function get_agama(){
        $query = $this->db->get('jbsumum.agama');
        return $query->result();
    }

    function get_v_kelompok($id){
		
		$query = $this->db->query("SELECT idkelompok from calonsiswa where replid = '$id'");
		
		return $query->result()[0]->idkelompok;
		
    }

    function get_v_penerimaan($id){
        $query = $this->db->query("SELECT idproses from calonsiswa where replid = '$id'");
        return $query->result()[0]->idproses;
    }

    function get_departemen_by_idproses($id){
        $query = $this->db->query("SELECT departemen from prosespenerimaansiswa where replid = '$id'");
        return $query->result()[0]->departemen;
    }

    function get_calon_siswa_by_id_join($id){
    $jenis_user = $this->session->userdata('jenis_user');
    $email = $this->session->userdata('email');

    // Mulai query dengan SELECT dan JOIN yang diperlukan
    $this->db->select('c.*, k.kelompok, p.departemen, k.kapasitas, p.proses');
    $this->db->from('calonsiswa c');
    $this->db->join('prosespenerimaansiswa p', 'p.replid = c.idproses');
    $this->db->join('kelompokcalonsiswa k', 'k.replid = c.idkelompok');

    // Tambahkan kondisi WHERE berdasarkan jenis_user
    if ($jenis_user != 0) {
        $this->db->where('c.email', $email);
    }

    // Tambahkan kondisi WHERE untuk ID calon siswa
    $this->db->where('c.replid', $id);

    // Eksekusi query
    $query = $this->db->get();
    return $query->result();
}

	
	public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }
	
	function get_all_formulirs() {
        $query = $this->db->get('calonsiswa');
        return $query->result();
    }

    function get_calon_siswa_by_id($id) {
    $jenis_user = $this->session->userdata('jenis_user');
    if ($jenis_user != 0) {
        $email = $this->session->userdata('email');
        $this->db->where('email', $email);
    }
    
    $this->db->where('replid', $id);
    $query = $this->db->get('calonsiswa');

    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array(); // Mengembalikan array kosong jika tidak ada hasil
    }
}


    function update_calonsiswa_v3($replid, $arr, $tgllahirayah, $tgllahiribu){
        $email = $this->session->userdata('email');
        $this->db->where('replid', $replid);
        $this->db->where('email', $email);
        $this->db->set('tgllahirayah', $tgllahirayah);
        $this->db->set('tgllahiribu', $tgllahiribu);
        $this->db->update('calonsiswa', $arr);        
    }

    function update_calonsiswa_v2($replid, $arr, $tgllahir){
        $email = $this->session->userdata('email');
        $this->db->where('replid', $replid);
        $this->db->where('email', $email);
        // $this->db->set('tgllahir', $tgllahir);
        $this->db->update('calonsiswa', $arr);        
    }

    function update_calonsiswa($replid, $arr){
        $email = $this->session->userdata('email');
        $this->db->where('replid', $replid);
        $this->db->where('email', $email);
        $this->db->update('calonsiswa', $arr);
    }

    function get_kelompok($penerimaan){
        $query = $this->db->query("SELECT replid, kelompok, kapasitas from kelompokcalonsiswa where idproses = '$penerimaan'");
        return $query->result();
    }

    function get_penerimaan($departement){
        $query = $this->db->query("SELECT replid, proses from prosespenerimaansiswa where departemen = '$departement' and aktif = 1");
        return $query->result();
    }

    function get_departement(){
        $query = $this->db->query("SELECT departemen from departemen order by urutan asc");
        return $query->result();
    }

    function get_id_formulir($email){
        $query = $this->db->query("SELECT replid, nama, nopendaftaran, form_submit from calonsiswa where email = '$email'");
        return $query->result();
    }

    function get_last_calonsiswa(){
        $query = $this->db->query("SELECT count(*) as jml from calonsiswa");
        if(!empty($query->result()[0]->jml)){
            $j = $query->result()[0]->jml;
            return $j+1;
        }else{
            return 1;
        }
    }

    function insert_calonsiswa($arr){
        $this->db->insert('calonsiswa', $arr);
    }

    function get_jml_form($trx_id){
        $query = $this->db->query("SELECT jml_formulir, kodeawalan from formulir where trx_id = '$trx_id' and status_formulir = 0");
        return $query->result();
    }

    function update_status_payment($trx_id, $va){
        $this->db->query("UPDATE formulir set status_formulir = 1 where trx_id = '$trx_id' and virtual_account = '$va'");
    }

    function insert_user($arr){
        $this->db->insert('users', $arr);
    }

    function cek_otp($id, $otp){
        $query = $this->db->query("SELECT COUNT(*)  as jml from users_temp where idmd5 = '$id' and otp = '$otp'");
        return $query->result()[0]->jml;
    }

    function get_user_temp_by_md5($md5){
        $this->db->where('idmd5', $md5);
        $query = $this->db->get('users_temp');
        return $query->result();
    }

    function get_form_last_id(){
        $query = $this->db->query("SELECT trx_id from formulir order by trx_id desc limit 1");
        if($query->result()[0]->trx_id){
            $jml = $query->result()[0]->trx_id;
            return $jml+1;
        }else{
            return date('y').'01';
        }
        
    }

    function get_last_temp(){
        $query = $this->db->query("SELECT COUNT(*) as jml from users_temp");
        if($query->result()){
            $jml = $query->result()[0]->jml;
            return $jml+1;
        }else{
            return 1;
        }
        

    }

    function add_temp_user($temp){
        $this->db->insert('users_temp', $temp);
        return $this->db->insert_id();
    }

    function cek_avail_user($email, $hp){
        $query = $this->db->query("SELECT count(*) as jml from users where email = '$email' or phone = '$hp'");
        return $query->result()[0]->jml;
    }

    function get_form_by_email($email){
        $this->db->where('email', $email);
    }

    function update_password($email, $password){
        $this->db->query("UPDATE users set password = '$password' where email = '$email'");
    }

    function cek_password($email){
        $query = $this->db->query("SELECT password from users where email = '$email'");
        return $query->result()[0]->password;
    }

    function get_invoice_by_email($email) {
    if ($this->session->userdata('jenis_user') != 0) {
        $this->db->where('email', $email);
    }
    $query = $this->db->get('formulir');
    return $query->result();
}


    function get_invoice($id, $email) {
    if ($this->session->userdata('jenis_user') != 0) {
        $this->db->where('id_formulir', $id);
    }
    
    $this->db->where('email', $email);        
    $this->db->where('status_formulir', '0');
    $query = $this->db->get('formulir');

    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array(); // Mengembalikan array kosong jika tidak ada hasil
    }
}


    function update_formulir($data, $json_api, $id){
        $this->db->where('id_formulir', $id);
        $this->db->update('formulir', $data);
    }

    function get_profile($email){
        $query = $this->db->query("SELECT * FROM users where email = '$email'");
        return $query->result();
    }

    function buy_formulir($data){
        $query = $this->db->insert('formulir', $data);
        return $this->db->insert_id();
    }

    function get_name($email){
        $query = $this->db->query("SELECT nama_user from users where email = '$email'");
        return $query->result()[0]->nama_user;
    }

    function update_last_login($username){
        $now = date('Y-m-d H:i:s');
        $this->db->query("UPDATE users set last_login = '$now' where email = '$username'");
    }

}