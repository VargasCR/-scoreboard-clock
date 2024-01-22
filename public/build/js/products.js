
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

function changeSize(x) {
    //alert(x);
    const tallas = document.querySelectorAll('.talla-button');
    
    tallas.forEach(talla => {
        talla.classList.remove('talla-button-selected');
    });

    document.querySelector('#t-'+x).classList.add('talla-button-selected');
    document.querySelector('#talla-id').value = x;
}
function changeColor(x,img) {
    //alert(x);
    const colores = document.querySelectorAll('.color-button');
   
    colores.forEach(color => {
        color.classList.remove('color-button-selected');
    });
    document.querySelector('#c-'+x).classList.add('color-button-selected');
    document.querySelector('#color-id').value = x;
    document.querySelector('#image-id').value = img;
    document.querySelector('#img-show-product').src = '/images/'+img;
}

async function filtrarPorCategoria(categoria) {
    
    //alert(categoria);
    if(document.querySelector('#page-category').value == 1) {
        if(categoria == '0') {
            const data = new FormData();
            data.append('class', '0');
            const url = `${location.origin}/api/find-products`;
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });
            const productos = await response.json();
            //console.log(productos);
            return productos;
        } else {
            const data = new FormData();
            data.append('class', '0');
            data.append('categoria', categoria);
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
            //console.log(productsAurumL);
            return productsAurumL;
        } else {
            console.log(categoria);
            //alert(categoria);
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

async function showFloatingWindow(cod) {
    document.querySelector('#product-id').value = cod;
    document.querySelector('#myModal').style.display = 'flex';
    const coloresContainer = document.querySelector('#colores-container');
    const tallaContainer = document.querySelector('#tallas-container');
    const descContainer = document.querySelector('#desc-container');


    const data = new FormData();

    data.append('id', cod);
    const url = `${location.origin}/api/find-product`;
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });
    
    const producto = await response.json();
    //let producto = encontrarProductoPorCodigo(cod);
    //console.log(producto.desc);

   // return;

    
    const descriptions = JSON.parse(producto.desc);

    await limpiarProductoTallaColor();
    document.querySelector('#img-show-product').src = '/images/' + producto.imagen;
    JSON.parse(producto.desc).forEach(text => {
        const textoDesc = document.createElement('P');
        textoDesc.textContent = text;
        ////console.log(textoDesc);
        descContainer.appendChild(textoDesc);
    });
    JSON.parse(producto.colores).forEach(function (color, index) {
        const button = document.createElement('button');
        //button.textContent = color.color;
        button.className = 'color-button';
        button.id = 'c-'+index;
        
        button.style.backgroundColor = color.rgb;
        //button.style.color = color.rgb;  // Puedes cambiar esto si quieres un color de texto específico
        button.onclick = function () {
            changeColor(index,color.imagen);
        };
        coloresContainer.appendChild(button);
    });
    
    ////console.log(producto.tallas);
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

    // Agregar label e input al contenedor
    contenedor.appendChild(label);
    contenedor.appendChild(input);
}


let coloresAgregados = [];
let conteoDeColores = 0;

function encontrarTotalColores() {
   // alert();
    conteoDeColores = document.querySelector('#cantColores').value;
}

function agregarColor(event) {
    //alert("Botón clickeado");
    event.preventDefault();
    conteoDeColores++;
    coloresAgregados.push(conteoDeColores);
    // Crear un nuevo div con la clase "slot"
    var nuevoSlot = document.createElement("div");
    nuevoSlot.id = 'c-'+conteoDeColores;
    nuevoSlot.classList.add("slot");
    nuevoSlot.style.backgroundColor = "#eaeaea";
    nuevoSlot.style.padding = "1rem";
    nuevoSlot.style.margin = "1rem 0 0 0";
    
    // Agregar botón de eliminación
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


    // Crear etiquetas e inputs para nombre del color, color en formato rgb, e imagen del producto
    agregarLabelYInput(nuevoSlot, "Nombre del color", "color");
    agregarLabelYInput(nuevoSlot, "Color en formato rgb", "rgb");

    var labelImagen = document.createElement("label");
    labelImagen.setAttribute("for", "imagenColor");
    labelImagen.textContent = "Imagen del producto";

    var inputImagen = document.createElement("input");
    inputImagen.setAttribute("type", "file");
    inputImagen.setAttribute("id", "imagenColor");
    inputImagen.setAttribute("name", "imagenColor[]");

    // Agregar elementos al nuevoSlot
    nuevoSlot.appendChild(labelImagen);
    nuevoSlot.appendChild(inputImagen);

    // Agregar el nuevoSlot al contenedorSlots
    document.getElementById("colores-contenedor").appendChild(nuevoSlot);

}

function eliminarSlot(slotId,event) {
    event.preventDefault();
    console.log(slotId);
    var slotAEliminar = document.getElementById('c-' + slotId);
    if (slotAEliminar) {
        slotAEliminar.remove();
    }
}
let imagenesAEliminar = [];
function eliminarEditSlot(slotId,event) {
    event.preventDefault();
    var slotAEliminar = document.getElementById('c-' + slotId);
    var imgValue = document.getElementById('img-' + slotId).getAttribute('value');
    imagenesAEliminar.push(imgValue);
    document.querySelector('#imagenesEliminar').value = imagenesAEliminar;
    //console.log(imgValue);
  //  return;
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
       // //console.log(carritoDeCompras);
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
    //alert()
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
    ////console.log(datosRecuperados);
    if(datosRecuperados.length > 0) {
        document.querySelector('#floating-cart-btn').classList.remove('hidden')
        //document.querySelector('#cart-count').innerText = datosRecuperados.length;
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
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeFloatingWindow();
    }
}

function closeFloatingWindow() {
    var modal = document.querySelector('#myModal');
    document.querySelector('#product-id').value = '-1';
    document.querySelector('#talla-id').value = '-1';
    document.querySelector('#color-id').value = '-1';
    document.querySelector('#image-id').value = '-1';
    modal.style.display = 'none';
}

async function createProduct() {
    let countItem = 0;

    const url = `${location.origin}/api/lastest-products`;
    const response = await fetch(url, {
        method: 'POST',
    });

    const result = await response.json();
    console.log(result);
    result.forEach(product => {
        const productContainer = document.createElement("div");
        productContainer.classList.add('productContainer');

        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.style.margin = "0.5rem";
        productItem.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const productImage = document.createElement("img");
        productImage.src = "/images/" + product.imagen;
        productImage.alt = "";

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
        //addToCartButton.dataset.tooltip = "¿Añadir?";
        addToCartButton.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper";

        const textDiv = document.createElement("div");
        textDiv.className = "text";
        textDiv.textContent = "🛒";

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

        productItem.appendChild(productImage);
        productItem.appendChild(downContent);

        productContainer.appendChild(productItem);

        const productsContainer = document.querySelector("#products-container");
        productsContainer.appendChild(productContainer);
        countItem++;
    })
}



async function buscarTodos() {
    await limpiarProductos();
    cantidadDeProductos = products.length;
    cantidadDePaginas = cantidadDeProductos / 4;

    const indexDesde = (4 * paginaActual) - 4;
    const indexHasta = 4 * paginaActual;
    let productosSeleccionados = [];
    alert();
    if(document.querySelector('#page-category').value == 1) {
        const data = new FormData();
        data.append('class', '0');
        const url = `${location.origin}/api/find-products`;
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
        const producto = await response.json();
        //console.log(producto);
        productosSeleccionados = producto.slice(indexDesde, indexHasta);
    } else if(document.querySelector('#page-category').value == 2){
        
        const data = new FormData();
        
        
        data.append('class', '1');
        const url = `${location.origin}/api/find-products`;
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });
    
        const productsAurum = await response.json();


        cantidadDeProductos = productsAurum.length;
        cantidadDePaginas = cantidadDeProductos / 4;
        productosSeleccionados = productsAurum.slice(indexDesde, indexHasta);
    }
    



    if(cantidadDePaginas <= 1){
        document.querySelector('#navegation-products').classList.add('hidden');
    } else if(cantidadDePaginas <= 2 && cantidadDePaginas > 1) {
        document.querySelector('#btn-nav-2').classList.add('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
        
    } else {
        //alert(cantidadDePaginas)
        document.querySelector('#btn-nav-2').classList.remove('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    }


    productosSeleccionados.forEach(product => {
        const productContainer = document.createElement("div");
        productContainer.classList.add('productContainer');

        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.style.margin = "0.5rem";
        productItem.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const productImage = document.createElement("img");
        productImage.src = "/images/" + product.imagen;
        productImage.alt = "";

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
        //addToCartButton.dataset.tooltip = "¿Añadir?";
        addToCartButton.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper";

        const textDiv = document.createElement("div");
        textDiv.className = "text";
        textDiv.textContent = "🛒";

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

        productItem.appendChild(productImage);
        productItem.appendChild(downContent);

        productContainer.appendChild(productItem);

        const productsContainer = document.querySelector("#products-container");
        productsContainer.appendChild(productContainer);
        countItem++;
    
    });
    encontrarProductosEnCarrito();
}

function limpiarProductos() {
    const productsContainer = document.querySelector('#products-container');
    // Elimina todos los elementos hijos
    while (productsContainer.firstChild) {
        productsContainer.removeChild(productsContainer.firstChild);
    }
    
}

function limpiarProductoTallaColor() {
    const colorContainer = document.querySelector('#colores-container');
    const tallaContainer = document.querySelector('#tallas-container');
    const descContainer = document.querySelector('#desc-container');

    // Elimina todos los elementos hijos
    while (colorContainer.firstChild) {
        colorContainer.removeChild(colorContainer.firstChild);
    }
    while (tallaContainer.firstChild) {
        tallaContainer.removeChild(tallaContainer.firstChild);
    }
    while (descContainer.firstChild) {
        descContainer.removeChild(descContainer.firstChild);
    }
}

function limpiarProductosCarrito() {
    const productsContainer = document.querySelector('#shopping-cart-products-container');

    // Elimina todos los elementos hijos
    while (productsContainer.firstChild) {
        productsContainer.removeChild(productsContainer.firstChild);
    }
}

function cambiarCategoria(w,t) {
    
    buscandoCategoria = w;
    paginaActual = 1;
    document.querySelector('#select-text').textContent = `${t}`;
    document.querySelector('#select-simbol').innerHTML= `&#9660;`;
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    document.getElementById('btn-nav-0').classList.add('btn-nav-active');
    toggleOptions(t);
    buscar(w);
}

try {
    if (document.querySelector('#selecter-used').value == '3') {
        var optionsContainer = document.getElementById('optionsContainer');
        var isOpen = false;

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.custom-select-container')) {
                isOpen = false;
                optionsContainer.style.display = 'none'; // Cambiado de 'maxHeight' a 'display'
                document.querySelector('#custom-select-container').style.position = 'unset';
                document.querySelector('#select-simbol').innerHTML = `&#9660;`;
            }
        });
    }
} catch (error) {

}

function toggleOptions(t) {
    isOpen = !isOpen;
    optionsContainer.style.display = isOpen ? 'inline-table' : 'none'; // Cambiado de 'maxHeight' a 'display'
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
    await limpiarProductos();

    const productosFiltrados = await filtrarPorCategoria(w);
    
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
        //alert(cantidadDePaginas)
        document.querySelector('#btn-nav-2').classList.remove('hidden');
        document.querySelector('#navegation-products').classList.remove('hidden');
    }
    let productosSeleccionados = [];
    const indexDesde = (4 * paginaActual) - 4;
    const indexHasta = 4 * paginaActual;
    
    
    //console.log('paginaActual');
    productosSeleccionados = productosFiltrados.slice(indexDesde, indexHasta);

    
    
    if (w == '0') {
        //buscarTodos();
        //return;
    } else if(cantidadDeProductos == 0) {
        const textoVacio = document.createElement("h3");
        textoVacio.textContent = 'No hay resultados';
        textoVacio.style.textAlign = 'center';
        const productsContainer = document.querySelector("#products-container");
        productsContainer.appendChild(textoVacio);
        //alert();
        return;
    }
    
    productosSeleccionados.forEach(product => {
        const productContainer = document.createElement("div");
        productContainer.classList.add('productContainer');

        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.style.margin = "0.5rem";
        productItem.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const productImage = document.createElement("img");
        productImage.src = "/images/" + product.imagen;
        productImage.alt = "";

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
        //addToCartButton.dataset.tooltip = "¿Añadir?";
        addToCartButton.onclick = function() {
            showFloatingWindow(product.codigo);
        };

        const buttonWrapper = document.createElement("div");
        buttonWrapper.className = "button-wrapper";

        const textDiv = document.createElement("div");
        textDiv.className = "text";
        textDiv.textContent = "🛒";

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

        productItem.appendChild(productImage);
        productItem.appendChild(downContent);

        productContainer.appendChild(productItem);

        const productsContainer = document.querySelector("#products-container");
        productsContainer.appendChild(productContainer);
        
    
    });
    encontrarProductosEnCarrito();
}

async function encontrarPagina(n) {
    paginaActual = document.getElementById(n).value;
    btnSelected = n;
    document.querySelectorAll('.btn-nav').forEach(element => {
        element.classList.remove('btn-nav-active');
    });
    document.querySelector('#'+n).classList.add('btn-nav-active');
    
    buscar(buscandoCategoria);
}

async function siguientePagina() {
    if(paginaActual < cantidadDePaginas) {
        paginaActual++;
        let RestandoValor = 3;
        const nodeList = document.querySelectorAll('.btn-nav-number');
        const arrayButtons = Array.from(nodeList);
        if(paginaActual > 3) {
            //alert(paginaActual);
            arrayButtons.forEach(element => {
                element.value = ((paginaActual - RestandoValor)) + 1;
                element.innerText = ((paginaActual - RestandoValor)) + 1;
                ////console.log(((paginaActual - RestandoValor)) + 1);
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
        buscar(buscandoCategoria);

    }
}

async function retrocederPagina() {
    if(paginaActual > 1) {
        paginaActual--;
        
    if (btnSelected == 'btn-nav-0') {
        let RestandoValor = 1;
        const nodeList = document.querySelectorAll('.btn-nav-number');
        const arrayButtons = Array.from(nodeList);
        
        //alert(paginaActual);
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
        buscar(buscandoCategoria);
    }
}
function buscarProductosCart() {
    
    const shoppingCartProducts = document.getElementById('shopping-cart-products-container');
    limpiarProductosCarrito();
    
    // Obtener la cadena JSON desde localStorage
    const datosGuardados = localStorage.getItem('carritoDeComprasLista');
    // Convertir la cadena JSON a un objeto
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
        
        // Crear el elemento article
        const article = document.createElement('article');
        article.classList.add('product');
        article.style.opacity = '1';

        // Crear el encabezado
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

        console.log(tallasArray[item.talla]);
        console.log(coloresArray[item.color]['rgb']);
        
        
        content.appendChild(h1Title);
        content.appendChild(pDescription);

        content.appendChild(divColor);
        content.appendChild(divType);
        article.appendChild(content);

        // Crear el pie de página
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
            // Obtener el código del producto del atributo 'value'
            const codigoProducto = event.target.value;
            // Buscar el producto por su código
            const productoEncontrado = carritoDeCompras.find(
                producto => producto.codigo === codigoProducto
                && producto.talla === talla
                && producto.color === color
            );

            if (productoEncontrado) {
                if (productoEncontrado.cantidad > 1) {
                    // Almacenar la posición actual del producto
                    const indiceOriginal = carritoDeCompras.indexOf(productoEncontrado);
                    // Sumar 1 a la cantidad
                    productoEncontrado.cantidad = (productoEncontrado.cantidad || 0) - 1;
                    // Puedes agregar lógica adicional aquí si es necesario

                    // //console.log(`Producto ${codigoProducto} agregado al carrito. Cantidad actual: ${productoEncontrado.cantidad}`);

                    carritoDeCompras.splice(indiceOriginal, 1);
                    carritoDeCompras.splice(indiceOriginal, 0, productoEncontrado);

                    // Si deseas guardar el array actualizado en localStorage, puedes hacerlo aquí
                    localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                    buscarProductosCart();
                }

                
            } else {
                ////console.log(`Producto ${codigoProducto} no encontrado en el array.`);
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

            // Obtener el código del producto del atributo 'value'
            const codigoProducto = event.target.value;
            
            // Buscar el producto por su código
            const productoEncontrado = carritoDeCompras.find(
                producto => producto.codigo === codigoProducto
                && producto.talla === talla
                && producto.color === color
            );
            
            if (productoEncontrado) {
                if (productoEncontrado.cantidad < 100) {

                    // Almacenar la posición actual del producto
                    const indiceOriginal = carritoDeCompras.indexOf(productoEncontrado);
    
                    // Sumar 1 a la cantidad
                    productoEncontrado.cantidad = (productoEncontrado.cantidad || 0) + 1;

                    carritoDeCompras.splice(indiceOriginal, 1);
                    carritoDeCompras.splice(indiceOriginal, 0, productoEncontrado);
    
                    // Si deseas guardar el array actualizado en localStorage, puedes hacerlo aquí
                    localStorage.setItem('carritoDeComprasLista', JSON.stringify(carritoDeCompras));
                    buscarProductosCart();
                }
            } else {

            }
        });


        const h2FullPrice = document.createElement('h2');
        h2FullPrice.classList.add('full-price');
        h2FullPrice.textContent = '₡'+item.precio*item.cantidad;

        const h2Price = document.createElement('h2');
        h2Price.classList.add('price');
        h2Price.textContent = '₡'+item.precio;

        footerContent.appendChild(spanQtMinus);
        footerContent.appendChild(spanQt);
        footerContent.appendChild(spanQtPlus);
        footerContent.appendChild(h2FullPrice);
        footerContent.appendChild(h2Price);
        article.appendChild(footerContent);

        // Agregar el artículo del producto al contenedor
        console.log(article);
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
    carritoDeCompras.forEach(element => {
        cantidadTotalDeitems = cantidadTotalDeitems + element.cantidad;
        subtotalTotalDeitems = subtotalTotalDeitems + (element.cantidad * element.precio);
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
    //alert();
    document.querySelector('#shopping-cart-resumen-info').classList.remove('hidden');
    document.querySelector('#shopping-cart-resumen').classList.add('hidden');
}
function showResumeCliente() {
    document.querySelector('#shopping-cart-resumen-info').classList.add('hidden');
    document.querySelector('#shopping-cart-resumen').classList.remove('hidden');
}

async function enviarInfoCliente() {
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


    let detallesProductos = ""; // Variable para almacenar detalles de productos
    const baseUrl = window.location.origin;
    ////console.log(baseUrl);
    carritoDeCompras.forEach(element => {
        // Agrega detalles de cada producto al mensaje
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
                        
}
// Función para ir al inicio de la página
function goToTop() {
    // Utiliza window.scrollTo para desplazar la página al principio
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
                //console.log(result);
                if (result) {
                    // Éxito
                    Swal.fire({
                        title: "¡Borrado!",
                        text: "",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        // Aquí puedes realizar acciones adicionales después del borrado
                        // Por ejemplo, recargar la página o actualizar la interfaz
                        location.reload();
                    });
                } else {
                    // Error
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
                // Manejar errores de red u otros
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

        const url = 'http://localhost:3000/api/delete-category';

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });

            const resultado = await response.json();
            console.log(response);
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
            console.log(resultado);
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

        const url = 'http://localhost:3000/api/delete-category-a';

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });

            const resultado = await response.json();
            console.log(response);
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
            console.log(resultado);
            console.error("Error al enviar la solicitud:", error);
            Swal.fire({
                title: "Error",
                text: "Ha ocurrido un error al procesar la solicitud.",
                icon: "error",
            });
        }
    }
}







