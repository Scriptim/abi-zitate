<?php
$quot_added = mysqli_real_escape_string($connection, date('Y-m-d H:i:s'));
$quot_class = mysqli_real_escape_string($connection, $_POST['class']);
$quot_date = mysqli_real_escape_string($connection, $_POST['date']);
$quot_quotation = mysqli_real_escape_string($connection, str_replace(array('„', '“', '”', ',,'), '"', $_POST['quotation']));

if (isset($_POST['added'])) {
    $quot_added = mysqli_real_escape_string($connection, $_POST['added']);
}

if (empty($quot_date)) {
    $quot_date = '0000-00-00';
}
