<!-- The Modal -->
<div id="myModal-modal" class="modal-modal">

  <!-- The Close Button -->
  <span class="close-modal" onclick="closeModalImg()">&times;</span>

  <!-- Modal Content (The Image) -->
  <div style="width: 100%;text-align:center;display:flex;justify-content:center;">

    <div style="" class="container-img-modal">
      <img class="modal-content-modal" id="myModal-img">
      <div class="img-zoom-container">
        <!-- Modal Caption (Image Text) -->
        <div id="myresult" class="img-zoom-result"></div>
      </div>
    </div>
  </div>
</div>

<div id="sticky-ad-container">
  <div class="sticky">
    <div class="sticky-ad"><span><img src="/build/img/envios.png" alt=""></span>Envios a todo el país</div>
    <div class="sticky-ad hidden"><span><img src="/build/img/genuine.png" alt=""></span>Productos 100% genuinos</div>
    <div class="sticky-ad hidden"><span><img src="/build/img/payment.png" alt=""></span>Pago seguro</div>
    <div class="sticky-ad hidden"><span><img src="/build/img/discount.png" alt=""></span>Compras Al Por Mayor</div>
    <button onclick="closeStickyAd()">X</button>
  </div>
</div>





<input type="hidden" value="0" id="page-category">
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <!--<div class="banner-item-01">
          <div class="text-content">
            <div style="width: 100%;display:flex;justify-content:center;align-items:center;flex-direction: column;">
              <img class="imgheader" src="/build/img/pidetusteniscon.png" alt="" style="">
              <img class="imgheader" src="/build/img/atlanticTienda.png" alt="" style="margin-top:1.5rem;">
              <a style="margin:1rem 0 0 0;" class="seemore gold-effect" href="/products-male"><span style="font-weight: 300;">VER MAS</span></a>
            </div>
          </div>
        </div>-->
        <div class="banner-item-02">
          <div class="text-content" style="height: 100%;">
          <div class="header-banner-container">
              <img class="top-right img-w-corner-r-h" src="/build/img/header/h_e_1.png" alt="Imagen 2" style="">
              <img class="top-left img-w-corner-l-h" src="/build/img/header/h_e_0.png" alt="Imagen 1" style="">
              <img class="center-bottom img-logo-header" style="" src="/build/img/header/h_e_2.png" alt="Imagen 1">
              
              <div class="center-center">
                <img class="img-atlantic-logo-header" src="/build/img/header/h_e_3.png" alt="Imagen 1" style="">
                
                <a style="margin:1rem 0 0 0;" class="seemore gold-effect" href="/products-male"><span style="font-weight: 300;">VER MAS</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content" style="height: 100%;">
          
            <div class="header-banner-container">
              <img class="bottom-right img-w-corner-r" src="/build/img/header/w_e_1_0.png" alt="Imagen 2" style="">
              <img class="top-left img-w-corner-l" src="/build/img/header/w_e_0_0.png" alt="Imagen 1" style="">
              <img class="center-bottom img-logo-header" style="" src="/build/img/header/w_e_2.png" alt="Imagen 1">
              <img class="center-left img-forwoman-header" style="" src="/build/img/header/w_e_4.png" alt="Imagen 1">
              <div class="center-center">
                <img class="img-atlantic-logo-header" src="/build/img/header/w_e_5.png" alt="Imagen 1" style="">
                
                <a style="margin:1rem 0 0 0;" class="seemore gold-effect" href="/products-female"><span style="font-weight: 300;">VER MAS</span></a>
              </div>
            </div>
          
            <!--   <h4>Último Minuto</h4>
            <h2>Aprovecha las ofertas de último minuto</h2> -->
          </div>
        </div>
      </div>
    </div>
    
    <!-- Banner Ends Here -->
<br>


<h2 style="font-size: 28px;
    font-weight: 400;
    color: #1e1e1e;
    margin-bottom: 15px;
    text-align: center;">Categorias</h2>
<div class="category-container">
  <div class="sub-category-container">
    <a href="/products-female">
    <div class="category">
        <img src="/build/img/woman-vector.png" width="75px" alt="">
        <p style="font-size:22px;font-weight:400;"><span>PARA </span>ELLA</p>
      </div>
    </a>
    <a href="/products-male">
    <div class="category">
        <img src="/build/img/man-vector.png" width="75px" alt="">
        <p style="font-size:22px;font-weight:400;"><span>PARA </span>ÉL</p>
      </div>
    </a>
    <!--<a href="/products-aurum">
    <div class="category">
          <img src="/build/img/aurum-vector.png" width="75px" alt="">
          <p style="font-size:22px;font-weight:400;">AURUM</p>
        </div>
      </a>-->
  </div>
  
</div>













<div class="latest-products" id="latest-products">
  <div class="container">
    <div class="col-md-12">
      <div class="section-heading">
        <h2>Novedades</h2>
        <a class="ctax" type="button" onclick="showSelectGenre()">
          <span class="hover-underline-animation">VER TODO</span>
          <svg
            id="arrow-horizontal"
            xmlns="http://www.w3.org/2000/svg"
            width="30"
            height="10"
            viewBox="0 0 46 16"
          >
            <path
              id="Path_10"
              data-name="Path 10"
              d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
              transform="translate(30)"
            ></path>
          </svg>
        </a>
        <div class="select-genre">
          <a href="/products-female" style="margin: 5px;">Departamento de Mujer</a>
          <a href="/products-male" style="margin: 5px 5px 5px 5px;">Departamento de Hombre</a>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Contenido adicional aquí -->
    </div>
  </div>
</div>

    
    

<div class="carouselx" id="carouselx">
  <!-- Carrusel de imágenes -->
  <div class="carouselx--wrap" id="products-containerx">
  <!-- Añade más imágenes según sea necesario -->
  <div class="carouselx--filler"></div> <!-- Relleno para centrar la última imagen -->
  </div>

  <!-- Botones de desplazamiento -->
</div>
<div style="display: flex;width: 100%;align-items:center;justify-content:center;" id="carouselx-controls">
  <div class="carouselx-controls">
    <button id="prevBtnx" class="prevBtnx">&lt;</button>
    <button id="nextBtnx" class="nextBtnx">&gt;</button>
  </div>
</div>



<div class="" id="products-container">

</div>
<div style="display: flex;width: 100%;align-items:center;justify-content:center;" id="products-controls">
  <div class="carouselx-controls">
    <button onclick="prevNewProduct()" id="" class="prevBtnx">&lt;</button>
    <button onclick="nextNewProduct()" id="" class="nextBtnx">&gt;</button>
  </div>
</div>
<script>
  
</script>
<br>


    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Sobre Tienda Atlantic</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content" style="margin: 0 0 1rem 0;">
                <h4>¿Buscas los mejores productos??</h4>
                <p>¡Te damos la bienvenida a nuestra distinguida tienda, donde la elegancia y la calidad convergen! Somos un establecimiento que trasciende las fronteras físicas gracias a nuestra presencia virtual, brindando la posibilidad de envíos a lo largo y ancho del país para que puedas deleitarte con nuestras fascinantes opciones estés donde estés.</p>
                <p style="margin-bottom: 2rem;">Nuestra misión es proporcionar a nuestros clientes una experiencia de compra única, ofreciendo productos de moda con estándares de calidad excepcionales. Nos esforzamos por ser un referente en la industria, donde la excelencia y la sofisticación se fusionan para satisfacer los gustos más exigentes.</p>
                
                

                
             
              <a href="/about" class="cta" >
                <span class="textButton">Ver Más</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                  <path d="M1,5 L11,5"></path>
                  <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
              </a>
              

            </div>
          </div>
            <div class="col-md-6" style="margin: 0 0 1rem 0;">
              <div class="right-image">
                <img src="/build/img/aboutimg.png" style="width: 100%;" alt="">
              </div>
            </div>
        </div>
        <div class="about-container-desc" style="margin-top: 1.5rem;">
            <div class="cardinf" style="width: 100%;">
              <div class="cardinf-inner">
                <div class="cardinf-front">
                  <img width="10px" src="/build/img/schedule.png" alt="">
                  <p style="color: white;">Horarios</p>
                </div>
                <div class="cardinf-back">
                  <p style="text-align: center;color: white;">Todos los días	9am – 7pm</p>
                </div>
              </div>
            </div>
            <div class="cardinf" style="width: 100%;">
              <div class="cardinf-inner">
                <div class="cardinf-front">
                  <img width="10px" src="/build/img/location.png" alt="">
                  <p style="color: white;">Ubicación</p>
                </div>
                <div class="cardinf-back">
                  <p style="text-align: center;color: white;">11801, Heredia, Puerto Viejo, 41001</p>
                </div>
              </div>
            </div>
            <div class="cardinf" style="width: 100%;">
              <div class="cardinf-inner">
                <div class="cardinf-front">
                <img width="10px" src="/build/img/call.png" alt="">
                <p style="color: white;">Contactenos</p>
                </div>
                <div class="cardinf-back">
                  <p style="text-align: center;color: white;">+506 8412 6742</p>
                </div>
              </div>
            </div>

          </div>
      </div>
      
    </div>
    

   
    
    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
            
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Descubre Nuestros Productos <em>AURUM</em> Creativos y Únicos</h4>
                  <p>Sumérgete en la moda distintiva y la calidad excepcional de nuestra colección. Encontrarás productos que reflejan creatividad y singularidad en cada detalle.</p>
                  </div>
                  <div class="btncontainer" style="margin: 1rem 0;">
                      <a href="/products-aurum" class="cta" >
                        <span class="textButton">Ver Más</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                          <path d="M1,5 L11,5"></path>
                          <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="section-heading">
      <h2>Marcas</h2>
    </div>
    <div id="containerm">
  <div id="slider-containerm">
    <div id="sliderm">
      <div class="slidem"><span><img src="/build/img/logos/01.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/02.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/03.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/04.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/05.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/06.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/07.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/08.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/09.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/10.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/11.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/12.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/13.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/14.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/15.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/16.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/17.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/18.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/19.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/20.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/21.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/22.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/23.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/24.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/25.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/26.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/27.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/28.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/29.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/30.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/31.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/32.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/33.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/34.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/35.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/36.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/37.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/38.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/39.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/40.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/41.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/42.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/43.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/44.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/45.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/46.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/47.png" alt=""></span></div>
	  <div class="slidem"><span><img src="/build/img/logos/50.png" alt=""></span></div>
      <div class="slidem"><span><img src="/build/img/logos/51.png" alt=""></span></div>
      
    </div>
  </div>
</div>









<!--
<br>
<br>
<div class="section-heading">
  <h2>Descuentos</h2>
</div>
<link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap"
      rel="stylesheet"
    />


<div style="display: flex;justify-content:center;align-items:center;">
  <div class="wrapper-spin">
    <div class="container-spin">
      <canvas id="wheel-spin"></canvas>
      <button id="spin-btn">GIRAR</button>
      <img class="img-arrow" style="width: 80px;" src="/build/img/arrow.png" alt="spinner arrow" />
    </div>
    <div id="final-value-spin">
      <p>Click en el centro para GIRAR</p>
    </div>
  </div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>

-->







    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Envíanos un mensaje</h2>
            </div>
          </div>
          <div class="mapContainer">
            <div id="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1006278.8791800056!2d-84.664919453505!3d9.869078186986995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0995e17dc92f5%3A0xdd8f5f66d85b7e14!2sATLANTIC%20TIENDA%20COSTA%20RICA!5e0!3m2!1ses!2scr!4v1703100585124!5m2!1ses!2scr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <div class="col-md-6">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <label style="width: 100%;text-align: left;" for="name">Nombre Completo</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Tu nombre" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <label style="width: 100%;text-align: left;" for="email">Correo electrónico</label>
                      <input name="email" type="text" class="form-control" id="email" placeholder="Tu dirección de correo" required="">
                    </fieldset>
                  </div>
                  
                  <div class="col-lg-12">
                    <fieldset>
                      <label style="width: 100%;text-align: left;" for="message">Mensaje o consulta</label>
                      <textarea name="message" rows="6" class="form-control" id="message" placeholder="Escribe tu mensaje aquí" required=""></textarea>
                    </fieldset>
                  </div>

                  <div class="col-lg-12">
                    <fieldset>
                      <label style="width: 100%;text-align: left;margin: 1rem 0 0 0;" for="message">No soy un robot</label>
                      <input type="checkbox" name="" id="notrobot" style="width: 20px;float:left;margin:0;height: 25px;">
                    </fieldset>
                  </div>

                  <div class="col-lg-12">
                    <fieldset>
                      
                      <div class="btn-conteiner">
  <a class="btn-content" onclick="findMessageContact(event)" type="button">
    <span class="btn-title">ENVIAR</span>
    <span class="icon-arrow">
      <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
          <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
          <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
        </g>
      </svg>
    </span> 
              </a>
</div>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    


    
      <div class="container">
      <br>
      <div class="left-content">
        <h4>Encuentranos en</h4>
        
        
        <div style="width: 100%;display:flex;align-items: center;justify-content: center;margin:1rem 0">
          <div class="cardsocial">
                <a href="https://www.instagram.com/tiendaatlantic/" class="socialContainer containerOne">
                  <img src="/build/img/ig-ico.png" style="width: 25px;" alt="">
                </a>
                
                <a href="https://www.facebook.com/atlantictienda/" class="socialContainer containerTwo">
                    <img src="/build/img/fb-ico.png" style="width: 25px;" alt="">
                    
                  <a href="https://www.tiktok.com/@atlantictienda" class="socialContainer containerThree">
                  <img src="/build/img/tiktok-ico.png" style="width: 25px;" alt="">
                </a>
                
                <a href="https://wa.me/50684126742" class="socialContainer containerFour">
                    <img src="/build/img/whatsapp-ico.png" style="width: 25px;" alt="">
                  </a>
                </div>   
              </div>
            </div>
        </div>

        <footer class="footer-section">
          <div class="container" style="padding: 2rem 0 0 0;">
            <div class="footer-content">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                        <div class="footer-widget-heading">
                                <h3>Sobre Nosotros</h3>
                            </div>
                            <div class="footer-text">
                                <p>
                                ¿Buscas algo específico? Estamos aquí para ayudarte. Contáctanos para conocer más sobre nuestro sistema de apartados y obtener asesoramiento personalizado. ¡Nuestro equipo amigable está listo para ayudarte!
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Enlaces</h3>
                            </div>
                            <ul>
                                <li><a href="/">Principal</a></li>
                                <li><a href="/products-male">Hombres</a></li>
                                <li><a href="/products-female">Mujeres</a></li>
                                <li><a href="/about">Nosotros</a></li>
                                <li><a href="/reviews">Reseñas</a></li>
                                <li><a href="/terms">Términos</a></li>
                              </ul>
                              <lu><a style="color:white" href="/contact">CONTACTANOS</a></lu>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                      <div class="footer-widget">
                          <div class="footer-widget-heading">
                              <h3>¡Suscríbete!</h3>
                          </div>
                          <div class="footer-text mb-25">
                              <p>Descubre un mundo de novedades suscribiéndote a nuestras actualizaciones. Llena amablemente el formulario a continuación.</p>
                          </div>
                          <div class="subscribe-form">
                              
                            <input id="emailsuscriptor" type="text" placeholder="Correo Electrónico">
                            <button onclick="sendSuscribeEmail()"><img src="/build/img/send-img.png" width="20px" alt=""></button>
                              
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="inner-content">
                          <p style="color:white;">Copyright &copy; <?php echo date("Y"); ?> Atlantic Tienda Co., Ltd.
                          
                          - Design: <a style="color: #fff;" rel="nofollow noopener" href="" target="_blank">VargasDEV</a></p>
                          </div>
                      </div>
                    </div>
                </div>
        </footer>

            
            <a href="/cart" class="cartBtn hidden" id="floating-cart-btn">
                <svg class="cart" fill="white" viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" class="product"><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"></path></svg>
            </a>
            

          <!--  <button onclick="goToTop()" class="floating-top-btn"><img src="/build/img/expand_less.svg" alt=""></button>
              -->
            <button class="buttontp" onclick="goToTop()">
              <svg class="svgIcon" viewBox="0 0 384 512">
                <path
                  d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                ></path>
              </svg>
            </button>
            

        
            <div class="whatsapp-float iluminationbutton">
              <a href="https://wa.me/50684126742" target="_blank" title="WhatsApp" style="border:none;box-shadow:transparent !important;">
                <button onclick="sendAlert()" style="background-color:transparent !important;border:none;">
                  <img src="/build/img/whatsapp-icon.png" alt="WhatsApp Icon">
                </button>
              </a>
            </div>


            <div id="popup" class="popup hidden">
              <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <a href="#">
                  <img id="popUpIMG" src="" alt="Oferta especial">
                </a>
              </div>
            </div>












            

            <div id="myModal" onclick="closeOnOutsideClick(event)" class="modal" style="padding:0rem;z-index: 9999999;overflow-y: auto;justify-content: center;">
              <div class="modal-content">
                <button onclick="closeFloatingWindow()" class="deleteButton">
                  <span class="closex" id="closeModalBtn">&times;</span>
                  <span class="tooltip">Cerrar</span>
                </button>
                <div style="" class="showingProductContainer">
                  <div id="contenedorImagen">
                    <div id="contenedorBotones">
                      <button class="botonArrow" onclick="cambiarImagenShowing(event,0)"><span class='material-symbols-outlined'>chevron_left</span></button>
                      <button class="botonArrow" onclick="cambiarImagenShowing(event,1)"><span class='material-symbols-outlined'>chevron_right</span></button>
                    </div>
                    <img src="/build/img/discount-tag.png" class="imgTag" id="imgTag" alt="">
                    <img onclick="openFullImgModal(event)" id="img-show-product" style="width: 100% !important;" src="" alt="" srcset="">
                  </div>
                  <div style="padding: 1rem;width: 100%;">
                    <h4 style="margin: 0 0 1rem 0;">
                      Descripción
                    </h4>
                    <div id="desc-container">
                      
                    </div>
                    <br>
                    <div>
                      <h4>Precio</h4>
                      <div id="precio-container">

                      </div>
                      <div>
                        <h4>Talla</h4>
                        <div id="tallas-container">

                        </div>
                      </div>
                    <div>
                      <h4>Color</h4>
                      <div id="colores-container">

                      </div>
                    </div>
                    <div style="width: 100%;display: flex;align-content: center;align-items: center;">
                      <button onclick="agregarAlCarrito()" class="btn-add-cart" style="margin-top: 1rem;width: 100% !important;">Agregar Al Carrito</button>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="talla-id" value="-1">
                <input type="hidden" id="color-id" value="-1">
                <input type="hidden" id="product-id" value="-1">
                <input type="hidden" id="image-id" value="-1">
                <input type="hidden" id="imgs-url" value="">
              </div>
            </div>