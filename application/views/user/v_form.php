<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header no-gutters">
            <div class="d-md-flex align-items-md-center justify-content-between">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#beliFormulir">Beli Formulir baru &nbsp;&nbsp;<i class="anticon anticon-right"></i></a>
                        </div>

                        <?php
                            $c = $this->m_user->get_id_formulir($this->session->userdata('email'));
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                            Setelah melakukan pembelian & pembayaran, formulir akan muncul dibawah ini sesuai dengan jumlah formulir yang dibeli.<br>
                            Status pembayaran bisa dicek pada menu Invoice.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            Anda memiliki <?php echo count($c);?> formulir
                        </div>
                        <div class="row">
                            <?php if ($_SESSION['jenis'] == 1) : ?>
                                <div class="col-lg-12">
                                    <form method="get" action="<?php echo base_url(); ?>user/form">
                                        <div class="form-group">
                                            <label for="search_formulir">Pilih Email:</label>
                                            <select name="search_formulir" id="search_formulir" class="form-control select2" style="width: 100%;">
                                                <option value="" <?php echo empty($selected_email) ? 'selected' : ''; ?>>Pilih Email</option>
                                                <?php foreach ($all_users as $user): ?>
                                                    <option value="<?php echo $user->email; ?>" <?php echo ($selected_email == $user->email) ? 'selected' : ''; ?>>
                                                        <?php echo $user->email; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-bottom: 15px;">Cari</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php foreach ($formulirs as $formulir): ?>
                                <div class="file-wrapper" style="display: inline-block; margin-right: 10px;">
                                    <a href="<?php echo base_url();?>user/form_input/<?php echo $formulir->replid ?>"> 
                                        <div class="file vertical">
                                            <div class="font-size-40">
                                                <?php if ($formulir->form_submit == 1): ?>
                                                    <i class="anticon anticon-file text-success"></i>
                                                <?php else: ?>
                                                    <i class="anticon anticon-file text-warning"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="m-5-10">
                                                <h6 class="mb-0"><?php echo $formulir->nopendaftaran; ?></h6>
												
												
                                                
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->session->flashdata('notif'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<div class="modal fade" id="beliFormulir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembelian Formulir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('user/buy_form', 'method="post"');?>
                <div class="row">
                    <?php $dep = $this->m_user->get_name_departemen();?>
                    <div class="col-md-12">
                        <label>Pilih Departemen</label>
                        <div class="m-b-15">
                            <select class="select2" name="departemen">
                                <?php foreach ($dep as $ds): ?>
                                    <option value="<?php echo $ds->replid;?>"><?php echo $ds->departemen; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Masukkan Jumlah Formulir</label>
                        <div class="m-b-15">
                            <select class="select2" name="jml_form">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='Sending…';">Lanjut ke Pembayaran</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
