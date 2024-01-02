
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tienda Atlantic</title>
            <link rel="stylesheet" href="/build/css/app.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        </head>
        <body>
            
            
            
            <main style="height:100vh;display:flex;align-items: center;justify-content: center;">
                <?php echo $content ?? ''; ?>
            </main>
                
                <script src="/build/js/modernizr.js"></script>
               <!-- <script src="/build/js/app.js"></script> -->
                <script src="<?php echo $alertlink; ?>"></script>
                <script src="<?php echo $archive; ?>"></script>
                <script><?php echo $function ?? ''; ?></script>
        </body>
    </html>
    