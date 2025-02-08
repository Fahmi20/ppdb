<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi Sekolah Islam AR-RAAFI</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/logo/ypgs2.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="<?php echo base_url();?>assets/css/app.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-4 d-none d-lg-flex bg" style="background-image:url('assets/images/others/login-1.jpg')">
                    <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <img src="assets/images/logo/logo-white.png" alt="">
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Exploring Enlink</h1>
                            <p class="text-white font-size-16 lh-2 w-80 opacity-08">Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">© 2019 ThemeNate</span>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Legal</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Privacy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto">
                            <img class="mt-4 mb-4" src="<?php echo base_url();?>assets/images/logo/ypgs.png" width="230px" alt="Logo">
                                <h2>Layanan Pendaftaran mandiri Siswa Baru<br>SEKOLAH ISLAM AR-RAAFI</h2>
                                <p class="m-b-30">Silakan masukan email dan password anda.</p>
                                
                                <?php
                                    $length = 18;
                                    $randomString = substr(str_shuffle("01234567891234567890"), 0, $length);
                                    echo form_open('login/process?rdm='.$randomString)?>
                                    <?php 
                                        if(! is_null($msg)) {
                                            echo $msg;
                                            echo '<script type="text/javascript">
                                                setInterval(function(){
                                                    window.location.href = "../login";
                                                },1500);
                                                </script>';
                                        }
                                    ?>  
                              <div class="card">
                        <div class="card-body">       
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Email:</label>
                                        <div class="input-affix">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="email" class="form-control" name="email"  id="userName" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <a class="float-right font-size-13 text-muted" href="<?php echo base_url();?>login/lupapassword">Lupa Password?</a>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <input type="password" name="password"  class="form-control" id="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
								<div class="d-flex justify-content-between align-items-center">
					<div class="m-b-30">
						<p class="mb-0">Belum punya akun? Klik Daftar Akun</p>
					</div>
					<div class="d-flex">
						<a class="btn btn-success mr-3" href="<?php echo base_url();?>register">
                <i class="anticon anticon-user"></i> Daftar Akun
            </a>
            <p class="m-b-0">Sudah punya akun? Klik Masuk</p>
            <button type="submit" class="btn btn-primary ml-3">
                Masuk <i class="anticon anticon-arrow-right"></i>
            </button>
        </div>
    </div>
								</div>

                        <?php echo form_close();?>
                            </div>
                        </div>     </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->session->flashdata('notif') ;?>
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>