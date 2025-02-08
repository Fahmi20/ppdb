<link rel="stylesheet" href="<?php echo base_url();?>assets/css/form.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">


<div class="page-container">
    <div class="main-content">
        <div class="text-center mt-2 mb-4" style="color:#007bff;font-size:20px"><b>Formulir Pendaftaran</b></div>

    <!-- MultiStep Form -->
        <div class="multisteps-form">
            <!--progress bar-->
            <div class="row">
                <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                <div class="multisteps-form__progress">
                    <button class="multisteps-form__progress-btn js-active" type="button" disabled title="Penerimaan">Penerimaan</button>
                    <button class="multisteps-form__progress-btn" type="button" disabled title="Data Pribadi">Data Pribadi</button>
                    <button class="multisteps-form__progress-btn" type="button" disabled title="Sekolah dan Kesehatan">Sekolah & Kesehatan</button>
                    <button class="multisteps-form__progress-btn" type="button" disabled title="Orang Tua">Orang Tua</button>
                    <button class="multisteps-form__progress-btn" type="button" disabled title="Informasi Tambahan">Selesai</button>
                </div>
                </div>
            </div>
  <!--form panels-->
  <?php
    foreach ($siswa as $sd):
        if($sd->idproses != 0){
            $dep = $this->m_user->get_departemen_by_idproses($sd->idproses);
        }
  ?>

<div class="row">
    <div class="col-12 col-lg-12 m-auto">
        <div class="multisteps-form__form">
            <!--single form panel-->
            <div class="multisteps-form__panel p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h4 class="multisteps-form__title">Data Penerimaan Calon Siswa</h3>
                <div class="multisteps-form__content">                
                    <div class="card">
                        <div class="card-body" style="background-color:#f0f7ff">
                                <div class="row mb-2">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="oldPassword">Departemen:</label>
                                        <select class="select_departemen" id="departemen" name="departemen" onchange="select_penerimaan(this.value);">
                                            <?php foreach ($departement as $dd) {
                                                if($dd->departemen == $dep){
                                                    echo '<option value="'.$dd->departemen.'" selected>'.$dd->departemen.'</option>';
                                                }else{
                                                    echo '<option value="'.$dd->departemen.'">'.$dd->departemen.'</option>';
                                                }
                                            }?>                                    
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold" for="newPassword">Penerimaan:</label>
                                        <span id="span_penerimaan"></span>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="font-weight-semibold" for="confirmPassword">Kelompok:</label>
                                        <span id="span_kelompok"></span>
                                    </div>                           
                                </div>                    
                        </div>
                    </div>
                
                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-primary ml-auto js-btn-next" id="btn_penerimaan" type="button" onclick="save_penerimaan();" title="Next">Selanjutnya <i class="anticon anticon-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <!--single form panel-->
            <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
                <h4 class="multisteps-form__title">Data Pribadi Calon Siswa</h3>
                <div class="multisteps-form__content">
                    <form id="data_pribadi">
                        <div class="card">
                            <div class="card-body"  style="background-color:#f0f7ff">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">NISN (jika ada):</label>
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $sd->nisn;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">NIK Ananda (terdapat di Kartu Keluarga):</label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $sd->nik;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">No UN Sebelumnya (jika ada):</label>
                                        <input type="text" class="form-control" id="noun" name="noun" value="<?php echo $sd->noun;?>">
                                    </div>                           
                                </div>

                                <div class="row mb-2">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $sd->nama;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Panggilan:</label>
                                        <input type="text" class="form-control" id="panggilan" name="panggilan" value="<?php echo $sd->panggilan;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Jenis Kelamin:</label>
                                        <select class="select2" id="kelamin">
                                            <option value="l">Laki-laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                    </div>                           
                                </div>

                                <div class="row mb-2">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Tempat lahir:</label>
                                        <input type="text" class="form-control" id="tmplahir"  name="tmplahir" value="<?php echo $sd->tmplahir;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Tanggal lahir:</label>
                                        <div class="row">
                                            <div class="col-3">
                                                <select class="select2" id="tgl_lahir" name="tgl_lahir">
                                                    <?php
                                                    $ex = explode("-", $sd->tgllahir);
                                                        for ($i=1; $i <=31 ; $i++) { 
                                                            $in = sprintf("%02d", $i);
                                                            if($ex[2] == $in){
                                                                echo '<option selected value="'.$in.'">'.$in.'</option>';
                                                            }else{
                                                                echo '<option value="'.$in.'">'.$in.'</option>';
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-5">
                                                <select class="select2" id="bln_lahir" name="bln_lahir">
                                                    <?php
                                                        $bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                                        for ($i=1; $i <=12 ; $i++) { 
                                                            $in = sprintf("%02d", $i);
                                                            if($ex[1] == $in){
                                                                echo '<option value="'.$in.'">'.$bulan[$i].'</option>';
                                                            }else{
                                                                echo '<option selected value="'.$in.'">'.$bulan[$i].'</option>';
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </select>
                                            </div>

                                            <div class="col-4">
                                                <select class="select2" id="thn_lahir" name="thn_lahir">
                                                
                                                    <?php
                                                        for ($i=1990; $i <=2022 ; $i++) {
                                                            if($ex[0] == $i){
                                                                echo '<option selected>'.$i.'</option>';
                                                            }else{
                                                                echo '<option>'.$i.'</option>';
                                                            }
                                                        }
                                                    ?>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Status:</label>
                                        <select class="select2" id="status" name="status">
                                            <?php
                                                if($sd->status == 'Reguler'){
                                                    echo '<option value="Reguler" selected>Reguler</option>
                                                        <option value="Eksklusif">Eksklusif</option>';
                                                }else{
                                                    echo '<option value="Reguler">Reguler</option>
                                                    <option value="Eksklusif" selected>Eksklusif</option>';
                                                }
                                            ?>                                    
                                        </select>
                                    </div>                           
                                </div>

                                <div class="row mb-2">

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Agama:</label>
                                        <select class="select2" id="agama" name="agama">
                                            <?php
                                                foreach ($agama as $ad) {
                                                    if($sd->agama == $ad->agama){
                                                        echo '<option selected value="'.$ad->agama.'">'.$ad->agama.'</option>';
                                                    }else{
                                                        echo '<option value="'.$ad->agama.'">'.$ad->agama.'</option>';
                                                    }
                                                }
                                            ?>
                                                                                
                                        </select>
                                    </div>  

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Suku:</label>                                
                                        <select class="select2" id="suku" name="suku">
                                        <?php
                                                foreach ($suku as $sad) {
                                                    if($sd->suku == $sad->suku){
                                                        echo '<option selected value="'.$sad->suku.'">'.$sad->suku.'</option>';
                                                    }else{
                                                        echo '<option value="'.$sad->suku.'">'.$sad->suku.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Kewarganegaraan:</label>
                                        <select class="select2" id="warga" name="warga">
                                        <?php
                                                if($sd->warga == 'WNI'){
                                                    echo '<option value="WNI" selected>WNI</option>
                                                    <option value="WNA">WNA</option>';
                                                }else{
                                                    echo '<option value="WNI">WNI</option>
                                                    <option value="WNA" selected>WNA</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="row mb-2">

                                    <div class="form-group col-md-2">
                                        <label class="font-weight-semibold">Anak ke:</label>
                                        <input type="number" class="form-control" id="anakke" name="anakke" value="<?php echo $sd->anakke;?>">
                                    </div>  

                                    <div class="form-group col-md-2">
                                        <label class="font-weight-semibold">Jumlah saudara:</label>                                
                                        <input type="number" class="form-control" id="jsaudara" name="jsaudara" value="<?php echo $sd->jsaudara;?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Status Anak:</label>                                
                                        <select class="select2" id="statusanak" name="statusanak">
                                            <?php $sanak = array('Kandung', 'Angkat', 'Tiri', 'Lainnya');
                                                for ($i=0; $i < count($sanak) ; $i++) { 
                                                    if($sd->statusanak == $sanak[$i]){
                                                        echo '<option selected value="'.$sanak[$i].'">'.$sanak[$i].'</option>';
                                                    }else{
                                                        echo '<option value="'.$sanak[$i].'">'.$sanak[$i].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label class="font-weight-semibold">Saudara kandung:</label>                                
                                        <input type="number" class="form-control" id="jkandung" name="jkandung" value="<?php echo $sd->jkandung;?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label class="font-weight-semibold">Saudara tiri:</label>                                
                                        <input type="number" class="form-control" id="jtiri" name="jtiri" value="<?php echo $sd->jtiri;?>">
                                    </div>
                                    
                                </div>

                                <div class="row mb-2">

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold" for="confirmPassword">Bahasa:</label>
                                        <input type="text" class="form-control" id="bahasa" name="bahasa" value="<?php echo $sd->bahasa;?>">
                                    </div>  

                                    <div class="form-group col-md-8">
                                        <label class="font-weight-semibold">Alamat:</label>                                
                                        <input type="text" class="form-control" id="alamatsiswa" name="alamatsiswa" value="<?php echo $sd->alamatsiswa;?>">
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Kode Pos:</label>                                
                                        <input type="number" class="form-control" id="kodepossiswa" name="kodepossiswa" value="<?php echo $sd->kodepossiswa;?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Estimasi Jarak Rumah-Sekolah (KM):</label>                                
                                        <input type="number" class="form-control" id="jarak" name="jarak" value="<?php echo $sd->jarak;?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Email :</label>                                
                                        <input type="email" class="form-control" value="<?php echo $this->session->userdata('email');?>" id="emailsiswa" name="emailsiswa">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Telepon:</label>                                
                                        <input type="number" class="form-control" id="telponsiswa" name="telponsiswa" value="<?php echo $sd->telponsiswa;?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-semibold">Handphone:</label>                                
                                        <input type="number" class="form-control" id="hpsiswa" name="hpsiswa" value="<?php echo $sd->hpsiswa;?>">
                                    </div>

                                    
                                    
                                </div>

                            </div>
                        </div>
                    </form>
                
                    <!-- js-btn-next -->
                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-warning js-btn-prev" type="button" title="Prev"><i class="anticon anticon-arrow-left"></i> Sebelumnya</button>
                        <button class="btn btn-primary ml-auto js-btn-next" onclick="save_data_pribadi();" type="button" title="Next">Selanjutnya <i class="anticon anticon-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <!--single form panel-->
            <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
                <h4 class="multisteps-form__title">Data Sekolah & Riwayat Kesehatan Calon Siswa</h4>
                <div class="multisteps-form__content">
                    <div class="card">
                        <div class="card-body"  style="background-color:#f0f7ff">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Asal Sekolah (jika ada):</label>
                                    <input type="text" class="form-control" id="asalsekolah" name="asalsekolah" value="<?php echo $sd->asalsekolah;?>">
                                    <div class="mt-2">
                                        <input id="checkbox1" type="checkbox">
                                        <label for="checkbox1">belum sekolah</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">No Ijazah (jika ada):</label>
                                    <input type="text" class="form-control" id="noijasah" name="noijasah" value="<?php echo $sd->noijasah;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Tanggal Ijazah (jika ada):</label>
                                    <input type="text" class="form-control" id="tglijasah" name="tglijasah" value="<?php echo $sd->tglijasah;?>">
                                </div>                           
                            </div>

                            <div class="row">                                
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">Keterangan Sekolah Sebelumnya (jika ada):</label>
                                    <textarea class="form-control" id="ketsekolah" name="ketsekolah" rows="2"><?php echo $sd->ketsekolah;?></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Golongan Darah:</label>
                                    <select class="select2" id="darah" name="darah">
                                        <?php $gd = array('A', 'AB', 'B', 'O', 'Belum ada');
                                            for ($i=0; $i < count($gd) ; $i++) { 
                                                if($sd->darah == $gd[$i]){
                                                    echo '<option selected value="'.$gd[$i].'">'.$gd[$i].'</option>';
                                                }else{
                                                    echo '<option value="'.$gd[$i].'">'.$gd[$i].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Berat (Kg):</label>
                                    <input type="number" class="form-control" id="berat" name="berat" value="<?php echo $sd->berat;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Tinggi (Cm):</label>
                                    <input type="number" class="form-control" id="tinggi" name="tinggi" value="<?php echo $sd->tinggi;?>">
                                </div>                           
                            </div>

                            <div class="row">
                            
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">Riwayat Penyakit:</label>
                                    <textarea class="form-control" id="kesehatan" name="kesehatan" rows="2"><?php echo $sd->kesehatan;?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-warning js-btn-prev" type="button" title="Prev"><i class="anticon anticon-arrow-left"></i> Sebelumnya</button>
                        <button class="btn btn-primary ml-auto js-btn-next" onclick="save_sekolah();" type="button" title="Next">Selanjutnya <i class="anticon anticon-arrow-right"></i></button>
                    </div>
                </div>
            </div>

        

            <!--single form panel-->
            <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
                <h4 class="multisteps-form__title">Data Orang Tua Wali</h4>
                <div class="multisteps-form__content">
                    <form id="data_wali">
                    <div class="card">
                        <div class="card-body"  style="background-color:#f0f7ff">
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Data Ayah</h4>
                                            </div>
                                                <div class="card-body border rounded"  style="background-color:#fff">
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Nama:</label>
                                                        <input type="text" class="form-control" id="namaayah" name="namaayah"  value="<?php echo $sd->namaayah;?>">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Almarhum:</label>
                                                        <select class="select2" id="almayah" name="almayah">
                                                            <option value="0">Tidak</option>
                                                            <option value="1">Ya</option>
                                                        </select>                                                
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Status Orang Tua:</label>
                                                        <select class="select2" id="statusayah" name="statusayah">
                                                            <?php $sortu = array('Kandung', 'Angkat', 'Tiri', 'Lainnya');
                                                                for ($i=0; $i < count($sortu) ; $i++) { 
                                                                    if($sd->statusayah == $sortu[$i]){
                                                                        echo '<option selected value="'.$sortu[$i].'">'.$sortu[$i].'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$sortu[$i].'">'.$sortu[$i].'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Tempat Lahir:</label>
                                                        <input type="text" class="form-control" id="tmplahirayah" name="tmplahirayah"  value="<?php echo $sd->tmplahirayah;?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Tanggal lahir:</label>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <select class="select2" id="tgl_lahir_ayah" name="tgl_lahir_ayah">
                                                                    <?php
                                                                    $exayah = explode("-", $sd->tgllahirayah);
                                                                        for ($i=1; $i <=31 ; $i++) { 
                                                                            $in = sprintf("%02d", $i);
                                                                            if($exayah[2] == $in){
                                                                                echo '<option selected value="'.$in.'">'.$in.'</option>';
                                                                            }else{
                                                                                echo '<option value="'.$in.'">'.$in.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-5">
                                                                <select class="select2" id="bln_lahir_ayah" name="bln_lahir_ayah">
                                                                    <?php
                                                                        $bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                                                        for ($i=1; $i <=12 ; $i++) { 
                                                                            $in = sprintf("%02d", $i);
                                                                            if($exayah[1] == $in){
                                                                                echo '<option value="'.$in.'">'.$bulan[$i].'</option>';
                                                                            }else{
                                                                                echo '<option selected value="'.$in.'">'.$bulan[$i].'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                    
                                                                </select>
                                                            </div>

                                                            <div class="col-4">
                                                                <select class="select2" id="thn_lahir_ayah" name="thn_lahir_ayah">
                                                                
                                                                    <?php
                                                                        for ($i=1960; $i <=2000 ; $i++) {
                                                                            if($exayah[0] == $i){
                                                                                echo '<option selected>'.$i.'</option>';
                                                                            }else{
                                                                                echo '<option>'.$i.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Pendidikan:</label>
                                                        <select class="select2" id="pendidikanayah" name="pendidikanayah">
                                                            <?php $pdayah = array('D1', 'D3', 'S1', 'S2', 'S3', 'SD', 'SMP', 'SMA');
                                                                for ($i=0; $i < count($pdayah) ; $i++) { 
                                                                    if($sd->pendidikanayah == $pdayah[$i]){
                                                                        echo '<option selected value="'.$pdayah[$i].'">'.$pdayah[$i].'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$pdayah[$i].'">'.$pdayah[$i].'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Pekerjaan:</label>                                
                                                        <select class="select2" id="pekerjaanayah" name="pekerjaanayah">
                                                        <?php
                                                                foreach ($pekerjaan as $pad) {
                                                                    if($sd->pekerjaanayah == $pad->pekerjaan){
                                                                        echo '<option selected value="'.$pad->pekerjaan.'">'.$pad->pekerjaan.'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$pad->pekerjaan.'">'.$pad->pekerjaan.'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Penghasilan:</label>
                                                        <input type="text" class="form-control" id="penghasilanayah" name="penghasilanayah"  value="<?php echo $sd->penghasilanayah;?>">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Email:</label>
                                                        <input type="email" class="form-control" id="emailayah" name="emailayah" value="<?php echo $sd->emailayah;?>">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                

                                    <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Data Ibu</h4>
                                                </div>
                                                <div class="card-body border rounded"  style="background-color:#fff">
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Nama:</label>
                                                        <input type="text" class="form-control" id="namaibu" name="namaibu" value="<?php echo $sd->namaibu;?>">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Almarhumah:</label>
                                                        <select class="select2" id="almibu" name="almibu">
                                                            <option value="0">Tidak</option>
                                                            <option value="1">Ya</option>
                                                        </select>                                                
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Status Orang Tua:</label>
                                                        <select class="select2" id="statusibu" name="statusibu">
                                                            <?php $sortu = array('Kandung', 'Angkat', 'Tiri', 'Lainnya');
                                                                for ($i=0; $i < count($sortu) ; $i++) { 
                                                                    if($sd->statusibu == $sortu[$i]){
                                                                        echo '<option selected value="'.$sortu[$i].'">'.$sortu[$i].'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$sortu[$i].'">'.$sortu[$i].'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Tempat Lahir:</label>
                                                        <input type="text" class="form-control" id="tmplahiribu" name="tmplahiribu">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Tanggal lahir:</label>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <select class="select2" id="tgl_lahir_ibu" name="tgl_lahir_ibu">
                                                                    <?php
                                                                    $exibu = explode("-", $sd->tgllahiribu);
                                                                        for ($i=1; $i <=31 ; $i++) { 
                                                                            $in = sprintf("%02d", $i);
                                                                            if($exibu[2] == $in){
                                                                                echo '<option selected value="'.$in.'">'.$in.'</option>';
                                                                            }else{
                                                                                echo '<option value="'.$in.'">'.$in.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-5">
                                                                <select class="select2" id="bln_lahir_ibu" name="bln_lahir_ibu">
                                                                    <?php
                                                                        $bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                                                        for ($i=1; $i <=12 ; $i++) { 
                                                                            $in = sprintf("%02d", $i);
                                                                            if($exibu[1] == $in){
                                                                                echo '<option value="'.$in.'">'.$bulan[$i].'</option>';
                                                                            }else{
                                                                                echo '<option selected value="'.$in.'">'.$bulan[$i].'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                    
                                                                </select>
                                                            </div>

                                                            <div class="col-4">
                                                                <select class="select2" id="thn_lahir_ibu" name="thn_lahir_ibu">
                                                                
                                                                    <?php
                                                                        for ($i=1960; $i <=2000 ; $i++) {
                                                                            if($exibu[0] == $i){
                                                                                echo '<option selected>'.$i.'</option>';
                                                                            }else{
                                                                                echo '<option>'.$i.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    
                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Pendidikan:</label>
                                                        <select class="select2" id="pendidikanibu" name="pendidikanibu">
                                                            <?php $pdibu = array('D1', 'D3', 'S1', 'S2', 'S3', 'SD', 'SMP', 'SMA');
                                                                for ($i=0; $i < count($pdibu) ; $i++) { 
                                                                    if($sd->pendidikanibu == $pdibu[$i]){
                                                                        echo '<option selected value="'.$pdibu[$i].'">'.$pdibu[$i].'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$pdibu[$i].'">'.$pdibu[$i].'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Pekerjaan:</label>                                
                                                        <select class="select2" id="pekerjaanibu" name="pekerjaanibu">
                                                        <?php
                                                                foreach ($pekerjaan as $pad) {
                                                                    if($sd->pekerjaanibu == $pad->pekerjaan){
                                                                        echo '<option selected value="'.$pad->pekerjaan.'">'.$pad->pekerjaan.'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$pad->pekerjaan.'">'.$pad->pekerjaan.'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Penghasilan:</label>
                                                        <input type="text" class="form-control" id="penghasilanibu" name="penghasilanibu"  value="<?php echo $sd->penghasilanibu;?>">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="font-weight-semibold">Email:</label>
                                                        <input type="email" class="form-control" id="emailibu" name="emailibu" value="<?php echo $sd->emailibu;?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mt-4">
                                            <div class="card">
                                                <div class="card-header">
                                                        <h4 class="card-title">Data Wali Calon Siswa</h4>
                                                    </div>
                                                    <div class="card-body border rounded"  style="background-color:#fff">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold">Nama Wali:</label>
                                                    <input type="text" class="form-control" id="wali" name="wali" value="<?php echo $sd->wali;?>">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold">Telepon:</label>
                                                    <input type="text" class="form-control" id="telponortu" name="telponortu" value="<?php echo $sd->telponortu;?>">
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold">Handphone:</label>
                                                    <input type="text" class="form-control" id="hportu" name="hportu" value="<?php echo $sd->hportu;?>">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold">Alamat Orang Tua:</label>
                                                    <textarea rows="3" class="form-control" id="alamatortu" name="alamatortu"><?php echo $sd->alamatortu;?></textarea>
                                                </div>                               
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                        
                                </div>
                     
                        </div>
                    </form>

                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-warning js-btn-prev" type="button" title="Prev"><i class="anticon anticon-arrow-left"></i> Sebelumnya</button>
                        <button class="btn btn-primary ml-auto js-btn-next" type="button" onclick="save_data_wali();" title="Send">Selanjutnya  <i class="anticon anticon-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
                <h4 class="multisteps-form__title">Informasi Tambahan</h4>
                <div class="multisteps-form__content">
                    <form id="lainnya">
                        <div class="card">
                            <div class="card-body"  style="background-color:#f0f7ff">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-semibold">Hobi:</label>
                                        <textarea rows="3" class="form-control" id="hobi" name="hobi"><?php echo $sd->hobi;?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-semibold">Keterangan Lainnya:</label>
                                        <textarea rows="3" class="form-control" id="keterangan" name="keterangan"><?php echo $sd->keterangan;?></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="font-weight-semibold">Alamat Surat:</label>
                                        <input type="text" class="form-control" id="alamatsurat" name="alamatsurat" value="<?php echo $sd->alamatsurat;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-warning js-btn-prev" type="button" title="Prev"><i class="anticon anticon-arrow-left"></i> Sebelumnya</button>
                        <button class="btn btn-primary ml-auto js-btn-next" onclick="save_hobi();" type="button" title="Next">Selanjutnya <i class="anticon anticon-arrow-right"></i></button>
                    </div>
                    
                </div>
      
            

            </div>
        </div>       </div>
        
        <?php endforeach;?>
    </div>    
</div>
</div>
      


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Submit Formulir</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                

                <div class="alert alert-success" >
                    <h4 class="alert-heading">Apakah data sudah benar?</h4>
                    <p class="m-b-0">Mohon periksa kembali data-data anda, jika sudah benar silakan klik Lanjutkan untuk melakukan pendaftaran.</p>
                    <hr class="m-v-20">
                    <p class="m-b-0">Setalah melakukan submit data tidak bisa diubah kembali, silakan hubungi kontak person jika akan melakukan perubahan data.</p>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Ingin periksa ulang</button>
                <a href="<?php echo base_url();?>user/verify_form/<?php echo $this->uri->segment('3');?>" class="btn btn-danger">Ya, Lanjutkan</a>
            </div>
        </div>
    </div>
</div>

<!-- Content Wrapper END -->

<script src="<?php echo base_url();?>assets/js/form.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>


<script>

    function save_data_wali(){   
        var data = JSON.stringify( $('#data_wali').serializeArray());
        var replid = "<?php echo $this->uri->segment('3');?>";
        
        $.ajax({
            url: "<?php echo base_url();?>JsUser/save_data_wali",
            type : 'post',
            data : {data:data, replid:replid},
            cache: false,
            success: function(msg){
                notif('61de00', 'Perubahan berhasil disimpan', 'fa fa-check-circle');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },
            beforeSend: function(msg){
                notif('FFC300', 'Menyimpan perubahan...', 'fa fa-spinner');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },
            error: function(msg){
                notif('de0000', 'Gagal disimpan', 'fa fa-circle-exclamation');

            }
        });
    }

    function save_data_pribadi(){

        if ($("#data_pribadi")[0].checkValidity()){
            
            var data = JSON.stringify( $('#data_pribadi').serializeArray());
                var replid = "<?php echo $this->uri->segment('3');?>";
                
                $.ajax({
                    url: "<?php echo base_url();?>JsUser/save_data_pribadi",
                    type : 'post',
                    data : {data:data, replid:replid},
                    cache: false,
                    success: function(msg){
                        notif('61de00', 'Perubahan berhasil disimpan', 'fa fa-check-circle');
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    },
                    beforeSend: function(msg){
                        notif('FFC300', 'Menyimpan perubahan...', 'fa fa-spinner');
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    },
                    error: function(msg){
                        notif('de0000', 'Gagal disimpan'+msg, 'fa fa-times-circle');
                    }
                });
                
        }else{
            notif('de0000', 'Data belum lengkap, silakan kembali ke halaman seblumnya', 'fa fa-times-circle');
            $("#data_pribadi")[0].reportValidity()
        }

       
    }

    function save_hobi(){
        var hobi = $('#hobi').val();
        var alamatsurat = document.getElementById("alamatsurat").value;
        var keterangan = $('#keterangan').val();
        var replid = "<?php echo $this->uri->segment('3');?>";

        $.ajax({
            url: "<?php echo base_url();?>JsUser/save_hobi",
            type : 'post',
            data : {hobi:hobi,alamatsurat:alamatsurat,keterangan:keterangan, replid:replid},
            cache: false,
            success: function(msg){
                $('#exampleModalCenter').modal('show');
            },
            beforeSend: function(){
                
            },
            error: function(msg){
                notif('de0000', 'Gagal disimpan', 'fa fa-times-circle');
            }
        });

    }

    function save_sekolah(){
        var asalsekolah = document.getElementById("asalsekolah").value;
        var noijasah = document.getElementById("noijasah").value;
        var tglijasah = document.getElementById("tglijasah").value;
        var ketsekolah = document.getElementById("ketsekolah").value;
        var darah = document.getElementById("darah").value;
        var berat = document.getElementById("berat").value;
        var tinggi = document.getElementById("tinggi").value;
        var kesehatan = document.getElementById("kesehatan").value;
        var replid = "<?php echo $this->uri->segment('3');?>";

        $.ajax({
            url: "<?php echo base_url();?>JsUser/save_sekolah",
            type : 'post',
            data : {replid:replid,asalsekolah:asalsekolah,noijasah:noijasah,tglijasah:tglijasah,ketsekolah:ketsekolah, darah:darah, berat:berat, tinggi:tinggi, kesehatan:kesehatan},
            cache: false,
            success: function(msg){
                notif('61de00', 'Perubahan berhasil disimpan', 'fa fa-check-circle');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },
            beforeSend: function(){
                notif('FFC300', 'Menyimpan perubahan...', 'fa fa-spinner');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },
            error: function(msg){
                notif('de0000', 'Gagal disimpan', 'fa fa-times-circle');
            }
        });

    }


    function save_penerimaan(){
        var departemen = document.getElementById("departemen").value;
        var penerimaan = document.getElementById("penerimaan").value;
        var kelompok = document.getElementById("kelompok").value;
        var replid = "<?php echo $this->uri->segment('3');?>";

        $.ajax({
            url: "<?php echo base_url();?>JsUser/save_penerimaan",
            type : 'post',
            data : {replid:replid,departemen:departemen,penerimaan:penerimaan,kelompok:kelompok},
            cache: false,
            success: function(msg){
                notif('61de00', 'Perubahan berhasil disimpan', 'fa fa-check-circle');
            },
            beforeSend: function(){
                notif('FFC300', 'Menyimpan perubahan...', 'fa fa-spinner');
            },
            error: function(msg){
                notif('de0000', 'Gagal disimpan', 'fa fa-times-circle');
            }
        });

    }


    window.onload = function(){
        document.getElementById("btn_penerimaan").disabled = true; 
        
        select_penerimaan(document.getElementById("departemen").value);
        select_kelompok(document.getElementById("penerimaan").value);
        
    };

    function select_penerimaan(v){

        var replid = "<?php echo $this->uri->segment('3');?>";

        $.ajax({
            url: "<?php echo base_url();?>JsUser/select_penerimaan",
            type : 'post',
            data : {departement:v, replid:replid},
            cache: false,
            success: function(msg){
                $('#span_penerimaan').html(msg);
                select_kelompok(document.getElementById("penerimaan").value);
               
            },
            beforeSend: function(msg){
                $('#span_penerimaan').html('<br>Loading...');
            },
            error: function(msg){
                $('#span_penerimaan').html('<br>Gagal memuat konten. mohon lakukan refresh');
            }
        });
    }

    function select_kelompok(v){
        var replid = "<?php echo $this->uri->segment('3');?>";

        $.ajax({
            url: "<?php echo base_url();?>JsUser/select_kelompok",
            type : 'post',
            data : {penerimaan:v, replid:replid},
            cache: false,
            success: function(msg){
                $('#span_kelompok').html(msg);
                document.getElementById("btn_penerimaan").disabled = false; 
            },
            beforeSend: function(msg){
                $('#span_kelompok').html('<br>Loading...');
            },
            error: function(msg){
                $('#span_kelompok').html('<br>Gagal memuat konten. mohon lakukan refresh');
            }
        });
    }

    function notif(color, msg, icon){

        const notyf = new Notyf({
            duration: 6000,
            position: {
                x: 'right',
                y: 'top',
            },
            types: [
                {
                    type: 'info',
                    background: '#'+color,
                    icon: {
                        className: icon,
                        tagName: 'span',
                        color: '#fff'
                    },
                    dismissible: false
                }
            ]
        });

        notyf.open({
            type: 'info',
            message: msg
        });

        }

</script>