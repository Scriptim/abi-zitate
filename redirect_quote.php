<?php
$quot_id = '#quot-' . str_replace(' ', '_', $quot_added);
header('Location: ' . $quot_id);
die();

