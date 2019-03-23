<?php
while ($row = mysqli_fetch_assoc($query)):
    $quot_id = 'quot-' . str_replace(' ', '_', $row['added']);

    $quot_class = '';
    if (count($row['class']) > 0) {
        $quot_class = $row['class'];
    }

    $quot_date = '';
    if (!empty($row['date']) && $row['date'] != '0000-00-00') {
        $quot_date = date_format(date_create($row['date']), 'd.m.Y');
    }

    $quot_quotation = $row['quotation'];
    ?>

<div class="card-wrapper col-3 col-xl-4 col-lg-6 col-md-12 p-1">
    <div class="card" id="<?= $quot_id ?>">
        <div class="card-header">
            <div class="card-title h5"><?= $quot_class ?></div>
            <div class="card-subtitle text-gray"><?= $quot_date ?></div>
        </div>
        <div class="card-body"><?= $quot_quotation ?></div>
        <div class="card-footer text-right">
            <?php if ($authenticated) : ?>
            <button class="btn-edit btn m-1">Bearbeiten</button>
            <button class="btn-delete btn m-1 mr-2">Löschen</button>
            <?php endif; ?>
            <a class="ml-2" href="#<?= $quot_id ?>">&#128279;</a>
        </div>
    </div>
</div>

<?php
endwhile;

