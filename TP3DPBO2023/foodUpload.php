<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/SubCategory.php');
include('classes/TypeMenu.php');
include('classes/Template.php');

// buat instance SubCategory
$subCategory = new SubCategory($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$subCategory->open();
// tampilkan data SubCategory
$subCategory->getSubCategoryFood();

// buat instance SubCategory
$typeMenu = new TypeMenu($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$typeMenu->open();
// tampilkan data typeMenu
$typeMenu->getTypeMenu();

// cari SubCategory
if (isset($_POST['btn-cari'])) {
    // methode mencari data SubCategory
    $subCategory->searchSubCategory($_POST['cari']);
} else {
    // method menampilkan data SubCategory
    $subCategory->getSubCategoryFood();
}

$dataTypeMenu = null;
$dataSubCategory = null;

// ambil dataSubCategory SubCategory
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $subCategory->getResult()) {
    $dataSubCategory .= '<option value=' . $row['id_subcategory_food'] . '>' . $row['name_subcategory_food'] . '</option>';
}
while ($row = $typeMenu->getResult()) {
    $dataTypeMenu .= '<option value=' . $row['id_type_menu'] . '>' . $row['name_type_menu'] . '</option>';
}

//submit form
if (isset($_POST['upload'])) {
 
    $filename = $_FILES["pict_food"]["name"];
    $tempname = $_FILES["pict_food"]["tmp_name"];
    $folder = "./assets/images/" . $filename;
    $name_food = $_POST['name_food'];
    $id_subcategory_food = $_POST['id_subcategory_food'];
    $id_type_menu = $_POST['id_type_menu'];
    $desc_food = $_POST['desc_food'];
    $price_food = $_POST['price_food'];
 
    // $db = new SubCategory($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    // $db->open();
    $db = mysqli_connect("localhost", "root", "", "db_tp3_dpbo");
 
    // Get all the submitted data from the form
    $sql = "INSERT INTO t_food 
    set name_food = '$name_food',
    id_subcategory_food = '$id_subcategory_food',
    id_type_menu = '$id_type_menu',
    desc_food = '$desc_food',
    price_food = '$price_food',
    pict_food = ('$filename')";
 
    // Execute query
    // mysqli_query($subCategory, $sql);
    mysqli_query($db, $sql);

    $db->close();
}else if (isset($_POST['cancel'])) {

}

// tutup koneksi
$typeMenu->close();
$subCategory->close();

// buat instance template
$home = new Template('templates/skinform.html');

// simpan data ke template
$home->replace('DATA_SUBCATEGORY', $dataSubCategory);
$home->replace('DATA_TYPE_MENU', $dataTypeMenu);
$home->write();
