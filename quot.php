<?php
$allowed_tags = '<b><i><u>';
$quot_added = mysqli_real_escape_string($connection, date('Y-m-d H:i:s'));
$quot_class = mysqli_real_escape_string($connection, strip_tags($_POST['class'], $allowed_tags));
$quot_date = mysqli_real_escape_string($connection, strip_tags($_POST['date']));
$quot_quotation = mysqli_real_escape_string($connection, str_replace(array('„', '“', '”', ',,'), '"', strip_tags($_POST['quotation'], $allowed_tags)));

if (isset($_POST['added'])) {
    $quot_added = mysqli_real_escape_string($connection, strip_tags($_POST['added']));
}

if (empty($quot_date)) {
    $quot_date = '0000-00-00';
}
