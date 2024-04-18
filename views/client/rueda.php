<link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap"
      rel="stylesheet"
    />

<br>
    <div class="section-heading">
      <h2>Descuentos</h2>
    </div>
<div style="display: flex;justify-content:center;align-items:center;height: fit-content;">
<div></div>
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
<br>
  <!-- Chart JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <!-- Chart JS Plugin for displaying text over chart -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>





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
        <script>
          
  const wheel = document.getElementById("wheel-spin");
        const spinBtn = document.getElementById("spin-btn");
        const finalValue = document.getElementById("final-value-spin");
        const rotationValues = [
            { minDegree: 0, maxDegree: 30, value: '20%' },
            { minDegree: 31, maxDegree: 90, value: '5%' },
            { minDegree: 91, maxDegree: 150, value: '10%' },
            { minDegree: 151, maxDegree: 210, value: '7%' },
            { minDegree: 211, maxDegree: 270, value: '15%' },
            { minDegree: 271, maxDegree: 330, value: '0%' },
            { minDegree: 331, maxDegree: 360, value: '20%' },
        ];
        const data = [16, 16, 16, 16, 16, 16];
        var pieColors = [
            "#808080", // gris
            "#A9A9A9", // gris oscuro
            "#808080", // gris
            "#A9A9A9", // gris oscuro
            "#808080", // gris
            "#A9A9A9", // gris oscuro
        ];
let resultado = null;
        let myChart = new Chart(wheel, {
        plugins: [ChartDataLabels],
        type: "pie",
        data: {
            labels: ['5%', '20%', '0%', '15%', '7%', '10%'],
            datasets: [
            {
                backgroundColor: pieColors,
                data: data,
            },
            ],
        },
        options: {
            responsive: true,
            animation: { duration: 0 },
            plugins: {
            tooltip: false,
            legend: {
                display: false,
            },
            datalabels: {
                color: "#ffffff",
                formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                font: { size: 24 },
            },
            },
        },
        });
        const valueGenerator = async (angleValue,id) => {
            for (let i of rotationValues) {
                if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
                    finalValue.innerHTML = `<p>Descuento: ${i.value}</p>`;
                    await activarCodigo(id);
                    spinBtn.disabled = false;
                    break;
                }
            }
        };
        async function activarCodigo(id) {
            const data = new FormData();
            data.append('id', id);
            const url = `${location.origin}/api/a27647d858aa93c09fc6a365b9054742`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            resultado = await response.json();
        }
        let count = 0;
        let resultValue = 101;
        spinBtn.addEventListener("click", () => {
            Swal.fire({
                title: "INGRESE EL CODIGO",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Validar",
                showLoaderOnConfirm: true,
                confirmButtonColor: "#f8ce4d",
                cancelButtonText: 'Cancelar',
                preConfirm: async (code) => {
                    try {
                        const data = new FormData();
                        data.append('code', code);
                        const url = `${location.origin}/api/ca9cfb11a71112c25d9e5de085a6217b`;
                        const response = await fetch(url, {
                            method: 'POST',
                            body: data
                        });
                        resultado = await response.json();
                    } catch (error) {
                        
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(() => {
                if(resultado.length > 0 && resultado[0].activado == 0) {
                    Swal.fire({
                        title: `A GIRAR`,
                        confirmButtonColor: "#f8ce4d",
                    }).then(() => {
                        spinBtn.disabled = true;
                        finalValue.innerHTML = `<p>¡Buena Suerte!</p>`;
                        let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
                        if(resultado[0].descuento != -1) {
                            const objetoEncontrado = rotationValues.find(obj => obj.value === resultado[0].descuento);
                            randomDegree = Math.floor(Math.random() * (objetoEncontrado.maxDegree - objetoEncontrado.minDegree + 1)) + objetoEncontrado.minDegree;
                        }
                        let rotationInterval = window.setInterval(() => {
                            myChart.options.rotation = myChart.options.rotation + resultValue;
                            myChart.update();
                            if (myChart.options.rotation >= 360) {
                                count += 1;
                                resultValue -= 5;
                                myChart.options.rotation = 0;
                            } else if (count > 15 && myChart.options.rotation == randomDegree) {
                                valueGenerator(randomDegree,resultado[0].id);
                                clearInterval(rotationInterval);
                                count = 0;
                                resultValue = 101;
                            }
                        }, 10);
                    });
                } else if (resultado.length > 0 && resultado[0].activado == 1) {
                    Swal.fire({
                        title: `Codigo ya canjeado`,
                        confirmButtonColor: "#f8ce4d"
                    });
                } else {
                    Swal.fire({
                        title: `ERROR`,
                        confirmButtonColor: "#f8ce4d",
                    });
                }
            });
        });
        </script>