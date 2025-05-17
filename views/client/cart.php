
    <div class="cart-container" style="min-height: 84vh;">
        <h4 style="text-align: center !important;width: 100%;margin-top: 2rem;">Carrito de Compras</h4>
        <div class="shopping-cart">
            <div class="shopping-cart-products" id="shopping-cart-products">
              <div class="shopping-cart-title">
                <h4 style="text-align: center !important;width: 100%;margin: 1rem 0 !important;">PRODUCTOS</h4>
              </div>
             
              
              <div style="background-color: black;" class="shopping-cart-products" id="shopping-cart-products-container">
                
              </div>
              
            </div>
            <div>
              
            </div>
              <div style="padding:1rem;margin-left: 1rem;" id="shopping-cart-resumen">
                <div style="padding: 0 1rem;
                  background-color: rgb(221 221 221);
margin-left: 0.5rem;">
                  <br>
                  <h4 style="text-align: center !important;">RESUMEN</h4>
                  <br>
                  <div style="">
                      <label>Items</label>
                      <p id="cantidad-productos-resumen">$300.00</p>
                  </div>

                  <div style="margin: 0.5rem 0 0 0;">
                      <label>Subtotal</label>
                      <p id="total-productos-resumen-noTax">$300.00</p>
                  </div>
                  <div style="margin: 0.5rem 0 0 0;" class="select-container-cart"> 
                      <label for="">Costo de Envío</label>
                      <select name="" id="provinciaEnvio" onchange="encontrarResumen()">
                        <option id="opt-1" value="3000">Heredia - ₡3000</option>
                        <option id="opt-4" value="3000">Alajuela - ₡3000</option>
                        <option id="opt-5" value="3000">Limon - ₡3000</option>
                        <option id="opt-3" value="2500">San Jose - ₡2500</option>
                        <option id="opt-2" value="5000">Guanacaste - ₡5000</option>
                        <option id="opt-7" value="4000">Puntarenas - ₡4000</option>
                        <option id="opt-8" value="0">Retiro en Tienda</option>
                      </select>
                      <select class="hidden" name="" id="provinciaEnvio-gratis" disabled>
                        <option id="opt-0" value="0">Gratis</option>
                      </select>
                  </div>
                  <div style="margin: 0.5rem 0 0 0;">
                      <label for="">Impuestos</label>
                      <p id="impuestos-productos-resumen">$30.00</p>
                  </div>
                  <div style="margin: 0.5rem 0 0 0;">
                      <label for="">Total</label>
                      <p id="total-productos-resumen">$330.00</p>
                  </div>
                  <div style="text-align: center;margin-top: 1rem;">
                      <button style="margin: 0;" onclick="showInfoCliente()" class="btn-cart">CONTINUAR</button>
                  </div>
                  <br>
                </div>
              </div>
              <style>
                
              </style>
              <div style="padding:1rem;margin-left: 1rem;" id="shopping-cart-resumen-info" class="hidden">
                <div style="padding: 1rem;background-color:rgb(221 221 221);">
                  <h4 style="text-align: center !important;">INFORMACION</h4>
                <br>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Nombre Completo</label>
                  <input type="text" class="input-info-cliente" placeholder="Tu nombre..." id="name-field">
                </div>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Correo Electrónico</label>
                  <input type="text" class="input-info-cliente" placeholder="Tu correo..." id="email-field">
                </div>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Numero de telefono</label>
                  <input type="text" class="input-info-cliente" placeholder="Tu numero de telefono..." id="tel-field">
                </div>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Dirección Exacta</label>
                  <input type="text" class="input-info-cliente" placeholder="Tu dirección..." id="location-field">
                </div>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Comentarios</label>
                  <textarea id="comentario-field" type="text" class="input-info-cliente" placeholder="Comentarios o consultas..."></textarea>
                </div>
                <div style="margin: 0.5rem 0 0 0;">
                  <label>Método de Pago</label>
                  <select name="" id="pay-field" style="width: 100%;">
                    <option id="1" value="Tarjeta">Tarjeta</option>
                    <option id="2" value="deposito">Depósito bancario</option>
                    <option id="3" value="sinpe">Sinpe Movil</option>
                  </select>
                </div>
                <div style="text-align: center;margin-top: 1rem;">
                  <button style="margin: 0 0 0.5rem 0 !important;" class="btn-cart" onclick="showResumeCliente()">VOLVER</button>
                  <button style="margin: 0 !important;" class="btn-cart" onclick="enviarInfoCliente()">ENVIAR</button>
                </div>
                </div>
              </div>
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
    
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inner-content">
          <p>Copyright &copy; 2023 Atlantic Tienda Co., Ltd.
        
        - Design: <a rel="nofollow noopener" href="" target="_blank">VargasDEV</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>
