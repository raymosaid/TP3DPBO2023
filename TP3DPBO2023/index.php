<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Template.php');

// buat instance Food
$food = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$food->open();
// tampilkan data Food
$food->getFoodJoin();

// cari Food
if (isset($_POST['btn-cari'])) {
    // methode mencari data Food
    $food->searchFood($_POST['cari']);
} else {
    // method menampilkan data Food
    $food->getFoodJoin();
}

$data = null;

// ambil data Food
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $food->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">
                <div class="card pt-4 px-2 food-thumbnail">
                    <a href="detail.php?id=' . $row['id_food'] . '">
                        <div class="row justify-content-center">
                            <img src="assets/images/' . $row['pict_food'] . '" class="card-img-top" alt="' . $row['pict_food'] . '">
                        </div>
                        <div class="card-body">
                            <p class="card-text name-food my-0">' . $row['name_food'] . '</p>
                            <p class="card-text subcategory-food">' . $row['name_subcategory_food'] . '</p>
                            <p class="card-text typemenu-food">' . $row['name_type_menu'] . '</p>
                            <p class="card-text desc-food my-0">' . $row['desc_food'] . '</p>
                            <p class="card-text price-food my-0">' . $row['price_food'] . '</p>
                        </div>
                    </a>
                </div>    
            </div>';
}

// tutup koneksi
$food->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_MAKANAN', $data);
$home->write();
