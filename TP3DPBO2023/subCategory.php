<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/SubCategory.php');
include('classes/Template.php');

// buat instance Food
$subCategory = new SubCategory($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$subCategory->open();
// tampilkan data SubCategory
$subCategory->getSubCategoryFood();

// cari SubCategory
if (isset($_POST['btn-cari'])) {
    // methode mencari data SubCategory
    // $subCategory->searchSubCategory($_POST['cari']);
} else {
    // method menampilkan data SubCategory
    $subCategory->getSubCategoryFood();
}

// buat instance template
$home = new Template('templates/skintable.html');

$title = 'Sub Category Produk';
$tableHeader = '<tr>
            <th scope="row">No.</th>
            <th scope="row">Sub Category Produk</th>
            <th scope="row">Edit/Delete</th>
        </tr>';
$data = null;
$no = 1;

// ambil data SubCategory
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($div = $subCategory->getResult()) {
    $data .= '<tr>
                <td scope="row">' . $no . '</td>
                <td>' . $div['name_subcategory_food'] . '</td>
                <td>
                    <a href="divisi.php?id=' . $div['id_subcategory_food'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>
                    &nbsp;
                    <a href="divisi.php?hapus=' . $div['id_subcategory_food'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
                </td>
            </tr>';
    $no++;
}

//submit form
if (!isset($_GET['id_subcategory_food'])) {
    if (isset($_POST['submit'])) {
        if ($subCategory->addData($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'seri.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'seri.php';
            </script>";
        }
    }
}else if (isset($_POST['cancel'])) {

}

// tutup koneksi
$subCategory->close();


// simpan data ke template
$home->replace('DATA_MAIN_TITLE', $title);
$home->replace('DATA_TABLE_HEADER', $tableHeader);
$home->replace('DATA_TABLE', $data);
$home->write();
