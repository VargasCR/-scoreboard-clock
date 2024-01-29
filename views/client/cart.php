
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
                    <div class="flip" style="">
                      <a onclick="findMessageContact(event)">
                        <div class="front">ENVIAR</div>
                        <div class="back">ENVIAR</div>
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
