<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}

if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}

print($_FILES['file']['type']);
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/temp.' . str_replace("image/", "", $_FILES['file']['type']));

echo "File uploaded successfully.";
?>