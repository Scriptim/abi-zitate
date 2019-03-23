<?php
if (isset($error)) {
    die("<div class=\"toast toast-error mb-2 text-center\">$error</div>");
}
if ($authenticated) {
    echo ('<div class="toast toast-success mb-2 text-center">Du bist eingeloggt</div>');
}

