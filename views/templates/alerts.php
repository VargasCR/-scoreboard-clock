<?php
// Define $alerts as an empty array if it's not already defined
$alerts = isset($alerts) ? $alerts : [];

foreach ($alerts as $key => $errors):
    foreach ($errors as $error):
        ?>
        <div class="alert <?php echo $key; ?>">
            <?php echo $error; ?>
        </div>
        <?php
    endforeach;
endforeach;
?>
