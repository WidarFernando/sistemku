<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 65%">
        <div class="card-body">
            
            <form method="POST" action="<?php echo base_url('admin/barangMasuk/tambahDataAksi') ?>">
                
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control">
                    <?php echo form_error('kode_barang') ?>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control">
                    <?php echo form_error('nama') ?>
                </div>

                <div class="form-group">
                    <label>Stok Masuk</label>
                    <input type="number" name="stok_masuk" class="form-control">
                    <?php echo form_error('stok_masuk') ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control">
                    <?php echo form_error('tanggal_masuk') ?>
                </div>
                <button type=
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>