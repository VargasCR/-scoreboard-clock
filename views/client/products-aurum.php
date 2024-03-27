

<input type="hidden" value="2" id="page-category">

    <input type="hidden" value="3" id="selecter-used">
<div style="width: 100%;display:flex;justify-content:center;align-items:center;">
      <div class="custom-select-container" id="custom-select-container">
        <div style="display: flex;">
          <button id="selecter" class="custom-select" onclick="toggleOptions()">
            <div style="display: flex;justify-content:center;align-items:center;">
              <p style="line-height: 0;margin:0;color:white;" id="select-text">
              <?php if(isset($_GET['ea170e2cafb1337755c8b3d5ae4437f4'])) {
                      foreach ($categorias as $categoria) { 
                        if($categoria->id == $_GET['ea170e2cafb1337755c8b3d5ae4437f4']) {
                          echo $categoria->nombre;
                          break;
                        }
                        
                      } 
                    } else {
                      echo 'Todos los productos';
                    }?>
            </p>
              <span id="select-simbol" style="line-height: 0;margin:0;color:white;">&#9660;</span>
            </div>
          </button>
        </div>
        <div class="custom-select-options" id="optionsContainer" style="z-index: 9999;">
            <?php foreach ($categorias as $categoria) { ?>
                <div class="custom-option" onclick="cambiarCategoria('<?= $categoria->id ?>', '<?= $categoria->nombre ?>')"><?= $categoria->nombre ?></div>
            <?php } ?>
        </div>
      </div>
    </div>
    
    <div class="products-container" id="products-containerx">
  <!-- Añade más imágenes según sea necesario -->
  
  </div>
<div id="navegation-products" style="width: 100%;align-items: center;text-align: center;">
  <div>
    <button class="btn-nav hidden" id="btn-nav-back-hidden"></button>
    <button onclick="retrocederPagina()" class="btn-nav" id="btn-nav-back" style="font-size: 17px;"><</button>
    <button value="1" onclick="encontrarPagina('btn-nav-0')" class="btn-nav-number btn-nav btn-nav-active" id="btn-nav-0">1</button>
    <button value="2" onclick="encontrarPagina('btn-nav-1')" class="btn-nav-number btn-nav" id="btn-nav-1">2</button>
    <button value="3" onclick="encontrarPagina('btn-nav-2')" class="btn-nav-number btn-nav" id="btn-nav-2">3</button>
    <button onclick="siguientePagina()" class="btn-nav" id="btn-nav-back" style="font-size: 17px;">></button>
    <button class="btn-nav hidden" id="btn-nav-forward-hidden"></button>
  </div>
</div>

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
                              <form action="#">
                                  <input type="text" placeholder="Correo Electrónico">
                                  <button onclick="sendSuscribeEmail()"><img src="/build/img/send-img.png" width="20px" alt=""></button>
                              </form>
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

            <script>
              var optionsContainer = document.getElementById('optionsContainer');
              optionsContainer.style.display = 'none';
            </script>

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