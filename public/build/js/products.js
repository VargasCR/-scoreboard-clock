
const costosDeEnvio = [
    {codigo: '1',precio: 2000, nombre: 'Heredia'},
    {codigo: '2',precio: 2000, nombre: 'Guanacaste'},
    {codigo: '3',precio: 2000, nombre: 'San José'},
    {codigo: '4',precio: 2000, nombre: 'Alajuela'},
    {codigo: '5',precio: 2000, nombre: 'Limón'},
    {codigo: '6',precio: 2000, nombre: 'Cartago'},
    {codigo: '7',precio: 2000, nombre: 'Puntarenas'}
]

let btnSelected = 'btn-nav-0';
const paginaProductosCantidad = 4;
let paginaActual = 1;
let cantidadDeProductos = 0;
let cantidadDePaginas = 0;
let buscandoCategoria = '0';
let carritoDeCompras = [];
let showingImgModal = 0;
let productos=[];
function isMobileDevice() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  }
function eliminarPrincipalEditSlot(indice,item,event) {
    event.preventDefault();
    const index = indice;
    const img = item;
    var slotAEliminar = document.getElementById(indice);
    imagenesAEliminar.push(item);
    document.querySelector('#imagenesEliminar').value = imagenesAEliminar;
    if (slotAEliminar) {
        slotAEliminar.remove();
    }

}

function changeSize(x) {
    const tallas = document.querySelectorAll('.talla-button');
    tallas.forEach(talla => {
        talla.classList.remove('talla-button-selected');
    });
    document.querySelector('#t-'+x).classList.add('talla-button-selected');
    document.querySelector('#talla-id').value = x;
}

function changeColor(x,img) {
    showingImgModal = 0;
    const colores = document.querySelectorAll('.color-button');
    colores.forEach(color => {
        color.classList.remove('color-button-selected');
    });
    document.querySelector('#c-'+x).classList.add('color-button-selected');
    document.querySelector('#color-id').value = x;
    document.querySelector('#image-id').value = JSON.parse(img)[showingImgModal];
    document.querySelector('#imgs-url').value = img;
    document.querySelector('#img-show-product').src = '/images/'+JSON.parse(img)[showingImgModal];
    if(JSON.parse(img).length > 1) {
        document.querySelectorAll('.botonArrow').forEach(element => {
            element.classList.remove('hidden');
        });
    } else {
        document.querySelectorAll('.botonArrow').forEach(element => {
            element.classList.add('hidden');
        });
    }
}

async function filtrarPorCategoria(categoria,tipo,aurum) {
    if(document.querySelector('#page-category').value == 1) {
        if(categoria == '0') {
            const data = new FormData();
            data.append('class', categoria);
            data.append('tipo', tipo);
            data.append('aurum', aurum);
            const url = `${location.origin}/api/find-products`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const productos = await response.json();
            return productos;
        } else {
            const data = new FormData();
            data.append('class', '0');
            data.append('categoria', categoria);
            data.append('tipo', tipo);
            const url = `${location.origin}/api/find-products`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            return await response.json();
        }
    } else if(document.querySelector('#page-category').value == 2){
        if(categoria == '0') {
            const data = new FormData();
            data.append('class', '1');
            const url = `${location.origin}/api/find-products`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const productsAurumL = await response.json();
            return productsAurumL;
        } else {
            const data = new FormData();
            data.append('class', '1');
            data.append('categoria', categoria);
            const url = `${location.origin}/api/find-products`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const productsAurumL = await response.json();
            return productsAurumL.filter(producto => producto.category == categoria);
        }
    }
}

let mostrandoProducto = [];

async function showFloatingWindow(cod) {
    document.querySelector('#product-id').value = cod;
    const coloresContainer = document.querySelector('#colores-container');
    const tallaContainer = document.querySelector('#tallas-container');
    const precioContainer = document.querySelector('#precio-container');
    const descContainer = document.querySelector('#desc-container');
    const data = new FormData();
    data.append('id', cod);
    const url = `${location.origin}/api/find-product`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    const producto = await response.json();
    mostrandoProducto = producto;
    if(producto.descuento == '1') {
        const imgTag = document.querySelector('#imgTag').classList.remove('hidden');
    } else {  
        const imgTag = document.querySelector('#imgTag').classList.add('hidden');
    }
    const descriptions = JSON.parse(producto.desc);
    await limpiarProductoTallaColor();
    document.querySelector('#img-show-product').src = '/images/' + JSON.parse(producto.imagen)[0];
    if(JSON.parse(producto.imagen).length > 1) {
        document.querySelectorAll('.botonArrow').forEach(element => {
            element.classList.remove('hidden');
        });
    } else {
        document.querySelectorAll('.botonArrow').forEach(element => {
            element.classList.add('hidden');
        });
    }
    const textoPrecio = document.createElement('P');
    precioContainer.appendChild(textoPrecio);
    textoPrecio.textContent = '₡'+producto.precio;
    JSON.parse(producto.desc).forEach(text => {
        const textoDesc = document.createElement('P');
        textoDesc.textContent = text;
        descContainer.appendChild(textoDesc);
    });
    JSON.parse(producto.colores).forEach(function (color, index) {
        const button = document.createElement('button');
        button.className = 'color-button';
        button.id = 'c-'+index;
        button.style.backgroundColor = color.rgb;
        button.onclick = function () {
            changeColor(index,JSON.stringify(color.imagen));
        };
        coloresContainer.appendChild(button);
    });
    JSON.parse(producto.tallas).forEach(function (talla, index) {
        const button = document.createElement('button');
        button.className = 'talla-button';
        button.id = 't-'+index;
        button.textContent = talla;
        button.style.margin = '0';
        button.onclick = function () {
            changeSize(index);
        };
        tallaContainer.appendChild(button);
    });
    document.querySelector('#myModal').style.opacity = 0;
    document.querySelector('#myModal').style.display = 'flex';
    setTimeout(() => {
        document.querySelector('#myModal').classList.add('fadeEaseIn');
        document.querySelector('#myModal').style.opacity = 1;
    }, 300);
}

function agregarLabelYInput(contenedor, labelText, inputName) {
    var label = document.createElement("label");
    label.setAttribute("for", inputName);
    label.textContent = labelText;
    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", inputName);
    input.setAttribute("name", inputName + "[]");
    input.setAttribute("placeholder", labelText + " del producto");
    input.setAttribute("value", "");
    input.style.margin = "0.5rem 0 0 0";
    contenedor.appendChild(label);
    contenedor.appendChild(input);
}

let coloresAgregados = [];
let conteoDeColores = 0;

function encontrarTotalColores() {
    conteoDeColores = document.querySelector('#cantColores').value;
}

let imageJsonCount = 1;

function agregarColor(event) {
    event.preventDefault();
    conteoDeColores++;
    coloresAgregados.push(conteoDeColores);
    var nuevoSlot = document.createElement("div");
    nuevoSlot.id = 'c-'+conteoDeColores;
    nuevoSlot.classList.add("slot");
    nuevoSlot.style.backgroundColor = "#eaeaea";
    nuevoSlot.style.padding = "1rem";
    nuevoSlot.style.margin = "1rem 0 0 0";
    var deleteSlot = document.createElement("div");
    deleteSlot.style.width = '100%';
    deleteSlot.style.textAlign = 'right';
    var eliminarBoton = document.createElement("button");
    eliminarBoton.textContent = "X";
    eliminarBoton.style.margin = "0.5rem 0 0 0";
    eliminarBoton.value = conteoDeColores;
    eliminarBoton.addEventListener("click", function(event) {
        event.preventDefault();
        eliminarSlot(this.value,event);
    });
    deleteSlot.appendChild(eliminarBoton);
    nuevoSlot.appendChild(deleteSlot);
    agregarLabelYInput(nuevoSlot, "Nombre del color", "color");
    agregarLabelYInput(nuevoSlot, "Color en formato rgb", "rgb");
    var labelImagen = document.createElement("label");
    labelImagen.setAttribute("for", "imagenColor");
    labelImagen.textContent = "Imagen del producto";
    var inputImagen = document.createElement("input");
    inputImagen.setAttribute("type", "file");
    inputImagen.setAttribute("class", "imagenColor");
    inputImagen.setAttribute("name", "imagenColor_"+imageJsonCount+"[]");
    inputImagen.setAttribute("value", imageJsonCount);
    var colorFileCountValue = document.querySelector('#colorFileCount').value;
    var nuevoElemento = 'nuevoElemento';
    if(colorFileCountValue != '') {
        var nuevoValor = colorFileCountValue + ',' + imageJsonCount;
    } else {
        var nuevoValor = imageJsonCount;
    }
    document.querySelector('#colorFileCount').value = nuevoValor;
    inputImagen.setAttribute("accept", "image/*");
    inputImagen.multiple = true;
    imageJsonCount++;
    nuevoSlot.appendChild(labelImagen);
    nuevoSlot.appendChild(inputImagen);
    document.getElementById("colores-contenedor").appendChild(nuevoSlot);
}

function eliminarSlot(slotId,event) {
    event.preventDefault();
    var colorFileCountValue = document.querySelector('#colorFileCount').value;
    var arrayDeValores = colorFileCountValue.split(',');
    var index = arrayDeValores.indexOf(slotId.toString());
    if (index !== -1) {
        arrayDeValores.splice(index, 1);
    }
    document.querySelector('#colorFileCount').value = arrayDeValores.join(',');
    var slotAEliminar = document.getElementById('c-' + slotId);
    if (slotAEliminar) {
        slotAEliminar.remove();
    }
}

let imagenesAEliminar = [];
let coloresAEliminar = [];
function eliminarEditSlot(slotId,event,values,index) {
    event.preventDefault();
    const valuesArray = values.split(', ');
    valuesArray.forEach(element => {
        imagenesAEliminar.push(element);
    });
    coloresAEliminar.push(index);
    var slotAEliminar = document.getElementById(slotId);
    document.querySelector('#imagenesEliminar').value = JSON.stringify(imagenesAEliminar);
    document.querySelector('#IndexColoresEliminar').value = coloresAEliminar;
    if (slotAEliminar) {
        slotAEliminar.remove();
    }
}

async function agregarAlCarrito() {
    document.querySelector('#myModal').style.zIndex = '100';
    let encontrado = false;
    const codigo = document.querySelector('#product-id').value;
    const talla = document.querySelector('#talla-id').value;
    const color = document.querySelector('#color-id').value;
    const imagen = document.querySelector('#image-id').value;
    if(codigo == '-1') {
        Swal.fire({
            title: "Error al seleccionar el producto",
            text: "",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
        }).then((result) => {
            document.querySelector('#myModal').style.zIndex = '999999';
        });
        return;
    }
    if(talla == '-1') {
        Swal.fire({
            title: "Seleccione la Talla",
            text: "",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
        }).then((result) => {
            document.querySelector('#myModal').style.zIndex = '999999';
        });
        return;
    }
    if(color == '-1') {
        Swal.fire({
            title: "Seleccione el Color",
            text: "",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
        }).then((result) => {
            document.querySelector('#myModal').style.zIndex = '999999';
        });
        return;
    }
    carritoDeCompras.find(function(product) {
        if (product.codigo === codigo
            && product.talla === talla
            && product.color === color) {
                const indiceOriginal = carritoDeCompras.indexOf(product);
                product.cantidad = (product.cantidad || 0) + 1;
                carritoDeCompras.splice(indiceOriginal, 1);
                carritoDeCompras.splice(indiceOriginal, 0, product);
                localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                encontrarProductosEnCarrito();
                encontrado = true;
                Swal.fire({
                    title: "Agregado +1",
                    text: 'CANTIDAD: '+product.cantidad,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    document.querySelector('#myModal').style.zIndex = '999999';
                });;
                return;
        }
    });
    const data = new FormData();
    data.append('id', codigo);
    const url = `${location.origin}/api/find-product`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    const producto = await response.json();
    if(producto != null && encontrado == false) {
        producto.cantidad = 1;
        producto.color = color;
        producto.talla = talla;
        producto.imagen = imagen;
        carritoDeCompras.push(producto);
        localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
        encontrarProductosEnCarrito();
        Swal.fire({
            title: "Agregado",
            text: "",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
        }).then((result) => {
            document.querySelector('#myModal').style.zIndex = '999999';
        });;
        return;
    }
}

function encontrarProductosEnCarrito() {
    let datosGuardados = localStorage.getItem('carritoDeComprasLista');
    let datosRecuperados = JSON.parse(datosGuardados);
    try {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('9b2360ed757cd74b6b21eff645f7522e');
        if(id == 'b326b5062b2f0e69046810717534cb09') {
            carritoDeCompras = [];
            localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
            window.location.href = window.location.origin;
            return;
        }
    } catch (error) {
        
    }
    if(datosRecuperados != null) {
        carritoDeCompras = datosRecuperados;
    } else {
        datosRecuperados = [];
        carritoDeCompras = [];
    }
    if(datosRecuperados.length > 0) {
        document.querySelector('#floating-cart-btn').classList.remove('hidden')
    } else {
        document.querySelector('#floating-cart-btn').classList.add('hidden')
    }
}

function encontrarProductoPorCodigo(codigo) {
    let productosSeleccionados = [];
    if(document.querySelector('#page-category').value == 1 || document.querySelector('#page-category').value == 0) {
        var productoEncontrado = products.find(function(producto) {
            return producto.codigo === codigo;
        });
    } else if(document.querySelector('#page-category').value == 2){
        var productoEncontrado = productsAurum.find(function(producto) {
            return producto.codigo === codigo;
        });
    }
    return productoEncontrado;
}

function closeOnOutsideClick(event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeFloatingWindow();
    }
}

function closeFloatingWindow() {
    const modal = document.querySelector('#myModal');
    document.querySelector('#product-id').value = '-1';
    document.querySelector('#talla-id').value = '-1';
    document.querySelector('#color-id').value = '-1';
    document.querySelector('#image-id').value = '-1';
    setTimeout(() => {
        modal.classList.remove('fadeEaseIn');
        modal.classList.add('fadeEase');
        modal.style.opacity = 0;
    }, 300);
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
}

let originalBodyOverflow = null;
let showingProductIndex = 0;

function nextNewProduct() {
    console.log(showingProductIndex);
    document.querySelectorAll('.productContainerNew')[showingProductIndex].classList.add('hidden');
    showingProductIndex++;
    if(showingProductIndex > document.querySelectorAll('.productContainerNew').length-1) {
        showingProductIndex = 0;
    }
    document.querySelectorAll('.productContainerNew')[showingProductIndex].classList.remove('hidden');
}

function prevNewProduct() {
    document.querySelectorAll('.productContainerNew')[showingProductIndex].classList.add('hidden');
    showingProductIndex--;
    if(showingProductIndex < 0) {
        showingProductIndex = document.querySelectorAll('.productContainerNew').length-1;
    }
    document.querySelectorAll('.productContainerNew')[showingProductIndex].classList.remove('hidden');
}

async function createProduct() {
    let countItem = 0;
    const url = `${location.origin}/api/lastest-products`;
    const response = await fetch(url, {
        method: 'POST',
    });
    const result = await response.json();
    if (isMobileDevice()) {
        document.querySelector('#carouselx').classList.add('hidden');
        document.querySelector('#carouselx-controls').classList.add('hidden');
        result.forEach((product,index) => {
            const productContainer = document.createElement("div");
            productContainer.classList.add('productContainerNew');
            const productItem = document.createElement("div");
            productItem.className = "product-item";
            productItem.style.margin = "0.5rem";
            productItem.id = 'p-'+product.codigo;
            productItem.value = 0;
            productItem.setAttribute('showingImg', 0);
            const contenedorImagen = document.createElement("div");
            contenedorImagen.id = "contenedorImagen";
            const contenedorBotones = document.createElement("div");
            contenedorBotones.id = "contenedorBotones";
            const botonIzquierdo = document.createElement("button");
            botonIzquierdo.className = "botonArrow";
            botonIzquierdo.innerHTML = "<span class='material-symbols-outlined'>chevron_left</span>";
            botonIzquierdo.onclick = function() {
                cambiarImagen(event,product.codigo,product.imagen,0);
            };
            const botonDerecho = document.createElement("button");
            botonDerecho.innerHTML = "<span class='material-symbols-outlined'>chevron_right</span>";
            botonDerecho.className = "botonArrow";
            botonDerecho.onclick = function() {
                cambiarImagen(event,product.codigo,product.imagen,1);
            };
            if(JSON.parse(product.imagen).length > 1) {
                contenedorBotones.appendChild(botonIzquierdo);
                contenedorBotones.appendChild(botonDerecho);
            }
            const imagenPrincipal = document.createElement("img");
            imagenPrincipal.src = "/images/" + JSON.parse(product.imagen)[0];
            imagenPrincipal.alt = "";
            imagenPrincipal.id = 'img-'+product.codigo;
            const previewBoton = document.createElement("button");
            previewBoton.style.width = '3rem';
            previewBoton.style.height = '3rem';
            previewBoton.style.backgroundColor = 'transparent';
            previewBoton.style.position = 'absolute';
            previewBoton.style.top = '0';
            previewBoton.style.right = '50%';
            previewBoton.style.border = 'none';
            previewBoton.classList.add('previewBoton');
            previewBoton.src = "/images/" + JSON.parse(product.imagen)[0];
            const previewIMG = document.createElement("img");
            previewIMG.src = "/build/img/preview.png";
            previewBoton.appendChild(previewIMG);
            previewBoton.onclick = function(){
                const modal = document.getElementById("myModal-modal");
                const modalImg = document.getElementById("myModal-img");
                modal.style.display = "block";
                modalImg.src = this.src;
                originalBodyOverflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
                imageZoom("myModal-img", "myresult");
            }
            contenedorImagen.appendChild(previewBoton);
            contenedorImagen.appendChild(contenedorBotones);
            contenedorImagen.appendChild(imagenPrincipal);
            if(product.descuento == '1') {
                const imgDiscount = document.createElement('img');
                imgDiscount.src = '/build/img/discount-tag.png';
                imgDiscount.classList.add('imgTag');
                contenedorImagen.appendChild(imgDiscount);
            }
            const downContent = document.createElement("div");
            downContent.className = "down-content";
            const productName = document.createElement("h4");
            productName.style.textAlign = "left";
            productName.style.fontSize = "16px";
            productName.textContent = product.titulo;
            const priceContainer = document.createElement("div");
            priceContainer.style.display = "flex";
            priceContainer.style.justifyContent = "space-between";
            priceContainer.style.alignItems = "center";
            const productPrice = document.createElement("h6");
            productPrice.style.margin = "0 !important";
            productPrice.textContent = '₡' + product.precio;
            productPrice.style.fontSize = '14px';
            const addToCartButton = document.createElement("div");
            addToCartButton.className = "buttonadd";
            addToCartButton.onclick = function() {
                showFloatingWindow(product.codigo);
            };
            const buttonWrapper = document.createElement("div");
            buttonWrapper.className = "button-wrapper";
            const textDiv = document.createElement("div");
            textDiv.className = "text";
            textDiv.textContent = "🛒";
            textDiv.onclick = function() {
                showFloatingWindow(product.codigo);
            };
            const iconSpan = document.createElement("span");
            iconSpan.className = "icon";
            const pTag = document.createElement("p");
            pTag.style.color = "white";
            pTag.textContent = "AGREGAR";
            pTag.style.margin = "0px";
            pTag.style.fontSize = '8px';
            iconSpan.appendChild(pTag);
            buttonWrapper.appendChild(textDiv);
            buttonWrapper.appendChild(iconSpan);
            addToCartButton.appendChild(buttonWrapper);
            priceContainer.appendChild(productPrice);
            priceContainer.appendChild(addToCartButton);
            downContent.appendChild(productName);
            downContent.appendChild(priceContainer);
            productItem.appendChild(contenedorImagen);
            productItem.appendChild(downContent);
            if(index != 0) {
                productContainer.classList.add('hidden');
            }
            productContainer.appendChild(productItem);
            const productsContainer = document.querySelector("#products-container");
            productsContainer.appendChild(productContainer);
        });
    } else {
        document.querySelector('#products-container').classList.add('hidden');
        document.querySelector('#products-controls').classList.add('hidden');
        result.forEach(product => {
            const productContainerSlider = document.createElement("div");
            productContainerSlider.classList.add('carouselx--item');
            productContainerSlider.classList.add('carouselxItem');
            const productContainer = document.createElement("div");
            productContainer.classList.add('productContainerNew');
            const productItem = document.createElement("div");
            productItem.className = "product-item";
            productItem.style.margin = "0.5rem";
            productItem.id = 'p-'+product.codigo;
            productItem.value = 0;
            productItem.setAttribute('showingImg', 0);
            const contenedorImagen = document.createElement("div");
            contenedorImagen.id = "contenedorImagen";
            const contenedorBotones = document.createElement("div");
            contenedorBotones.id = "contenedorBotones";
            const botonIzquierdo = document.createElement("button");
            botonIzquierdo.className = "botonArrow";
            botonIzquierdo.innerHTML = "<span class='material-symbols-outlined'>chevron_left</span>";
            botonIzquierdo.onclick = function() {
                cambiarImagen(event,product.codigo,product.imagen,0);
            };
            const botonDerecho = document.createElement("button");
            botonDerecho.innerHTML = "<span class='material-symbols-outlined'>chevron_right</span>";
            botonDerecho.className = "botonArrow";
            botonDerecho.onclick = function() {
                cambiarImagen(event,product.codigo,product.imagen,1);
            };
            if(JSON.parse(product.imagen).length > 1) {
                contenedorBotones.appendChild(botonIzquierdo);
                contenedorBotones.appendChild(botonDerecho);
            }
            const imagenPrincipal = document.createElement("img");
            imagenPrincipal.src = "/images/" + JSON.parse(product.imagen)[0];
            imagenPrincipal.alt = "";
            imagenPrincipal.id = 'img-'+product.codigo;
            const previewBoton = document.createElement("button");
            previewBoton.style.width = '3rem';
            previewBoton.style.height = '3rem';
            previewBoton.style.backgroundColor = 'transparent';
            previewBoton.style.position = 'absolute';
            previewBoton.style.top = '0';
            previewBoton.style.right = '50%';
            previewBoton.style.border = 'none';
            previewBoton.classList.add('previewBoton');
            previewBoton.src = "/images/" + JSON.parse(product.imagen)[0];
            const previewIMG = document.createElement("img");
            previewIMG.src = "/build/img/preview.png";
            previewBoton.appendChild(previewIMG);
            previewBoton.onclick = function(){
                const modal = document.getElementById("myModal-modal");
                const modalImg = document.getElementById("myModal-img");
                modal.style.display = "block";
                modalImg.src = this.src;
                originalBodyOverflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
                imageZoom("myModal-img", "myresult");
            }
            contenedorImagen.appendChild(previewBoton);
            contenedorImagen.appendChild(contenedorBotones);
            contenedorImagen.appendChild(imagenPrincipal);
            if(product.descuento == '1') {
                const imgDiscount = document.createElement('img');
                imgDiscount.src = '/build/img/discount-tag.png';
                imgDiscount.classList.add('imgTag');
                contenedorImagen.appendChild(imgDiscount);
            }
            const downContent = document.createElement("div");
            downContent.className = "down-content";
            const productName = document.createElement("h4");
            productName.style.textAlign = "left";
            productName.style.fontSize = "16px";
            productName.textContent = product.titulo;
            const priceContainer = document.createElement("div");
            priceContainer.style.display = "flex";
            priceContainer.style.justifyContent = "space-between";
            priceContainer.style.alignItems = "center";
            const productPrice = document.createElement("h6");
            productPrice.style.margin = "0 !important";
            productPrice.textContent = '₡' + product.precio;
            productPrice.style.fontSize = '14px';
            const addToCartButton = document.createElement("div");
            addToCartButton.className = "buttonadd";
            addToCartButton.onclick = function() {
                showFloatingWindow(product.codigo);
            };
            const buttonWrapper = document.createElement("div");
            buttonWrapper.className = "button-wrapper";
            const textDiv = document.createElement("div");
            textDiv.className = "text";
            textDiv.textContent = "🛒";
            textDiv.onclick = function() {
                showFloatingWindow(product.codigo);
            };
            const iconSpan = document.createElement("span");
            iconSpan.className = "icon";
            const pTag = document.createElement("p");
            pTag.style.color = "white";
            pTag.textContent = "AGREGAR";
            pTag.style.margin = "0px";
            pTag.style.fontSize = '8px';
            iconSpan.appendChild(pTag);
            buttonWrapper.appendChild(textDiv);
            buttonWrapper.appendChild(iconSpan);
            addToCartButton.appendChild(buttonWrapper);
            priceContainer.appendChild(productPrice);
            priceContainer.appendChild(addToCartButton);
            downContent.appendChild(productName);
            downContent.appendChild(priceContainer);
            productItem.appendChild(contenedorImagen);
            productItem.appendChild(downContent);
            productContainer.appendChild(productItem);
            productContainerSlider.appendChild(productContainer);
            const productsContainer = document.querySelector("#products-containerx");
            productsContainer.appendChild(productContainerSlider);
        });
    }
    encontrarProductosEnCarrito();
    hiddeNewProducts();
}

function imageZoom(imgID, resultID) {
    var img, lens, result, cx, cy;
    img = document.getElementById(imgID);
    result = document.getElementById(resultID);
    lens = document.createElement("DIV");
    lens.setAttribute("class", "img-zoom-lens");
    img.parentElement.insertBefore(lens, img);
    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;
    result.style.backgroundImage = "url('" + img.src + "')";
    result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
    lens.addEventListener("mousemove", moveLens);
    img.addEventListener("mousemove", moveLens);
    lens.addEventListener("touchmove", moveLens);
    img.addEventListener("touchmove", moveLens);
    function moveLens(e) {
      var pos, x, y;
      e.preventDefault();
      pos = getCursorPos(e);
      x = pos.x - (lens.offsetWidth / 2);
      y = pos.y - (lens.offsetHeight / 2);
      if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
      if (x < 0) {x = 0;}
      if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
      if (y < 0) {y = 0;}
      lens.style.left = x + "px";
      lens.style.top = y + "px";
      result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
    }
    function getCursorPos(e) {
      var a, x = 0, y = 0;
      e = e || window.event;
      a = img.getBoundingClientRect();
      x = e.pageX - a.left;
      y = e.pageY - a.top;
      x = x - window.pageXOffset;
      y = y - window.pageYOffset;
      return {x : x, y : y};
    }
}

function closeModalImg() {
    const modal = document.getElementById("myModal-modal");
    modal.style.display = "none";
    document.body.style.overflow = originalBodyOverflow;
}

function limpiarProductos(products) {
    products.forEach(element => {
        element.remove();
    });
}

function encontrarProductos() {
    const items = document.querySelectorAll('.productContainer');
    items.forEach(element => {
        element.style.opacity = '0';
    });
    return items;
}

function limpiarProductoTallaColor() {
    const colorContainer = document.querySelector('#colores-container');
    const tallaContainer = document.querySelector('#tallas-container');
    const precioContainer = document.querySelector('#precio-container');
    const descContainer = document.querySelector('#desc-container');
    while (colorContainer.firstChild) {
        colorContainer.removeChild(colorContainer.firstChild);
    }
    while (tallaContainer.firstChild) {
        tallaContainer.removeChild(tallaContainer.firstChild);
    }
    while (descContainer.firstChild) {
        descContainer.removeChild(descContainer.firstChild);
    }
    while (precioContainer.firstChild) {
        precioContainer.removeChild(precioContainer.firstChild);
    }
}

function limpiarProductosCarrito() {
    const productsContainer = document.querySelector('#shopping-cart-products-container');
    while (productsContainer.firstChild) {
        productsContainer.removeChild(productsContainer.firstChild);
    }
}

function cambiarCategoria(w,t,g) {
    btnSelected = 'btn-nav-0';
    let btnCount = 1;
    document.querySelectorAll('.btn-nav-number').forEach(element => {
        element.innerText = btnCount;
        btnCount++;
    });
    buscandoCategoria = w;
    paginaActual = 1;
    cantidadDeProductos = 0;
    cantidadDePaginas = 0;
    document.querySelector('#select-text').textContent = `${t}`;
    document.querySelector('#select-simbol').innerHTML= `&#9660;`;
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    document.getElementById('btn-nav-0').classList.add('btn-nav-active');
    var urlString = window.location.href;
    var url = new URL(urlString);
    var params = new URLSearchParams(url.search);
    var param1Value = params.get("ea170e2cafb1337755c8b3d5ae4437f4");
    if(param1Value != null) {

    }
    var newSearchParams = "?ea170e2cafb1337755c8b3d5ae4437f4="+w;
    var pathname = window.location.pathname;
    var hash = window.location.hash;
    history.pushState(null, "", pathname + newSearchParams.toString() + hash);
    toggleOptions(t);
    buscar(w,g);
}

try {
    if (document.querySelector('#selecter-used').value == '3') {
        var optionsContainer = document.getElementById('optionsContainer');
        var isOpen = false;
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.custom-select-container')) {
                isOpen = false;
                if(optionsContainer != null) {
                    optionsContainer.style.display = 'none'; 
                }
                document.querySelector('#custom-select-container').style.position = 'unset';
            }
        });
    }
} catch (error) {

}

function toggleOptions(t) {
    isOpen = !isOpen;
    optionsContainer.style.display = isOpen ? 'inline-table' : 'none'; 
    if (t != null) {
        document.querySelector('#select-text').textContent = `${t}`;
    }
    if (isOpen) {
        document.querySelector('#select-simbol').innerHTML = `&#9650;`;
        document.querySelector('#custom-select-container').style.position = 'relative';
    } else {
        document.querySelector('#select-simbol').innerHTML = `&#9660;`;
        document.querySelector('#custom-select-container').style.position = 'unset';
    }
}

async function buscar(w) {
    const productsItems = encontrarProductos();
    const productosFiltrados = w;
    cantidadDeProductos = productosFiltrados.length;
    cantidadDeProductos = productosFiltrados.length;
    cantidadDePaginas = cantidadDeProductos / 4;
    document.querySelector('#btn-nav-2').classList.remove('hidden');
    if(cantidadDePaginas <= 1){
        document.querySelector('#navegation-products').classList.add('hidden');
    } else if(cantidadDePaginas <= 2 && cantidadDePaginas > 1) {
        document.querySelector('#btn-nav-2').classList.add('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    } else {
        document.querySelector('#btn-nav-2').classList.remove('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    }
    let productosSeleccionados = [];
    const indexDesde = (4 * paginaActual) - 4;
    const indexHasta = 4 * paginaActual;
    productosSeleccionados = productosFiltrados.slice(indexDesde, indexHasta);
    if (w == '0') {

    } else if(cantidadDeProductos == 0) {
        const textoVacio = document.createElement("h3");
        textoVacio.textContent = 'No hay resultados';
        textoVacio.style.textAlign = 'center';
        textoVacio.classList.add('productContainer');
        const productsContainer = document.querySelector("#products-containerx");
        productsContainer.appendChild(textoVacio);
        await limpiarProductos(productsItems);
        return;
    }
    productosSeleccionados.forEach(product => {
        const productContainer = document.createElement("div");
        productContainer.classList.add('productContainer');
        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.style.margin = "0.5rem";
        productItem.id = 'p-'+product.codigo;
        productItem.value = 0;
        productItem.setAttribute('showingImg', 0);
        const contenedorImagen = document.createElement("div");
        contenedorImagen.id = "contenedorImagen";
        const contenedorBotones = document.createElement("div");
        contenedorBotones.id = "contenedorBotones";
        const botonIzquierdo = document.createElement("button");
        botonIzquierdo.className = "botonArrow";
        botonIzquierdo.innerHTML = "<span class='material-symbols-outlined'>chevron_left</span>";
        botonIzquierdo.onclick = function() {
            cambiarImagen(event,product.codigo,product.imagen,0);
        };
        const botonDerecho = document.createElement("button");
        botonDerecho.innerHTML = "<span class='material-symbols-outlined'>chevron_right</span>";
        botonDerecho.className = "botonArrow";
        botonDerecho.onclick = function() {
            cambiarImagen(event,product.codigo,product.imagen,1);
        };
        if(JSON.parse(product.imagen).length > 1) {
            contenedorBotones.appendChild(botonIzquierdo);
            contenedorBotones.appendChild(botonDerecho);
        }
        const imagenPrincipal = document.createElement("img");
        imagenPrincipal.src = "/images/" + JSON.parse(product.imagen)[0];
        imagenPrincipal.alt = "";
        imagenPrincipal.id = 'img-'+product.codigo;
        const previewBoton = document.createElement("button");
        previewBoton.style.width = '3rem';
        previewBoton.style.height = '3rem';
        previewBoton.style.backgroundColor = 'transparent';
        previewBoton.style.position = 'absolute';
        previewBoton.style.top = '0';
        previewBoton.style.right = '50%';
        previewBoton.style.border = 'none';
        previewBoton.classList.add('previewBoton');
        previewBoton.src = "/images/" + JSON.parse(product.imagen)[0];
        const previewIMG = document.createElement("img");
        previewIMG.src = "/build/img/preview.png";
        previewBoton.appendChild(previewIMG);
        previewBoton.onclick = function(){
            const modal = document.getElementById("myModal-modal");
            const modalImg = document.getElementById("myModal-img");
            modal.style.display = "block";
            modalImg.src = this.src;
            originalBodyOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            imageZoom("myModal-img", "myresult");
        }
        contenedorImagen.appendChild(previewBoton);
        contenedorImagen.appendChild(contenedorBotones);
        contenedorImagen.appendChild(imagenPrincipal);
        const downContent = document.createElement("div");
        downContent.className = "down-content";
        const productName = document.createElement("h4");
        productName.style.textAlign = "left";
        productName.style.fontSize = "16px";
        productName.textContent = product.titulo;
        const priceContainer = document.createElement("div");
        priceContainer.style.display = "flex";
        priceContainer.style.justifyContent = "space-between";
        priceContainer.style.alignItems = "center";
        const productPrice = document.createElement("h6");
        productPrice.style.margin = "0 !important";
        productPrice.textContent = '₡' + product.precio;
        productPrice.style.fontSize = '14px';
        const addToCartButton = document.createElement("div");
        addToCartButton.className = "buttonadd";
        addToCartButton.onclick = function() {
            showFloatingWindow(product.codigo);
        };
        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper";
        const textDiv = document.createElement("div");
        textDiv.className = "text";
        textDiv.textContent = "🛒";
        textDiv.onclick = function() {
            showFloatingWindow(product.codigo);
        };
        const iconSpan = document.createElement("span");
        iconSpan.className = "icon";
        const pTag = document.createElement("p");
        pTag.style.color = "white";
        pTag.textContent = "AGREGAR";
        pTag.style.margin = "0px";
        pTag.style.fontSize = '8px';
        iconSpan.appendChild(pTag);
        buttonWrapper.appendChild(textDiv);
        buttonWrapper.appendChild(iconSpan);
        addToCartButton.appendChild(buttonWrapper);
        priceContainer.appendChild(productPrice);
        priceContainer.appendChild(addToCartButton);
        downContent.appendChild(productName);
        downContent.appendChild(priceContainer);
        productItem.appendChild(contenedorImagen);
        productItem.appendChild(downContent);
        productContainer.appendChild(productItem);
        const productsContainer = document.querySelector("#products-containerx");
        productsContainer.appendChild(productContainer);
    });
    await limpiarProductos(productsItems);
    encontrarProductosEnCarrito();
}

async function buscarA(w,t) {
    const productsItems = encontrarProductos();
    const productosFiltrados = await filtrarPorCategoria(w,t,'1');
    cantidadDeProductos = productosFiltrados.length;
    buscandoCategoria = w;
    cantidadDeProductos = productosFiltrados.length;
    cantidadDePaginas = cantidadDeProductos / 4;
    document.querySelector('#btn-nav-2').classList.remove('hidden');
    if(cantidadDePaginas <= 1){
        document.querySelector('#navegation-products').classList.add('hidden');
    } else if(cantidadDePaginas <= 2 && cantidadDePaginas > 1) {
        document.querySelector('#btn-nav-2').classList.add('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    } else {
        document.querySelector('#btn-nav-2').classList.remove('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    }
    let productosSeleccionados = [];
    const indexDesde = (4 * paginaActual) - 4;
    const indexHasta = 4 * paginaActual;
    productosSeleccionados = productosFiltrados.slice(indexDesde, indexHasta);
    if (w == '0') {

    } else if(cantidadDeProductos == 0) {
        const textoVacio = document.createElement("h3");
        textoVacio.textContent = 'No hay resultados';
        textoVacio.style.textAlign = 'center';
        const productsContainer = document.querySelector("#products-containerx");
        productsContainer.appendChild(textoVacio);
        return;
    }
    productosSeleccionados.forEach(product => {
        const productContainer = document.createElement("div");
        productContainer.classList.add('productContainer');
        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.style.margin = "0.5rem";
        productItem.id = 'p-'+product.codigo;
        productItem.value = 0;
        productItem.setAttribute('showingImg', 0);
        const contenedorImagen = document.createElement("div");
        contenedorImagen.id = "contenedorImagen";
        const contenedorBotones = document.createElement("div");
        contenedorBotones.id = "contenedorBotones";
        const botonIzquierdo = document.createElement("button");
        botonIzquierdo.className = "botonArrow";
        botonIzquierdo.innerHTML = "<span class='material-symbols-outlined'>chevron_left</span>";
        botonIzquierdo.onclick = function() {
            cambiarImagen(event,product.codigo,product.imagen,0);
        };
        const botonDerecho = document.createElement("button");
        botonDerecho.innerHTML = "<span class='material-symbols-outlined'>chevron_right</span>";
        botonDerecho.className = "botonArrow";
        botonDerecho.onclick = function() {
            cambiarImagen(event,product.codigo,product.imagen,1);
        };
        if(JSON.parse(product.imagen).length > 1) {
            contenedorBotones.appendChild(botonIzquierdo);
            contenedorBotones.appendChild(botonDerecho);
        }
        const imagenPrincipal = document.createElement("img");
        imagenPrincipal.src = "/images/" + JSON.parse(product.imagen)[0];
        imagenPrincipal.alt = "";
        imagenPrincipal.id = 'img-'+product.codigo;
        const previewBoton = document.createElement("button");
        previewBoton.style.width = '3rem';
        previewBoton.style.height = '3rem';
        previewBoton.style.backgroundColor = 'transparent';
        previewBoton.style.position = 'absolute';
        previewBoton.style.top = '0';
        previewBoton.style.right = '50%';
        previewBoton.style.border = 'none';
        previewBoton.classList.add('previewBoton');
        previewBoton.src = "/images/" + JSON.parse(product.imagen)[0];
        const previewIMG = document.createElement("img");
        previewIMG.src = "/build/img/preview.png";
        previewBoton.appendChild(previewIMG);
        previewBoton.onclick = function(){
            const modal = document.getElementById("myModal-modal");
            const modalImg = document.getElementById("myModal-img");
            modal.style.display = "block";
            modalImg.src = this.src;
            originalBodyOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            imageZoom("myModal-img", "myresult");
        }
        contenedorImagen.appendChild(previewBoton);
        contenedorImagen.appendChild(contenedorBotones);
        contenedorImagen.appendChild(imagenPrincipal);
        const downContent = document.createElement("div");
        downContent.className = "down-content";
        const productName = document.createElement("h4");
        productName.style.textAlign = "left";
        productName.style.fontSize = "16px";
        productName.textContent = product.titulo;
        const priceContainer = document.createElement("div");
        priceContainer.style.display = "flex";
        priceContainer.style.justifyContent = "space-between";
        priceContainer.style.alignItems = "center";
        const productPrice = document.createElement("h6");
        productPrice.style.margin = "0 !important";
        productPrice.textContent = '₡' + product.precio;
        productPrice.style.fontSize = '14px';
        const addToCartButton = document.createElement("div");
        addToCartButton.className = "buttonadd";
        addToCartButton.onclick = function() {
            showFloatingWindow(product.codigo);
        };
        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper";
        const textDiv = document.createElement("div");
        textDiv.className = "text";
        textDiv.textContent = "🛒";
        textDiv.onclick = function() {
            showFloatingWindow(product.codigo);
        };
        const iconSpan = document.createElement("span");
        iconSpan.className = "icon";
        const pTag = document.createElement("p");
        pTag.style.color = "white";
        pTag.textContent = "AGREGAR";
        pTag.style.margin = "0px";
        pTag.style.fontSize = '8px';
        iconSpan.appendChild(pTag);
        buttonWrapper.appendChild(textDiv);
        buttonWrapper.appendChild(iconSpan);
        addToCartButton.appendChild(buttonWrapper);
        priceContainer.appendChild(productPrice);
        priceContainer.appendChild(addToCartButton);
        downContent.appendChild(productName);
        downContent.appendChild(priceContainer);
        productItem.appendChild(contenedorImagen);
        productItem.appendChild(downContent);
        productContainer.appendChild(productItem);
        const productsContainer = document.querySelector("#products-containerx");
        productsContainer.appendChild(productContainer);
    });
    await limpiarProductos(productsItems);
    encontrarProductosEnCarrito();
}

function cambiarImagen(event, codigo, imagenes, clase) {
    event.preventDefault();
    const imgContainer = document.querySelector('#p-' + codigo);
    const imgElmt = document.querySelector('#img-' + codigo);
    let imgIndex = parseInt(imgContainer.getAttribute('showingimg'));
    if (clase == 1) {
        imgIndex++;
        if (JSON.parse(imagenes).length == imgIndex) {
            imgIndex = 0;
        }
    } else {
        imgIndex--;
        if (imgIndex < 0) {
            imgIndex = JSON.parse(imagenes).length - 1;
        }
    }
    imgElmt.style.transition = 'none';
    imgElmt.style.opacity = 0;
    setTimeout(() => {
        document.querySelector('#img-' + codigo).src = "/images/" + JSON.parse(imagenes)[imgIndex];
        imgElmt.style.transition = 'opacity 0.5s ease-in-out';
        imgElmt.style.opacity = 1;
    }, 50);
    imgContainer.setAttribute('showingimg', imgIndex);
}

function cambiarImagenShowing(event, clase) {
    event.preventDefault();
    const cod = document.querySelector('#product-id').value;
    const colorSelected = document.querySelector('#color-id').value;
    if(colorSelected == '-1') {
        if(clase == 1) {
            showingImgModal++;
            if(JSON.parse(mostrandoProducto.imagen).length == showingImgModal) {
                showingImgModal = 0;
            }
        } else {
            showingImgModal--;
            if(showingImgModal < 0) {
                showingImgModal = JSON.parse(mostrandoProducto.imagen).length - 1;
            }
        }
        document.querySelector('#img-show-product').classList.remove('fadeEaseIn');
        document.querySelector('#img-show-product').classList.add('fadeEase');
        document.querySelector('#img-show-product').style.opacity = 0;
        setTimeout(() => {
            document.querySelector('#img-show-product').src = "/images/" +JSON.parse(mostrandoProducto.imagen)[showingImgModal];
        }, 300);
    } else {
        const imgs = JSON.parse(document.querySelector('#imgs-url').value);
        if(clase == 1) {
            showingImgModal++;
            if(imgs.length == showingImgModal) {
                showingImgModal = 0;
            }
        } else {
            showingImgModal--;
            if(showingImgModal < 0) {
                showingImgModal = imgs.length - 1;
            }
        }
        document.querySelector('#img-show-product').classList.remove('fadeEaseIn');
        document.querySelector('#img-show-product').classList.add('fadeEase');
        document.querySelector('#img-show-product').style.opacity = 0; // Inicio de la transición
        setTimeout(() => {
            document.querySelector('#img-show-product').src = "/images/" +imgs[showingImgModal];
        }, 300);
    }
    setTimeout(() => {
        document.querySelector('#img-show-product').classList.remove('fadeEase');
        document.querySelector('#img-show-product').classList.add('fadeEaseIn');
        document.querySelector('#img-show-product').style.opacity = 1;   
    }, 500);
}

async function encontrarPagina(n) {
    if(n == null) {

    }
    paginaActual = document.getElementById(n).value;
    btnSelected = n;
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    document.querySelector('#'+n).classList.add('btn-nav-active');
    if(document.querySelector('#pageindex').value == '1') {
        buscar(productos);
    }
    if(document.querySelector('#pageindex').value == '1.5') {
        buscar(productos);
    }
    if(document.querySelector('#pageindex').value == '2') {
        buscarA(productos);
    }
    var urlString = window.location.href;
    var url = new URL(urlString);
    var params = new URLSearchParams(url.search);
    var param1Value = params.get("89759e1284e2479b991d2669de104942");
    if (param1Value != null) {
        var lastSearchParams = "&89759e1284e2479b991d2669de104942=" + param1Value;
    } else {
        var lastSearchParams = "";
    }
    var newSearchParams = "?4014baac2e585d86e97c81beb778c6c8=" + paginaActual;
    var pathname = window.location.pathname;
    var hash = window.location.hash;
    history.pushState(null, "", pathname + newSearchParams + lastSearchParams + hash);
}

async function siguientePagina() {
    if(paginaActual < cantidadDePaginas) {
        paginaActual++;
        let RestandoValor = 3;
        const nodeList = document.querySelectorAll('.btn-nav-number');
        const arrayButtons = Array.from(nodeList);
        if(paginaActual > 3) {
            arrayButtons.forEach(element => {
                element.value = ((paginaActual - RestandoValor)) + 1;
                element.innerText = ((paginaActual - RestandoValor)) + 1;
                RestandoValor--;
            })
        }
        document.querySelectorAll('.btn-nav').forEach(element => {
            element.classList.remove('btn-nav-active');
        });
        switch (btnSelected) {
            case 'btn-nav-0':
                document.querySelector('#btn-nav-1').classList.add('btn-nav-active');
                btnSelected = 'btn-nav-1';
                break;
            case 'btn-nav-1':
                document.querySelector('#btn-nav-2').classList.add('btn-nav-active');
                btnSelected = 'btn-nav-2';
                break;
            case 'btn-nav-2':
                btnSelected = 'btn-nav-2';
                document.querySelector('#btn-nav-2').classList.add('btn-nav-active');
                break;
            default:
                break;
        }
        if(document.querySelector('#pageindex').value == '1') {
            buscar(productos,'0');
        }
        if(document.querySelector('#pageindex').value == '1.5') {
            buscar(productos,'1');
        }
        if(document.querySelector('#pageindex').value == '2') {
            buscarA(productos);
        }
        var urlString = window.location.href;
        var url = new URL(urlString);
        var params = new URLSearchParams(url.search);
        var param1Value = params.get("89759e1284e2479b991d2669de104942");
        if (param1Value != null) {
            var lastSearchParams = "&89759e1284e2479b991d2669de104942=" + param1Value;
        } else {
            var lastSearchParams = "";
        }
        var newSearchParams = "?4014baac2e585d86e97c81beb778c6c8=" + paginaActual;
        var pathname = window.location.pathname;
        var hash = window.location.hash;
        history.pushState(null, "", pathname + newSearchParams + lastSearchParams + hash);

    }
}

async function retrocederPagina() {
    if(paginaActual > 1) {
        paginaActual--;
    if (btnSelected == 'btn-nav-0') {
        let RestandoValor = 1;
        const nodeList = document.querySelectorAll('.btn-nav-number');
        const arrayButtons = Array.from(nodeList);
        arrayButtons.forEach(element => {
            element.value = (paginaActual - RestandoValor)+1;
            element.innerText = (paginaActual - RestandoValor)+1;
            RestandoValor--;
        })
    }
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    switch (btnSelected) {
        case 'btn-nav-0':
            document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
            btnSelected = 'btn-nav-0';
            break;
        case 'btn-nav-1':
            document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
            btnSelected = 'btn-nav-0';
            break;
        case 'btn-nav-2':
            btnSelected = 'btn-nav-1';
            document.querySelector('#btn-nav-1').classList.add('btn-nav-active');
            break;
        default:
            break;
    }
        if(document.querySelector('#pageindex').value == '1') {

            buscar(productos,'0');
        }
        if(document.querySelector('#pageindex').value == '1.5') {

            buscar(productos,'1');
        }
        if(document.querySelector('#pageindex').value == '2') {

            buscarA(productos);
        }
        var urlString = window.location.href;
        var url = new URL(urlString);
        var params = new URLSearchParams(url.search);
        var param1Value = params.get("89759e1284e2479b991d2669de104942");
        if (param1Value != null) {
            var lastSearchParams = "&89759e1284e2479b991d2669de104942=" + param1Value;
        } else {
            var lastSearchParams = "";
        }
        var newSearchParams = "?4014baac2e585d86e97c81beb778c6c8=" + paginaActual;
        var pathname = window.location.pathname;
        var hash = window.location.hash;
        history.pushState(null, "", pathname + newSearchParams + lastSearchParams + hash);
    }
}

function buscarProductosCart() {
    const shoppingCartProducts = document.getElementById('shopping-cart-products-container');
    limpiarProductosCarrito();
    const datosGuardados = localStorage.getItem('carritoDeComprasLista');
    const datosRecuperados = JSON.parse(datosGuardados);
    carritoDeCompras = datosRecuperados;
    if(carritoDeCompras.length == 0) {
        const vacioTexto = document.createElement('h3');
        vacioTexto.textContent = 'VACÍO';
        vacioTexto.style.textAlign = 'center';
        vacioTexto.style.margin = '3rem 0 0 0';
        shoppingCartProducts.appendChild(vacioTexto);
        encontrarResumen();
        return;
    }
    carritoDeCompras.forEach(item => {
        const article = document.createElement('article');
        article.classList.add('product');
        article.style.opacity = '1';
        const header = document.createElement('header');
        const aRemove = document.createElement('a');
        aRemove.classList.add('remove');
        const imgRemove = document.createElement('img');
        imgRemove.setAttribute('src', '/images/'+item.imagen);
        imgRemove.setAttribute('alt', 'Atlantic Product');
        imgRemove.value = item.codigo;
        imgRemove.setAttribute('talla', item.talla);
        imgRemove.setAttribute('color', item.color);
        imgRemove.addEventListener('click', function() {
            const talla = event.target.getAttribute('talla');
            const color = event.target.getAttribute('color');
            const codigoProducto = event.target.value;
            Swal.fire({
                title: '¿Eliminar?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                    carritoDeCompras.find(function(product) {
                        if (product.codigo === codigoProducto
                            && product.talla === talla
                            && product.color === color) {
                                const productsSinElemento = carritoDeCompras.filter(
                                    product => product.codigo == codigoProducto
                                    && product.talla == talla
                                    && product.color == color
                                );
                                carritoDeCompras.splice(carritoDeCompras.indexOf(productsSinElemento[0]), 1);
                                localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                                buscarProductosCart();
                        }
                    });
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                  
                }
              });     
        });
        const h3Remove = document.createElement('h3');
        h3Remove.textContent = 'Borrar';
        h3Remove.value = item.codigo;
        h3Remove.setAttribute('talla', item.talla);
        h3Remove.setAttribute('color', item.color);
        h3Remove.addEventListener('click', function() {
            const talla = event.target.getAttribute('talla');
            const color = event.target.getAttribute('color');
            const codigoProducto = event.target.value;
            Swal.fire({
                title: '¿Eliminar?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                    carritoDeCompras.find(function(product) {
                        if (product.codigo === codigoProducto
                            && product.talla === talla
                            && product.color === color) {
                                const productsSinElemento = carritoDeCompras.filter(
                                    product => product.codigo == codigoProducto
                                    && product.talla == talla
                                    && product.color == color
                                );
                                carritoDeCompras.splice(carritoDeCompras.indexOf(productsSinElemento[0]), 1);
                                localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                                buscarProductosCart();
                        }
                    });
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                  
                }
            });
        });
        aRemove.appendChild(imgRemove);
        aRemove.appendChild(h3Remove);
        aRemove.value = item.codigo;
        aRemove.setAttribute('talla', item.talla);
        aRemove.setAttribute('color', item.color);
        aRemove.addEventListener('click', function() {
            const talla = event.target.getAttribute('talla');
            const color = event.target.getAttribute('color');
            const codigoProducto = event.target.value;
            Swal.fire({
                title: '¿Eliminar?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                    carritoDeCompras.find(function(product) {
                        if (product.codigo === codigoProducto
                            && product.talla === talla
                            && product.color === color) {
                                const productsSinElemento = carritoDeCompras.filter(
                                    product => product.codigo == codigoProducto
                                    && product.talla == talla
                                    && product.color == color
                                );
                                carritoDeCompras.splice(carritoDeCompras.indexOf(productsSinElemento[0]), 1);
                                localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                                buscarProductosCart();
                        }
                    });
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } else {
                  
                }
            });
        });
        header.appendChild(aRemove);
        article.appendChild(header);
        const content = document.createElement('div');
        content.classList.add('content');
        content.classList.add('content-flex');
        const h1Title = document.createElement('h1');
        h1Title.textContent = item.titulo;
        h1Title.style.padding = '0';
        h1Title.style.margin = '1.5rem 3rem 1rem 0';
        const pDescription = document.createElement('p');
        pDescription.textContent = item.shortDesc;
        pDescription.style.padding = '0';
        pDescription.style.margin = '0 2rem 0 0';
        pDescription.style.overflow = 'hidden';
        pDescription.style.textOverflow = 'ellipsis';
        pDescription.style.maxHeight = '2.6em';
        const divColor = document.createElement('div');
        divColor.setAttribute('title', 'You have selected this product to be shipped in the color yellow.');
        divColor.style.top = '0';
        divColor.classList.add('color');
        const coloresArray = JSON.parse(item.colores);
        const tallasArray = JSON.parse(item.tallas);
        divColor.style.backgroundColor = coloresArray[item.color]['rgb'];
        const divType = document.createElement('div');
        divType.textContent = tallasArray[item.talla];
        divType.style.top = '43px';
        divType.classList.add('type', 'small');
        content.appendChild(h1Title);
        content.appendChild(pDescription);
        content.appendChild(divColor);
        content.appendChild(divType);
        article.appendChild(content);
        const footerContent = document.createElement('footer');
        footerContent.classList.add('content');
        const spanQtMinus = document.createElement('span');
        spanQtMinus.classList.add('qt-minus');
        spanQtMinus.textContent = '-';
        spanQtMinus.value = item.codigo;
        spanQtMinus.setAttribute('talla', item.talla);
        spanQtMinus.setAttribute('color', item.color);
        spanQtMinus.addEventListener('click', function() {
            const talla = event.target.getAttribute('talla');
            const color = event.target.getAttribute('color');
            const codigoProducto = event.target.value;
            const productoEncontrado = carritoDeCompras.find(
                producto => producto.codigo === codigoProducto
                && producto.talla === talla
                && producto.color === color
            );
            if (productoEncontrado) {
                if (productoEncontrado.cantidad > 1) {
                    const indiceOriginal = carritoDeCompras.indexOf(productoEncontrado);
                    productoEncontrado.cantidad = (productoEncontrado.cantidad || 0) - 1;
                    carritoDeCompras.splice(indiceOriginal, 1);
                    carritoDeCompras.splice(indiceOriginal, 0, productoEncontrado);
                    localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                    buscarProductosCart();
                }
            } else {
                
            }
        });
        const spanQt = document.createElement('span');
        spanQt.classList.add('qt');
        spanQt.textContent = item.cantidad;
        const spanQtPlus = document.createElement('span');
        spanQtPlus.classList.add('qt-plus');
        spanQtPlus.textContent = '+';
        spanQtPlus.value = item.codigo;
        spanQtPlus.setAttribute('talla', item.talla);
        spanQtPlus.setAttribute('color', item.color);
        spanQtPlus.addEventListener('click', function() {
            const talla = event.target.getAttribute('talla');
            const color = event.target.getAttribute('color');
            const codigoProducto = event.target.value;
            const productoEncontrado = carritoDeCompras.find(
                producto => producto.codigo === codigoProducto
                && producto.talla === talla
                && producto.color === color
            );
            if (productoEncontrado) {
                if (productoEncontrado.cantidad < 100) {
                    const indiceOriginal = carritoDeCompras.indexOf(productoEncontrado);
                    productoEncontrado.cantidad = (productoEncontrado.cantidad || 0) + 1;
                    carritoDeCompras.splice(indiceOriginal, 1);
                    carritoDeCompras.splice(indiceOriginal, 0, productoEncontrado);
                    localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                    buscarProductosCart();
                }
            } else {

            }
        });
        const h2FullPrice = document.createElement('h2');
        h2FullPrice.classList.add('full-price');
        const h2Price = document.createElement('h2');
        h2Price.classList.add('price');
        if(item.cantidad > 3) {
            const descuento = item.precio * 0.2;
            h2FullPrice.textContent = '₡'+(item.precio-descuento)*item.cantidad;
            const precioDescuento = item.precio-descuento;
            h2Price.textContent = '₡'+precioDescuento;
        } else {
            h2FullPrice.textContent = '₡'+item.precio*item.cantidad;
            h2Price.textContent = '₡'+item.precio;
        }
        footerContent.appendChild(spanQtMinus);
        footerContent.appendChild(spanQt);
        footerContent.appendChild(spanQtPlus);
        footerContent.appendChild(h2FullPrice);
        footerContent.appendChild(h2Price);
        article.appendChild(footerContent);
        shoppingCartProducts.appendChild(article);
    });
    encontrarResumen();
}

function encontrarResumen() {
    let cantidadTotalDeitems = 0;
    let subtotalTotalDeitems = 0;
    let envioCosto = 0;
    let taxFinal = 0;
    let totalFinal = 0;
    let descuento = 0; 
    carritoDeCompras.forEach(element => {
        cantidadTotalDeitems = cantidadTotalDeitems + element.cantidad;
        if(element.cantidad > 3) {
            descuento = element.precio * 0.2;
            subtotalTotalDeitems = subtotalTotalDeitems + (element.cantidad * (element.precio-descuento));
        } else {
            subtotalTotalDeitems = subtotalTotalDeitems + (element.cantidad * element.precio);
        }
    });
    document.querySelector('#cantidad-productos-resumen').textContent = cantidadTotalDeitems+' unidades';
    document.querySelector('#total-productos-resumen-noTax').textContent = '₡'+subtotalTotalDeitems;
    if(subtotalTotalDeitems > 60000) {
        envioCosto = 0;
        document.querySelector('#provinciaEnvio').classList.add('hidden');
        document.querySelector('#provinciaEnvio-gratis').classList.remove('hidden');
    } else {
        envioCosto = document.querySelector('#provinciaEnvio').value;
        document.querySelector('#provinciaEnvio').classList.remove('hidden');
        document.querySelector('#provinciaEnvio-gratis').classList.add('hidden');
    }
    taxFinal = (parseInt(envioCosto) + subtotalTotalDeitems) * 0.13;
    document.querySelector('#impuestos-productos-resumen').textContent = '₡'+taxFinal.toFixed(2);
    totalFinal = subtotalTotalDeitems+parseInt(envioCosto)+taxFinal;
    document.querySelector('#total-productos-resumen').textContent = '₡'+totalFinal.toFixed(2);
}

function showInfoCliente() {
    document.querySelector('#shopping-cart-resumen-info').classList.remove('hidden');
    document.querySelector('#shopping-cart-resumen').classList.add('hidden');
}

function showResumeCliente() {
    document.querySelector('#shopping-cart-resumen-info').classList.add('hidden');
    document.querySelector('#shopping-cart-resumen').classList.remove('hidden');
}

async function enviarInfoCliente() {
    if(document.querySelector('#name-field').value != '' 
    && document.querySelector('#email-field').value != ''
    && document.querySelector('#tel-field').value != '') {
        let cantidadTotalDeitems = 0;
        let subtotalTotalDeitems = 0;
        let envioCosto = 0;
        let taxFinal = 0;
        let totalFinal = 0;
        carritoDeCompras.forEach(element => {
            cantidadTotalDeitems = cantidadTotalDeitems + element.cantidad;
            subtotalTotalDeitems = subtotalTotalDeitems + (element.cantidad * element.precio);
        });
        if(subtotalTotalDeitems > 60000) {
            envioCosto = 0;
        } else {
            envioCosto = document.querySelector('#provinciaEnvio').value;
        }
        taxFinal = (parseInt(envioCosto) + subtotalTotalDeitems) * 0.13;
        const impuestos = taxFinal.toFixed(2);
        totalFinal = subtotalTotalDeitems+parseInt(envioCosto)+taxFinal;
        const totalfinalString = totalFinal.toFixed(2);
        const nombreCliente = document.querySelector('#name-field').value;
        const correoCliente = document.querySelector('#email-field').value;
        const telefonoCliente = document.querySelector('#tel-field').value;
        const ubicacionCliente = document.querySelector('#location-field').value;
        const comentariosCliente = document.querySelector('#comentario-field').value;
        const metodoPagoCliente = document.querySelector('#pay-field').value;
        let detallesProductos = "";
        const baseUrl = window.location.origin;
        carritoDeCompras.forEach(element => {
            detallesProductos += `
                <div style="margin-bottom: 10px;">
                    <img style="width: 100px; height: auto; margin-right: 10px;" src="${baseUrl}/images/${element.imagen}" alt="">
                    <div>
                        <p><strong>Producto:</strong> ${element.titulo}</p>
                        <p><strong>Cantidad:</strong> ${element.cantidad}</p>
                        <p><strong>Precio unitario:</strong> ₡${element.precio}</p>
                        <p><strong>Subtotal:</strong> ₡${element.cantidad * element.precio}</p>
                    </div>
                </div>
                <hr>
            `;
        });
        let mensaje = `
            <div style="font-family: Arial, sans-serif;">
                <p><strong>Nombre:</strong> ${nombreCliente}</p>
                <p><strong>Correo electrónico:</strong> ${correoCliente}</p>
                <p><strong>Teléfono:</strong> ${telefonoCliente}</p>
                <p><strong>Ubicación:</strong> ${ubicacionCliente}</p>
                <p><strong>Método de Pago:</strong> ${metodoPagoCliente}</p>
                <p><strong>Comentarios:</strong> ${comentariosCliente}</p>
                <br>
                <p><strong>Cantidad Total de Items:</strong> ${cantidadTotalDeitems}</p>
                <p><strong>Subtotal Total de Items:</strong> ₡${subtotalTotalDeitems}</p>
                <p><strong>Costo de Envío:</strong> ₡${envioCosto}</p>
                <p><strong>Impuesto Final:</strong> ₡${taxFinal}</p>
                <p><strong>Total Final:</strong> ₡${totalfinalString}</p>
                <br>
                <p><strong>Detalles de Productos:</strong></p>
                ${detallesProductos}
            </div>
        `;
        await sendEmail(mensaje,'tiendaatlantic1@gmail.com','atlanticatienda33@gmail.com','Mensaje de Compra','Mensaje enviado\n ¡Muchas Gracias',true);
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Por favor ingresar, Nombre, Correo y Telefono",
          });
    }
}
function goToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

async function borrarProducto(id) {
    Swal.fire({
        title: '¿Eliminar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, borrar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            const data = new FormData();
            data.append('id', id);
            const url = `${location.origin}/api/delete-product`;
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: data
                });
                const result = await response.json();
                if (result) {
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Lo sentimos, se ha producido un error al eliminar el producto',
                        icon: 'error',
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK"
                    });
                }
            } catch (error) {
                console.error('Error al realizar la solicitud:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Lo sentimos, se ha producido un error al realizar la solicitud',
                    icon: 'error',
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            }
        }
    });
}


async function eliminarCategoria(id) {
    const titulo = "¿Estás seguro?";
    const icon = "warning";
    const confirmacion = await Swal.fire({
        title: titulo,
        text: "",
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    });
    if (confirmacion.isConfirmed) {
        const data = new FormData();
        data.append('id', id);
        const url = `${location.origin}/api/delete-category`;
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await response.json();
            if (response.ok) {
                Swal.fire({
                    title: "¡Borrado!",
                    text: "",
                    icon: "success",
                }).then((result) => {
                    window.location.href = '/1b64884ff1c612eaca3a0ece9a609116';
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: resultado.message || "Ha ocurrido un error.",
                    icon: "error",
                });
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error);
            Swal.fire({
                title: "Error",
                text: "Ha ocurrido un error al procesar la solicitud.",
                icon: "error",
            });
        }
    }
}

async function eliminarCategoriaa(id) {
    const titulo = "¿Estás seguro?";
    const icon = "warning";
    const confirmacion = await Swal.fire({
        title: titulo,
        text: "",
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    });
    if (confirmacion.isConfirmed) {
        const data = new FormData();
        data.append('id', id);
        const url = `${location.origin}/api/delete-category-a`;
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const resultado = await response.json();
            if (response.ok) {
                Swal.fire({
                    title: "¡Borrado!",
                    text: "",
                    icon: "success",
                }).then((result) => {
                    window.location.href = '/054d19a00589bfb69c334a7e27a734b3';
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: resultado.message || "Ha ocurrido un error.",
                    icon: "error",
                });
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error);
            Swal.fire({
                title: "Error",
                text: "Ha ocurrido un error al procesar la solicitud.",
                icon: "error",
            });
        }
    }
}




    //carouselx--item
/*
    let isDragging = false;
    let startX;
    let scrollLeft;

    carousel.addEventListener('mousedown', handleMouseDown);
    carousel.addEventListener('mousemove', handleMouseMove);
    carousel.addEventListener('mouseup', handleMouseUp);
    carousel.addEventListener('touchstart', handleTouchStart);
    carousel.addEventListener('touchmove', handleTouchMove);
    carousel.addEventListener('touchend', handleTouchEnd);

    function handleMouseDown(event) {
        isDragging = true;
        startX = event.pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
    }

    function handleMouseMove(event) {
        if (!isDragging) return;
        event.preventDefault();
        const x = event.pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2; // Ajusta la velocidad del scroll
        carousel.scrollLeft = scrollLeft - walk;
    }

    function handleMouseUp() {
        isDragging = false;
    }

    function handleTouchStart(event) {
        isDragging = true;
        startX = event.touches[0].pageX - carousel.offsetLeft;
        scrollLeft = carousel.scrollLeft;
    }

    function handleTouchMove(event) {
        if (!isDragging) return;
        event.preventDefault();
        const x = event.touches[0].pageX - carousel.offsetLeft;
        const walk = (x - startX) * 2; // Ajusta la velocidad del scroll
        carousel.scrollLeft = scrollLeft - walk;
    }

    function handleTouchEnd() {
        isDragging = false;
    }

    if (prevBtnx != null && nextBtnx != null) {
        prevBtnx.addEventListener('click', () => {
            carousel.scrollLeft -= carousel.offsetWidth;
        });
        nextBtnx.addEventListener('click', () => {
            carousel.scrollLeft += carousel.offsetWidth;
        });
    }

    carousel.addEventListener('scroll', () => {
        const centerX = carousel.offsetWidth / 2;
        const items = carousel.querySelectorAll('.carouselx--item');
        let minDiff = Infinity;
        let targetIndex = 0;
        items.forEach((item, index) => {
            const itemRect = item.getBoundingClientRect();
            const itemCenterX = itemRect.left + itemRect.width / 2;
            const diff = Math.abs(centerX - itemCenterX);
            if (diff < minDiff) {
                minDiff = diff;
                targetIndex = index;
            }
        });
        const targetItem = items[targetIndex];
        const targetItemRect = targetItem.getBoundingClientRect();
        const targetItemCenterX = targetItemRect.left + targetItemRect.width / 2;
        const scrollAmount = targetItemCenterX - centerX;
        carousel.scrollLeft += scrollAmount;
    });
*/
function showSelectGenre() {
    var selectGenre = document.querySelector('.select-genre');
    selectGenre.style.display = (selectGenre.style.display === 'block') ? 'none' : 'block';
}

const stickyBar = document.querySelector('.sticky');
const stickyBarContainer = document.querySelector('#sticky-ad-container');
let showSticky = localStorage.getItem('showSticky');

try {
    const stickyBarTopOffset = stickyBar.offsetTop;
} catch (error) {
    
}

function handleScroll() {
    try {
        console.log(stickyBarTopOffsets);
        const scrollPosition = window.scrollY;
        if (scrollPosition >= stickyBarTopOffset) {
          stickyBar.classList.add('top');
          stickyBarContainer.classList.add('top');
        } else {
          stickyBar.classList.remove('top');
          stickyBarContainer.classList.remove('top');
        }
    } catch (error) {
        
    }
}

let stickyElementCount = 0;
let intervalId = null;

if(showSticky == '0') {
    stickyBarContainer.classList.add('hidden');
} else {
    intervalId = setInterval(showNextItem, 6000);
}

function closeStickyAd() {
  localStorage.setItem('showSticky', '0');
  if(intervalId != null) {
    clearInterval(intervalId);
  }
  stickyBarContainer.classList.add('hidden');
}

try {
    function showNextItem() {
        document.querySelectorAll('.sticky-ad')[stickyElementCount].classList.add('hidden');
        stickyElementCount++;
        if(stickyElementCount > 3) {
          stickyElementCount = 0;
        }
        document.querySelectorAll('.sticky-ad')[stickyElementCount].classList.remove('hidden');
        
      }
} catch (error) {
    
}


window.addEventListener('scroll', handleScroll);
let intervalPopupId = null;
let imgsPopUp = [];
let showPopUp = localStorage.getItem('showPopUp');
let imgsPopUpH = [];
let imgsPopUpV = [];
let imgsPopUpCount = 0;
let popUpOpen = false;

function detectOrientation() {
    if(popUpOpen == true) {
        if (window.innerWidth > window.innerHeight) {
        // console.log("La pantalla está en modo horizontal");
            imgsPopUp = imgsPopUpH;
            imgsPopUpCount = 0;
            if(intervalPopupId != null) {
            clearInterval(intervalPopupId);
            }
            openPopup();
        } else {
            //console.log("La pantalla está en modo vertical");
            imgsPopUp = imgsPopUpV;
            imgsPopUpCount = 0;
            if(intervalPopupId != null) {
            clearInterval(intervalPopupId);
            }
            openPopup();
        }
    }
}
  window.addEventListener('DOMContentLoaded', detectOrientation);
  window.addEventListener('resize', detectOrientation);

function closePopup() {
    popUpOpen = false;
    document.getElementById('popup').classList.add('hidden');
    if(intervalPopupId != null) {
      clearInterval(intervalPopupId);
      intervalPopupId = null;
    }
    localStorage.setItem('showPopUp', '0');
}

async function openPopup() {
    const url = `${location.origin}/api/95ff27d16e904dccf0d9bc2f961e748d`;
    const response = await fetch(url, {
        method: 'POST',
    });
    const result = await response.json();
    if(result.length > 0) {
        result.forEach(element => {
            imgsPopUpV.push(element.name+'-v.jpg');
            imgsPopUpH.push(element.name+'-h.jpg');
        });
        if (window.innerWidth > window.innerHeight) {
            
            imgsPopUp = imgsPopUpH;
            
          } else {
           
            imgsPopUp = imgsPopUpV;
        }
        popUpOpen = true;
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popUpIMG').src = '/images/'+imgsPopUp[imgsPopUpCount];
        intervalPopupId = setInterval(function() {
          imgsPopUpCount++;
          if (imgsPopUpCount > imgsPopUp.length -1) {
            imgsPopUpCount = 0;
          }
          document.getElementById('popUpIMG').src = '/images/'+imgsPopUp[imgsPopUpCount];
        }, 6000);
    }
    
  }

  document.addEventListener("DOMContentLoaded", function() {
    if(showPopUp == '0') {
      
    } else {
      openPopup();
    }
  });


  function eliminarPopUp(id) {
    Swal.fire({
        title: '¿Eliminar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, borrar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            const data = new FormData();
            data.append('id', id);
            const url = `${location.origin}/api/585017aa4ee7d08060322deb77c9d74d`;
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: data
                });
                const result = await response.json();
                if (result) {
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Lo sentimos, se ha producido un error al eliminar el producto',
                        icon: 'error',
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK"
                    });
                }
            } catch (error) {
                console.error('Error al realizar la solicitud:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Lo sentimos, se ha producido un error al realizar la solicitud',
                    icon: 'error',
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            }
        }
    });
}

function openFullImgModal(event) {
    const modal = document.getElementById("myModal-modal");
    const modalImg = document.getElementById("myModal-img");
    modal.style.display = "block";
    modalImg.src = event.target.attributes.src.value;
    originalBodyOverflow = document.body.style.overflow;
    document.body.style.overflow = 'hidden';
    imageZoom("myModal-img", "myresult");
}


async function activarProducto(id,estado) {
    const data = new FormData();
    data.append('id', id);
    data.append('estado', estado);
    const url = `${location.origin}/api/55e926765c284cd9da07aea89bc9f753`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    const result = await response.json();
    if(result) {
        var params = window.location.search;
        window.location.href = window.location.pathname + params;
    }
  }

  
  document.addEventListener('DOMContentLoaded', function() {

});

/*

var inputd = document.getElementById('inputPalabras');

if(inputd) {
    inputd.addEventListener('input', function() {
    findWords();
  });
}
*/
async function findWords() {
    const inputd = document.getElementById('inputPalabras');
    const genre = document.querySelector('#page-genre').value;
    const textoIngresado = inputd.value;
    //console.log(textoIngresado)
    const data = new FormData();
    data.append('palabras', textoIngresado);
    data.append('genero', genre);
    const url = `${location.origin}/api/find-products-words`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    productos = await response.json();
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    var newSearchParams = "?4014baac2e585d86e97c81beb778c6c8=1&89759e1284e2479b991d2669de104942="+encodeURIComponent(textoIngresado);
    var pathname = window.location.pathname;
    var hash = window.location.hash;
    history.pushState(null, "", pathname + newSearchParams + hash);
    paginaActual = 1;
    btnSelected = 'btn-nav-0';
    document.querySelector('#btn-nav-0').value = '1';
    document.querySelector('#btn-nav-0').innerText = '1';
    document.querySelector('#btn-nav-1').value = '2';
    document.querySelector('#btn-nav-1').innerText = '2';
    document.querySelector('#btn-nav-2').value = '3';
    document.querySelector('#btn-nav-2').innerText = '3';
    document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
    buscar(productos);
}

async function encontrarPaginaDesdeUrl(page,word) {
    var textoIngresado = decodeURIComponent(word);
    document.querySelector('#inputPalabras').value = textoIngresado;
    const data = new FormData();
    data.append('palabras', textoIngresado);
    data.append('genero', genre);
    const url = `${location.origin}/api/find-products-words`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    productos = await response.json();
    cantidadDeProductos = productos.length;
    cantidadDePaginas = Math.ceil(cantidadDeProductos / 4);
    let pageDiscounting = page;
    paginaActual = page;
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    if(page >= 3) {
        for (let index = 0; index < 3; index++) {
            document.querySelector('#btn-nav-'+(2-index)).value = pageDiscounting - index;
            document.querySelector('#btn-nav-'+(2-index)).innerText = pageDiscounting - index;
            if(index == 2) {
                document.querySelector('#btn-nav-2').classList.add('btn-nav-active');
                btnSelected = 'btn-nav-2';
            }
        }
    } else if(page == 2 && cantidadDePaginas == 2) {
        document.querySelector('#btn-nav-0').value = '1';
        document.querySelector('#btn-nav-0').innerText = '1';
        document.querySelector('#btn-nav-1').value = '2';
        document.querySelector('#btn-nav-1').innerText = '2';
        document.querySelector('#btn-nav-2').value = '3';
        document.querySelector('#btn-nav-2').innerText = '3';
        document.querySelector('#btn-nav-1').classList.add('btn-nav-active');
        btnSelected = 'btn-nav-1';
    } else if(page == 2 && cantidadDePaginas > 2) {
        document.querySelector('#btn-nav-0').value = '1';
        document.querySelector('#btn-nav-0').innerText = '1';
        document.querySelector('#btn-nav-1').value = '2';
        document.querySelector('#btn-nav-1').innerText = '2';
        document.querySelector('#btn-nav-2').value = '3';
        document.querySelector('#btn-nav-2').innerText = '3';
        document.querySelector('#btn-nav-1').classList.add('btn-nav-active');
        btnSelected = 'btn-nav-1';
    } else if(page == 1 && cantidadDePaginas == 2) {
        document.querySelector('#btn-nav-0').value = '1';
        document.querySelector('#btn-nav-0').innerText = '1';
        document.querySelector('#btn-nav-1').value = '2';
        document.querySelector('#btn-nav-1').innerText = '2';
        document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
    } else if(page == 1 && cantidadDePaginas == 1) {
        document.querySelector('#btn-nav-0').value = '1';
        document.querySelector('#btn-nav-0').innerText = '1';
        document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
    } else {
        document.querySelector('#btn-nav-0').classList.add('btn-nav-active');
        
    }
    buscar(productos);
}

var carousel = document.getElementById('products-containerx');
var prevBtnx = document.getElementById('prevBtnx');
var nextBtnx = document.getElementById('nextBtnx');
var mostrandoCarouselItem = 0;
var caroulsexItems = document.getElementsByClassName('carouselxItem');

async function hiddeNewProducts() {
    if (prevBtnx != null && nextBtnx != null) {
        if(caroulsexItems.length > 3) {
            for (let index = 0; index < caroulsexItems.length; index++) {
                if(index > 2) {
                    const element = caroulsexItems[index];
                    element.classList.add('hidden');
                }
            }
        }

        prevBtnx.addEventListener('click', () => {
            if(mostrandoCarouselItem > 0) {
                try {
                    caroulsexItems[mostrandoCarouselItem - 1].classList.remove('hidden');
                    caroulsexItems[mostrandoCarouselItem - 3].classList.add('hidden');
                } catch (error) {
                    
                }
                mostrandoCarouselItem--;
            }
        });
        
        nextBtnx.addEventListener('click', () => {
            if(mostrandoCarouselItem + 3 < caroulsexItems.length) {
                try {
                    caroulsexItems[mostrandoCarouselItem + 3].classList.remove('hidden');
                    caroulsexItems[mostrandoCarouselItem].classList.add('hidden');
                } catch (error) {
                    
                }
                mostrandoCarouselItem++;
            }
        });
    }
}
