<?php
    foreach($alerts as $key => $errors):
        foreach($errors as $error):
            ?>
            <div class="alert <?php echo $key; ?>">
                <?php echo $error; ?>
            </div>

            <?php
        endforeach; 
    endforeach;
?>