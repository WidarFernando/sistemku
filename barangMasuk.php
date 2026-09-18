<?php
/**
 * ============================================================================
 * BERKAS VIEW: TABEL DATA BARANG MASUK (barangMasuk.php)
 * ============================================================================
 * 
 * DESKRIPSI UTAMA:
 * Berkas antarmuka (View) ini berfungsi untuk menyajikan tabel daftar barang masuk 
 * dalam modul manajemen inventori "Desi Collection". Menyediakan kontrol UI untuk 
 * penambahan data baru, pencarian keyword (server-side GET), pembaruan data, 
 * hingga penghapusan data.
 * 
 * DILENGKAPI FITUR:
 * - PHP Server-Side Debugging (Output status data via Browser Console).
 * - Client-Side JS Debugging & DOM Verification dengan Try-Catch Block.
 * - Sanitasi output menggunakan html_escape() untuk pencegahan XSS.
 * 
 * PARAMETER DATA (DARI CONTROLLER):
 * @param string $title  Judul halaman yang dikirim dari controller 'BarangMasuk'.
 * @param array  $masuk  Kumpulan objek data tabel 'barang_masuk' dari database.
 * 
 * HASIL / RETURN VALUE:
 * @return void Renders tampilan HTML elemen container-fluid, tabel data, dan script debugging.
 * 
 * ARSITEKTUR & DESAIN:
 * Framework : CodeIgniter 3
 * Template  : Bootstrap 4 / SB Admin 2
 * ============================================================================
 */
?>

<div class="container-fluid" style="margin-bottom: 100px;">

    <!-- PHP DEBUGGING: Verifikasi ketersediaan variabel data -->
    <?php 
        // Log ke console browser jika variabel $masuk kosong atau bukan array
        if (empty($masuk)) {
            echo "<script>console.warn('[PHP DEBUG] Warning: Data \$masuk kosong atau tidak ditemukan!');</script>";
        } else {
            $totalData = count($masuk);
            echo "<script>console.log('[PHP DEBUG] Data \$masuk berhasil dimuat. Total baris: {$totalData}');</script>";
        }
    ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo html_escape($title) ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/barangMasuk/tambahData') ?>">
        <i class="fas fa-plus"></i> Tambah Barang
    </a>
    
    <!-- Form Pencarian -->
    <form method="GET" action="<?php echo base_url('admin/barangMasuk') ?>" id="formSearch">
        <div class="input-group input-group-sm mb-3">
            <input type="text" name="keyword" id="keywordInput" class="form-control" placeholder="Cari barang..." value="<?php echo html_escape($this->input->get('keyword')) ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="btnSearch">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </div>
    </form>

    <!-- Tabel Data Barang Masuk -->
    <table class="table table-striped table-bordered" id="tableBarangMasuk">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Stok Masuk</th>
                <th class="text-center">Tanggal Masuk</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($masuk)) : ?>
                <?php $no = 1; foreach($masuk as$m) : ?>
                <tr>
                    <td class="text-center"><?php echo $no++ ?></td>
                    <td><?php echo html_escape($m->kode_barang) ?></td>
                    <td><?php echo html_escape($m->nama) ?></td>
                    <td class="text-center"><?php echo html_escape($m->stok_masuk) ?></td>
                    <td class="text-center"><?php echo html_escape($m->tanggal_masuk) ?></td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/barangMasuk/updateData/'.$m->kode_barang) ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/barangMasuk/deleteData/'.$m->kode_barang) ?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Data barang masuk tidak ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- JAVASCRIPT DEBUGGING (Pelacakan via Console Tab F12) -->
<script>
/**
 * Event Listener DOMContentLoaded
 * 
 * Kegunaan:
 * Melakukan verifikasi runtime elemen DOM dan melacak event form pencarian.
 * 
 * @param {Event} e Event object listener
 * @return {void} Menuliskan log hasil pemeriksaan ke Browser Console Tab.
 */
document.addEventListener("DOMContentLoaded", function () {
    try {
        console.log("[DEBUG JS] Inisialisasi halaman Barang Masuk...");

        const table = document.getElementById("tableBarangMasuk");
        const formSearch = document.getElementById("formSearch");
        const keywordInput = document.getElementById("keywordInput");

        // 1. Check elemen DOM
        if (!table || !formSearch) {
            throw new Error("Elemen 'tableBarangMasuk' atau 'formSearch' tidak ditemukan pada DOM.");
        }

        // 2. Debugging Jumlah Baris Data
        const totalRows = table.querySelectorAll("tbody tr").length;
        console.log(`[DEBUG JS] Jumlah baris tabel yang dirender: ${totalRows}`);

        // 3. Debugging Event Form Search
        formSearch.addEventListener("submit", function (e) {
            const keywordValue = keywordInput.value.trim();
            console.log(`[DEBUG JS] Submit pencarian dipicu. Kata kunci: "${keywordValue}"`);
            
            if (keywordValue === "") {
                console.log("[DEBUG JS] Kata kunci kosong. Menampilkan seluruh data.");
            }
        });

    } catch (error) {
        // Safe Error Handling untuk runtime JS
        console.error("[RUNTIME ERROR JS] Terjadi kesalahan pada skrip halaman:", error.message);
    }
});
</script>