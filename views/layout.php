
<!DOCTYPE html>
<html lang="en">
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
?>
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','index');</script>
    <!-- End Google Tag Manager -->


    <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-6J359L1V91"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-6J359L1V91');
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://tiendaatlanticcr.com/">
	  <meta name="keywords" content="Atlantic Tienda Costa Rica, productos para el hogar, accesorios de moda, decoración, electrodomésticos, estilo de vida, compras en línea, calidad, ofertas especiales">
    
    <title>Atlantic Tienda Costa Rica - Encuentra productos de calidad para tu hogar y estilo de vida</title>
    <meta name="description" content="Explora la amplia selección de productos en Atlantic Tienda Costa Rica. Desde artículos para el hogar hasta accesorios de moda, descubre opciones que se adaptan a tu estilo de vida. ¡Compra con confianza y disfruta de la calidad que ofrecemos para mejorar tu experiencia diaria!">

    <meta name="author" content="VargasDEV">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    
    
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KSJ9CFF5');</script>
<!-- End Google Tag Manager -->



    <link href="/build/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <meta property="og:title" content="Tienda Atlantic - Tu destino de compras en línea en Costa Rica">
    <meta property="og:description" content="Bienvenido a Tienda Atlantic, tu destino de compras en línea en Costa Rica. Encuentra una amplia selección de productos de alta calidad y disfruta de una experiencia de compra conveniente y segura.">
    <meta property="og:image" content="https://tiendaatlanticcr.com/build/img/webScreenShot.PNG">
    <meta property="og:url" content="https://tiendaatlanticcr.com/">
    <meta property="og:type" content="website">
    <?php if($pageIndex == 7) {
      echo '<link rel="stylesheet" href="/build/css/app.css">';
      }?>
    

    <?php if($pageIndex != 15) {echo '
        <link rel="stylesheet" href="/build/css/templatemo-sixteen.css">
        <link rel="stylesheet" href="/build/css/owl.css">';} ?>
    
    
    <?php if($pageIndex == 6) {echo '<link rel="stylesheet" href="/build/css/style.css">';}?>
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSJ9CFF5"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    <input type="hidden" name="" value="<?php echo $pageIndex; ?>" id="pageindex">
    <!-- Header -->
<?php
  if($pageIndex != 15) {
    echo '<header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="/"><img class="img-principal-btn" src="/build/img/atlantic-ico.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <img src="/build/img/barras-dark.svg" alt="" width="25px">
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ' . ($pageIndex == 0 ? 'active' : '') . '">
                <a class="nav-link" href="/">Principal
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <!--<li class="nav-item ' . ($pageIndex == 1 ? 'active' : '') . '">
                <a class="nav-link" href="/products">Productos</a>
              </li>-->
              <li class="nav-item ' . ($pageIndex == 1 ? 'active' : '') . '">
                <a class="nav-link" href="/products-male">Hombre</a>
              </li>
              <li class="nav-item ' . ($pageIndex == 1.5 ? 'active' : '') . '">
                <a class="nav-link" href="/products-female">Mujer</a>
              </li>
              <!--<li class="nav-item ' . ($pageIndex == 2 ? 'active' : '') . '">
                <a class="nav-link" href="/products-aurum">Aurum</a>
              </li>-->
              <li class="nav-item ' . ($pageIndex == 3 ? 'active' : '') . '">
                <a class="nav-link" href="/about">Nosotros</a>
              </li>
              <li class="nav-item ' . ($pageIndex == 3.5 ? 'active' : '') . '">
                <a class="nav-link" href="/terms">Términos</a>
              </li>
              <li class="nav-item ' . ($pageIndex == 4 ? 'active' : '') . '">
                <a class="nav-link" href="/reviews">Reseñas</a>
              </li>
              <li class="nav-item ' . ($pageIndex == 5 ? 'active' : '') . '">
                <a class="nav-link" href="/contact">Contactar</a>
              </li>
              '. ($pageIndex == 6 ? '
              <li class="nav-item active">
                <a class="nav-link" href="/cart">Carrito</a>
              </li>' : '').'
            </ul>
          </div>
        </div>
      </nav>
    </header>';
  } 
?>
      <main style="height:100vh;">
          <?php echo $content ?? ''; ?>
      </main>
      <script src="/build/js/modernizr.js"></script>
      <!-- <script src="/build/js/app.js"></script> -->
      <?php if(true) {
        echo "
        <script src='/build/jquery/jquery.min.js'></script>
        <script src='/build/bootstrap/js/bootstrap.min.js'></script>
        <script src='/build/js/email.js'></script>
        <script src='/build/js/smtp.js'></script>
        <script src='/build/js/custom.js'></script>
        <script src='/build/js/products.js'></script>
        <script src='/build/js/owl.js'></script>
        <script src='/build/js/slick.js'></script>
        <script src='/build/js/isotope.js'></script>
        <script src='/build/js/accordions.js'></script>
        <script src='/build/js/cart.js'></script>"; 
      }?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
      <script src="<?php echo $alertlink; ?>"></script>
      <script src="<?php echo $archive; ?>"></script>
      <script><?php echo $function ?? ''; ?></script>
      <script language = "text/Javascript"> 
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
            }
        }
      </script>
  </body>
</html>
    