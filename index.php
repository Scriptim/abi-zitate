<?php
error_reporting(0);
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Berlin');

$config = parse_ini_file('config.ini');

include 'auth.php';

$connection = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

if (!$connection) {
    if (!isset($error)) {
        $error = 'Verbindung zur Datenbank fehlgeschlagen';
    }
} else {
    mysqli_set_charset($connection, 'utf8');

    if (isset($_POST['add-quotation'])) {
        if (!isset($_POST['password']) || $_POST['password'] != $config['pw_submit']) {
            $error = 'Nicht authorisiert';
        } else {
            include 'quot.php';

            $query = mysqli_query($connection, "INSERT INTO `$config[db_table]`(`added`, `class`, `date`, `quotation`) VALUES (\"$quot_added\", \"$quot_class\", \"$quot_date\", \"$quot_quotation\")");

            if (!$query) {
                $error = 'Zitat konnte nicht eingereicht werden';
            } else {
                include 'redirect_quote.php';
            }
        }
    } elseif (isset($_POST['edit-quotation']) && $authenticated) {
        include 'quot.php';

        $query = mysqli_query($connection, "UPDATE `$config[db_table]` SET `class`=\"$quot_class\", `date`=\"$quot_date\", `quotation`=\"$quot_quotation\" WHERE `added` = \"$quot_added\"");

        if (!$query) {
            $error = 'Zitat konnte nicht bearbeitet werden';
        } else {
            include 'redirect_quote.php';
        }
    } elseif (isset($_POST['delete-quotation']) && $authenticated) {
        $quot_added = mysqli_real_escape_string($connection, $_POST['added']);

        $query = mysqli_query($connection, "DELETE FROM `$config[db_table]` WHERE `added` = \"$quot_added\"");

        if (!$query) {
            $error = 'Zitat konnte nicht gelöscht werden';
        } else {
            header('Location: .');
            die();
        }
    }

    $query = mysqli_query($connection, "SELECT * FROM $config[db_table] ORDER BY added DESC");
    if (!$query && !isset($error)) {
        $error = 'Fehler beim Laden der Zitate';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="./index.css">

    <title>Abi-Zitate</title>
</head>

<body>
    <h1 class="mt-2 text-center"><a href=".">Abi-Zitate</a></h1>
    <div class="divider"></div>

    <?php
    include 'toasts.php';
    ?>

    <div class="m-2 text-center">
        <button class="btn btn-lg btn-primary m-2" id="btn-add-quote">Zitat einreichen</button>
    </div>
    <div class="modal" id="modal-add-quote">
        <a class="modal-overlay close-add-quote" aria-label="Close"></a>
        <div class="modal-container">
            <div class="modal-header">
                <a class="btn btn-clear float-right close-add-quote" aria-label="Close"></a>
                <div class="modal-title h5">Zitat einreichen</div>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form method="post">
                        <div class="form-group">
                            <input class="form-input m-1" type="text" name="class" title="Kurs" placeholder="Kurs">
                            <input class="form-input m-1" type="date" name="date" title="Datum" placeholder="Datum">
                            <textarea class="form-input m-1" name="quotation" title="Zitat" placeholder="Zitat" cols="40" rows="8" required></textarea>
                            <input class="form-input m-1" type="password" name="password" title="Passwort" placeholder="Passwort" required>
                            <button class="btn btn-primary input-group-btn m-1" type="submit" name="add-quotation">Einreichen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="columns">
            <?php
            include 'cards.php';
            ?>
        </div>
    </div>

    <script src="index.js"></script>
</body>

</html>
