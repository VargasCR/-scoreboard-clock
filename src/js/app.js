let previewImages = [];
let uploadedImages = [];
let deleteuploadedImages = [];
let mainpreviewImage = 0;
let inputRef = null;
let showingSlide = -1;
let myid = 0;
let provincias = [];
let cantones = [];
let distritos = [];
let plan = [];
let category = [];
let tagcount = 1;

/*function scrollToSection() {
    var targetElement = document.getElementById("services-box");
    var offset = 80;  // Ajusta este valor según tus necesidades

    if (targetElement) {
        window.scrollTo({
            top: targetElement.offsetTop - offset,
            behavior: "smooth"
        });
    }
} */
function eventListeners() {
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuSearch = document.getElementById('mobile-menu-search');

    mobileMenu.addEventListener('click', navegacionResponsive);
    mobileMenuSearch.addEventListener('click', searchResponsive);
}

function navegacionResponsive() {
    const navegacion = document.getElementById('navegation');
    navegacion.classList.toggle('show-nav')
}
function searchResponsive() {
    const navegacion = document.getElementById('search-container');
    navegacion.classList.toggle('show-search')
}

function setmainimg() {
    mainpreviewImage = showingSlide;
    //console.log(mainpreviewImage);
    findmainimg();
    document.getElementById('img-main').value = mainpreviewImage;
}

function findmainimg() {
    if (mainpreviewImage == showingSlide) {
        document.getElementById('main-icon-main').src = '/images/app/principal-img-act.svg';
    } else {document.getElementById('main-icon-main').src = '/images/app/principal-img-des.svg';}
}

function previewImage(event, querySelector){
        //Recuperamos el input que desencadeno la acción
        inputRef = event.target;
        //Recuperamos la etiqueta img donde cargaremos la imagen
        //event.target.files.
        // Verificamos si existe una imagen seleccionada
        if(!inputRef.files.length) {return};
            // Obtener el input file
            const input = document.querySelector('input[type="file"]');
            // Obtener los archivos seleccionados
            const files = input.files;
            const newpreviewImages = [];
            // Crear un nuevo array con los archivos a mantener
            const newFiles = [];
            if(previewImages.length === 0) {}
            for (let i = 0; i < files.length; i++) {
                let found = false;
                if(previewImages.length > 0) {
                    for (let k = 0; k < previewImages.length; k++) {
                        
                        if (files[i].name == previewImages[k].name) {
                            found = true;
                            break;
                            
                        } else {}
                    }
                }else {mainpreviewImage = 0}
                
                // Si el archivo actual no es el que deseas borrar, agregarlo al nuevo array
                
                if (found === false) {
                    newpreviewImages.push(files[i]);
                   // alert(found)
                }
            }
            // Crear un nuevo objeto FileList a partir del nuevo array
            const newFileList = new DataTransfer();
            for (let i = 0; i < previewImages.length; i++) {
                newFileList.items.add(previewImages[i]);
            }
            for (let i = 0; i < newpreviewImages.length; i++) {
                newFileList.items.add(newpreviewImages[i]);
            }
            // Asignar el objeto FileList al input file
            input.files = newFileList.files;
            previewImages = newFileList.files;
            if (showingSlide < 0) {
                showingSlide = 0;
                //console.log(showingSlide + 000)
                objectURL = URL.createObjectURL(previewImages[0]);
                document.getElementById('previewImageDiv').classList.remove('hidden');
                document.getElementById('imgPreview').setAttribute('src',objectURL);
                document.getElementById('imgWebp').setAttribute('srcset',objectURL);
                document.getElementById('imgJPG').setAttribute('srcset',objectURL);
            }
            if(previewImages.length+uploadedImages.length == 1) {
                document.getElementById('btn-prev').classList.add('hidden');
                document.getElementById('btn-next').classList.add('hidden');
                
            }else{
                document.getElementById('btn-prev').classList.remove('hidden');
                document.getElementById('btn-next').classList.remove('hidden');
            }
            setmainimg();
            findmainimg();
    }


    function changePreviewSlide(n) {
        if(n === 1) {
            if (showingSlide+1 < uploadedImages.length) {
                showingSlide++;
                const url = '/images/'+uploadedImages[showingSlide];
                //alert(url);
                document.getElementById('imgPreview').setAttribute('src',url);
                document.getElementById('imgWebp').setAttribute('srcset',url);
                document.getElementById('imgJPG').setAttribute('srcset',url);
            } else if( previewImages.length+uploadedImages.length == 0 ) {
                showingSlide = 0;
                const url = '/images/'+uploadedImages[showingSlide];
                document.getElementById('imgPreview').setAttribute('src',url);
                document.getElementById('imgWebp').setAttribute('srcset',url);
                document.getElementById('imgJPG').setAttribute('srcset',url);
            }
            else {
                if (n === 1) {
                    showingSlide++;
                    //alert(previewImages.length+uploadedImages.length <= showingSlide);
                    if (previewImages.length+uploadedImages.length <= showingSlide) {
                        showingSlide = -1;
                        changePreviewSlide(1);
                        return;
                        }
                } 
              /*   else {
                        showingSlide--;
                        if ( showingSlide < 0 ) {
                            showingSlide = previewImages.length - 1;
                        }
                    } */
                try {
                    file = previewImages[showingSlide-uploadedImages.length];
                    objectURL = URL.createObjectURL(file);
                    document.getElementById('imgPreview').setAttribute('src',objectURL);
                    document.getElementById('imgWebp').setAttribute('srcset',objectURL);
                    document.getElementById('imgJPG').setAttribute('srcset',objectURL);
                }catch(err) {
                }
            }
        } else {
            if (showingSlide-1 < uploadedImages.length && showingSlide-1 >= 0) {
                showingSlide--;
                const url = '/images/'+uploadedImages[showingSlide];
                //alert(url);
                document.getElementById('imgPreview').setAttribute('src',url);
                document.getElementById('imgWebp').setAttribute('srcset',url);
                document.getElementById('imgJPG').setAttribute('srcset',url);
            } else if( showingSlide-1 < 0 && previewImages.length == 0) {
                showingSlide = previewImages.length+uploadedImages.length-1;
                const url = '/images/'+uploadedImages[showingSlide];
                document.getElementById('imgPreview').setAttribute('src',url);
                document.getElementById('imgWebp').setAttribute('srcset',url);
                document.getElementById('imgJPG').setAttribute('srcset',url);
            }
            else {
               /* if (n === 1) {
                    showingSlide++;
                    //alert(previewImages.length+uploadedImages.length <= showingSlide);
                    if (previewImages.length+uploadedImages.length <= showingSlide) {
                        showingSlide = -1;
                        changePreviewSlide(1);
                        return;
                        }
                } */
                        showingSlide--;
                        if ( showingSlide < 0 ) {
                            showingSlide = previewImages.length+uploadedImages.length - 1;
                        }
                try {
                    file = previewImages[showingSlide-uploadedImages.length];
                    objectURL = URL.createObjectURL(file);
                    document.getElementById('imgPreview').setAttribute('src',objectURL);
                    document.getElementById('imgWebp').setAttribute('srcset',objectURL);
                    document.getElementById('imgJPG').setAttribute('srcset',objectURL);
                }catch(err) {
                    
                }
            }
        }
        
        findmainimg();
    }

      function deletePreviewSlide() {
        if(showingSlide < uploadedImages.length) {
            deleteuploadedImages.push(uploadedImages[showingSlide]);
            const deletedImg = document.createElement('INPUT');
            deletedImg.type = 'hidden';
            deletedImg.value = uploadedImages[showingSlide];
            deletedImg.name = `imgdel[]`;
            document.getElementById('previewImageDiv').append(deletedImg);
            uploadedImages.splice(showingSlide,1);
           // alert(deleteuploadedImages)
            //changePreviewSlide(0);
        } else {
            // Obtener el input file
            const input = document.querySelector('input[type="file"]');
            // Obtener los archivos seleccionados
            const files = input.files;
            // Crear un nuevo array con los archivos a mantener
            const newpreviewImages = [];
            for (let i = 0; i < files.length; i++) {
                // Si el archivo actual no es el que deseas borrar, agregarlo al nuevo array
                if (i !== showingSlide-uploadedImages.length) {
                    newpreviewImages.push(files[i]);
                } else {
                    mainpreviewImage = 0;
                    findmainimg();
                }
            }
            // Crear un nuevo objeto FileList a partir del nuevo array
            const newFileList = new DataTransfer();
            for (let i = 0; i < newpreviewImages.length; i++) {
                 newFileList.items.add(newpreviewImages[i]);
            }
            // Asignar el objeto FileList al input file
            input.files = newFileList.files;
            //alert('A')
            previewImages = newFileList.files;
        }
        //previewImages = input.files;
        if (previewImages.length+uploadedImages.length == 0) {
            document.getElementById('previewImageDiv').classList.add('hidden');
            document.getElementById('imgPreview').setAttribute('src','');
            document.getElementById('imgWebp').setAttribute('srcset','');
            document.getElementById('imgJPG').setAttribute('srcset','');
            showingSlide = -1;
        } 
        if(previewImages.length+uploadedImages.length <= 1) {
            document.getElementById('btn-prev').classList.add('hidden');
            document.getElementById('btn-next').classList.add('hidden');
            
        }else{
            document.getElementById('btn-prev').classList.remove('hidden');
            document.getElementById('btn-next').classList.remove('hidden');
        }
        changePreviewSlide(0);
        if(mainpreviewImage == showingSlide+1) {
            mainpreviewImage = showingSlide;
            console.log(mainpreviewImage);
            findmainimg();
            document.getElementById('img-main').value = mainpreviewImage;
        }
      }



document.addEventListener('DOMContentLoaded', function() {
    startApp();
    eventListeners()
})
function startApp() {
// Utiliza la variable en JavaScript
    //findMyServices();
    //addlisteners();
}

async function getLocation() { 
    try {
        const url = 'http://localhost:3000/api/locations';
        const result = await fetch(url,{method: 'POST'});
        const locations = await result.json();
        provincias = locations['provincias'];
        cantones = locations['cantones'];
        distritos = locations['distritos'];
        plan = locations['plan'];
        category = locations['category'];
        //console.log(locations['distritos']);
        setLocationForm();
        setPlanForm();
    } catch (error) {
        
    }

}
function deletetag(e) {
    event.preventDefault();
    const element = document.getElementById("tag"+e);
    element.remove();
    tagcount--;
    elementsdivtag = document.getElementsByClassName('div-tag');
    for (let i = 0; i < elementsdivtag.length; i++) {
        elementsdivtag[i].id = 'tag'+i;
        
       
    }

    elementsbtntag = document.getElementsByClassName('btn-tag');
    for (let i = 0; i < elementsbtntag.length; i++) {
        elementsbtntag[i].onclick = function() { deletetag(i); };
    }

    elementsinputtag = document.getElementsByClassName('input-tag');
    for (let i = 0; i < elementsinputtag.length; i++) {
        elementsinputtag[i].name = `tags[${i}]`;
    }
    if (tagcount == 0) {
        
        addTag();
        
    }
}

function findUploadePictures() {
    const uploadedImagesObj = document.getElementsByClassName('my-image');
    for (let i = 0; i < uploadedImagesObj.length; i++) {
        
        uploadedImages.push(uploadedImagesObj[i].value);
    }
    mainpreviewImage = document.getElementById('img-main').value;
    const cantImg = previewImages.length+uploadedImages.length;

    
    showingSlide = 0;

    document.getElementById('previewImageDiv').classList.remove('hidden');
    document.getElementById('imgPreview').setAttribute('src',"/images/"+uploadedImages[showingSlide]);
    document.getElementById('imgWebp').setAttribute('srcset',"/images/"+uploadedImages[showingSlide]);
    document.getElementById('imgJPG').setAttribute('srcset',"/images/"+uploadedImages[showingSlide]);
    if(cantImg == 1 ) {
        document.getElementById('btn-prev').classList.add('hidden');
        document.getElementById('btn-next').classList.add('hidden');
        
    }else{
        document.getElementById('btn-prev').classList.remove('hidden');
        document.getElementById('btn-next').classList.remove('hidden');
    }
    findmainimg()
}

function findTagCount() {
    try {
        
        const elements = document.getElementsByClassName('my-tag');
        if(elements.length > 0) {

            tagcount = elements.length;
            if (tagcount == 0 || !tagcount) {
                
                
                tagcount = 1;
                const digtag = document.createElement('DIV');
                digtag.id = 'tag0';
                digtag.classList.add('div-tag');
            
            
            
                // Crear el elemento input
                const input = document.createElement('INPUT');
                input.type = 'text';
                input.classList.add('input-tag');
                input.id = 'tag';
                input.placeholder = 'Servicio que ofreces.';
                input.value = '';
                input.name = `tags[${0}]`;
            
                const buttonref = document.createElement('BUTTON');
                buttonref.onclick = function() { deletetag(0); };
            
            
                buttonref.classList.add('btn-tag');
                buttonref.textContent = ' X ';
            
            
                // Añadir el valor del servicio al input
                const slot = document.getElementById('tags');
                
                // Añadir el label
                digtag.appendChild(input);
                digtag.appendChild(buttonref);
                slot.appendChild(digtag);
                
                
                // Añadir el input y el label al div
                slot.style.display = 'block';
                slot.style.width = '100%';
                 return;
            }
            for (let i = 0; i < elements.length; i++) {
                const i = tagcount;
                const digtag = document.createElement('DIV');
                digtag.id = 'tag'+i;
                digtag.classList.add('div-tag');
            
            
            
                // Crear el elemento input
                const input = document.createElement('INPUT');
                input.type = 'text';
                input.classList.add('input-tag');
                input.id = 'tag';
                input.placeholder = 'Servicio que ofreces.';
                input.value = elements[i].value;
                input.name = `tags[${i}]`;
            
                const buttonref = document.createElement('BUTTON');
                buttonref.onclick = function() { deletetag(i); };
            
            
                buttonref.classList.add('btn-tag');
                buttonref.textContent = ' X ';
            
            
                // Añadir el valor del servicio al input
                const slot = document.getElementById('tags');
                
                // Añadir el label
                digtag.appendChild(input);
                digtag.appendChild(buttonref);
                slot.appendChild(digtag);
                
                
                // Añadir el input y el label al div
                slot.style.display = 'block';
                slot.style.width = '100%';
            }
        }
    } catch (error) {
        return;
    }
    
    //alert('setting up '+tagcount);
}


function addTag() {
    event.preventDefault();
    if(tagcount === 5) {
        Swal.fire({
            
            icon: 'error',
            title: 'ERROR',
            text: 'Lo sentimos, total de etiquetas ya agregadas',
            button: 'OK'
          })
        return;
    } 
    
// <div class="div-tag" id="tag0"></div>

    const i = tagcount;
    const digtag = document.createElement('DIV');
    digtag.id = 'tag'+i;
    digtag.classList.add('div-tag');



    // Crear el elemento input
    const input = document.createElement('INPUT');
    input.type = 'text';
    input.classList.add('input-tag');
    input.id = 'tag';
    input.placeholder = 'Servicio que ofreces.';
    input.value = '';
    input.name = `tags[${i}]`;

    const buttonref = document.createElement('BUTTON');
    buttonref.onclick = function() { deletetag(i); };


    buttonref.classList.add('btn-tag');
    buttonref.textContent = ' X ';


    // Añadir el valor del servicio al input
    const slot = document.getElementById('tags');
    
    // Añadir el label
    digtag.appendChild(input);
    digtag.appendChild(buttonref);
    slot.appendChild(digtag);
    
    
    // Añadir el input y el label al div
    slot.style.display = 'block';
    slot.style.width = '100%';
    tagcount++;
}
function setPlanForm() {
    const categoryselectElement = document.getElementById('categoryid');
        
        
        
        
        for (let i = 0; i < category.length; i++) {
            const option = document.createElement("OPTION");
            option.value = category[i]['id'];
            option.text = category[i]['name'];
            categoryselectElement.appendChild(option);
            
            try {
                const hcategoryid = document.getElementById('hcategoryid');
                if(hcategoryid.value == category[i]['id']) {
                    option.selected = true;
    
                } 
            } catch (error) {
                
            }
            
        }
        categoryselectElement.addEventListener('change', (event) => {

        });





    const planselectElement = document.getElementById('plan');

        
        for (let i = 0; i < plan.length; i++) {
            
                const option = document.createElement("OPTION");
                option.value = plan[i]['id'];
                option.text = plan[i]['name'];
                planselectElement.appendChild(option);
                try {
                    const hplanid = document.getElementById('hplanid');
                    if(hplanid.value == plan[i]['id']) {
                        option.selected = true;
        
                    } 
                } catch (error) {
                    
                }
        }
        planselectElement.addEventListener('change', (event) => {

        });

        

}
function setCategoryPanel() {

}
function setLocationForm() {
    // Obtener una referencia al elemento select
    const selectElement = document.getElementById("provincia");
    // Crear las opciones y agregarlas al select
    
    for (let i = 0; i < provincias.length; i++) {
        const option = document.createElement("OPTION");
        option.value = provincias[i]['id'];
        option.text = provincias[i]['name'];
        selectElement.appendChild(option);


        try {
            const hprovincia = document.getElementById('hprovincia');
            if(hprovincia.value == provincias[i]['name']) {
                option.selected = true;
                const idprov = provincias[i]['id'];
                const selectedValue = hprovincia.value;

                // Obtener una referencia al elemento select
                const selectElementCanton = document.getElementById("canton");

                const selectElementDistrito = document.getElementById("distrito");
                
                // Obtener una referencia a la opción predeterminada
                const defaultOptionC = document.getElementById("dcanton");

                // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
                for (let i = selectElementCanton.options.length - 1; i >= 0; i--) {
                    const option = selectElementCanton.options[i];
                    if (option !== defaultOptionC) {
                        selectElementCanton.remove(i);
                    }
                }
                
                // Crear las opciones y agregarlas al select
                let idcant = -1;
                for (let i = 0; i < cantones.length; i++) {
                    if (idprov == cantones[i]['idprovincia']) {
                        const option = document.createElement("OPTION");
                        option.value = cantones[i]['id'];
                        option.text = cantones[i]['name'];
                        
                        selectElementCanton.appendChild(option);
                        const hcanton = document.getElementById('hcanton');
                        //console.log(hcanton.value);
                        if(hcanton.value == cantones[i]['name']) {
                            option.selected = true;
                            idcant = cantones[i]['id'];
                        }
                    }
                    
                    //console.log(idcant);
                const defaultOptionD = document.getElementById("ddistrito");
                // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
                for (let i = selectElementDistrito.options.length - 1; i >= 0; i--) {
                    const option = selectElementDistrito.options[i];
                    if (option !== defaultOptionD) {
                        selectElementDistrito.remove(i);
                    }
                }
                for (let i = 0; i < distritos.length; i++) {
                    if (idcant == distritos[i]['idcanton']) {
                        const option = document.createElement("OPTION");
                        option.value = distritos[i]['id'];
                        option.text = distritos[i]['name'];
                        selectElementDistrito.appendChild(option);
                        const hdistrito = document.getElementById('hdistrito');
                    if(hdistrito.value == distritos[i]['name']) {
                        option.selected = true;
                }
                    }
                }
                const distritoselectElement = document.getElementById('canton');

                distritoselectElement.addEventListener('change', (event) => {
                    const selectedValue = event.target.value;
                    const defaultOptionD = document.getElementById("ddistrito");
                // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
                for (let i = selectElementDistrito.options.length - 1; i >= 0; i--) {
                    const option = selectElementDistrito.options[i];
                    if (option !== defaultOptionD) {
                        selectElementDistrito.remove(i);
                    }
                }
                    // Crear las opciones y agregarlas al select
                    console.log(selectedValue)
                    for (let i = 0; i < distritos.length; i++) {
                        if (selectedValue == distritos[i]['idcanton']) {
                            const option = document.createElement("OPTION");
                            option.value = distritos[i]['id'];
                            option.text = distritos[i]['name'];
                            selectElementDistrito.appendChild(option);
                            const hdistrito = document.getElementById('hdistrito');
                        if(hdistrito.value == distritos[i]['name']) {
                            option.selected = true;
                    }
                        }
                    }
                    
                })

        
        
        
               }   } 
                } catch (error) {
                    
                }
    }
    addlisteners();
}
function addlisteners() {
    const provinciaselectElement = document.getElementById('provincia');
    provinciaselectElement.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        try {
            if(event.target.value == '') {
                
                document.getElementById('select-box-canton').classList.add('hidden');
            } else {
                document.getElementById('select-box-canton').classList.remove('hidden');
    
            }
            
        } catch (error) {
            
        }
        // Obtener una referencia al elemento select
        const selectElementCanton = document.getElementById("canton");
        const selectElementDistrito = document.getElementById("distrito");
        // Obtener una referencia a la opción predeterminada
        const defaultOptionC = document.getElementById("dcanton");
        // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
        for (let i = selectElementCanton.options.length - 1; i >= 0; i--) {
            const option = selectElementCanton.options[i];
            if (option !== defaultOptionC) {
                selectElementCanton.remove(i);
            }
        }
        
        
        // Crear las opciones y agregarlas al select
        for (let i = 0; i < cantones.length; i++) {
            if (selectedValue == cantones[i]['idprovincia']) {
                const option = document.createElement("OPTION");
                option.value = cantones[i]['id'];
                option.text = cantones[i]['name'];
                selectElementCanton.appendChild(option);
            }
        }
        
        const defaultOptionD = document.getElementById("ddistrito");
        // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
        for (let i = selectElementDistrito.options.length - 1; i >= 0; i--) {
            const option = selectElementDistrito.options[i];
            if (option !== defaultOptionD) {
                selectElementDistrito.remove(i);
            }
        }

        const distritoselectElement = document.getElementById('canton');
        
        distritoselectElement.addEventListener('change', (event) => {
            const selectedValue = event.target.value;
            try {
                
                if(event.target.value == '') {
                
                    document.getElementById('select-box-distrito').classList.add('hidden');
                } else {
                    document.getElementById('select-box-distrito').classList.remove('hidden');
        
                }
            } catch (error) {
                
            }
            const defaultOptionD = document.getElementById("ddistrito");
        // Recorrer todas las opciones del select, excepto la opción predeterminada, y eliminarlas
        for (let i = selectElementDistrito.options.length - 1; i >= 0; i--) {
            const option = selectElementDistrito.options[i];
            if (option !== defaultOptionD) {
                selectElementDistrito.remove(i);
            }
        }
            // Crear las opciones y agregarlas al select
            for (let i = 0; i < distritos.length; i++) {
                if (selectedValue == distritos[i]['idcanton']) {
                    const option = document.createElement("OPTION");
                    option.value = distritos[i]['id'];
                    option.text = distritos[i]['name'];
                    selectElementDistrito.appendChild(option);
                }
            }
            
        })
        }
        );
        
    
        
}

function showSection() {
    const lastSection = document.querySelector('.show');
    if(lastSection){
        lastSection.classList.remove('show');
    }

    const section = document.querySelector(`#step-${step}`);
    section.classList.add('show');


    const lastTab = document.querySelector('.current');
    if(lastTab){
        lastTab.classList.remove('current');
    }

    const tab = document.querySelector(`[step="${step}"]`);
    tab.classList.add('current');
    findPagesButton();
}

function tabs() {
    const buttons = document.querySelectorAll('.tabs button');
    buttons.forEach(buttonNav => {
        buttonNav.addEventListener('click', function(e) {
            step = parseInt(e.target.attributes.step.value);
            showSection();
            findPagesButton();
        });
    })
}

function findPagesButton() {
    alert();
    const nextPage = document.querySelector('#btn-next');
    const backPage = document.querySelector('#btn-back');
    if(step === 1) {
        backPage.classList.add('hidden');
        nextPage.classList.remove('hidden');
    } else if (step === 3) {
        backPage.classList.remove('hidden');
        nextPage.classList.add('hidden');
        showResume();
    } else {
        backPage.classList.remove('hidden');
        nextPage.classList.remove('hidden');
    }
    
}
function nextPage() {
    const nextPage = document.querySelector('#btn-next');
    nextPage.addEventListener('click', function() {
        if(step >= nextPage) return;
        step++;
        showSection();
    });
}
function lastPage() {
    const lastPage = document.querySelector('#btn-back');
    lastPage.addEventListener('click', function(e) {
        if(step <= firstStep) return;
        step--;
        showSection();
    });
}

async function findMyServices() {
    try {
        id = document.getElementById('accountid').value;
        const data = new FormData();

        data.append('userid', id);
        //enviar el form con los datos, vamos a tratar de importar primero los servicios, despues imagenes y despues tags.
        let url = 'http://localhost:3000/api/services';
        const myservicesresult = await fetch(url,{
            method: 'POST',
            body: data
        });
        const services = await myservicesresult.json();
        console.log(services);
        if(services.length <= 0) {
            let html = `<h3>No hay servicios</h3>`;
            const productSection = document.getElementById("product-section");
            document.getElementById('product-section').style.gridTemplateColumns = 'repeat(1, 1fr)';
            productSection.innerHTML = html;
            return;
        }
        data.delete('userid');
        let imagesID = "";
        for (let i = 0; i < services.length; i++) {
            if(i===0) {

                imagesID = "'"+services[i].id+"'";
            }else {

                imagesID += ","+"'"+services[i].id+"'";
            }
        }
        
        data.append('serviceid', imagesID);

        //enviar el form con los datos, vamos a tratar de importar primero los servicios, despues imagenes y despues tags.
        url = 'http://localhost:3000/api/services/pictures';
        const myservicespicturesresult = await fetch(url,{
            method: 'POST',
            body: data
        });
        const servicesPictures = await myservicespicturesresult.json();
        url = 'http://localhost:3000/api/services/tags';
        const myservicestagsresult = await fetch(url,{
            method: 'POST',
            body: data
        });
        const servicesTags = await myservicestagsresult.json();
        //console.log(servicesPictures);
        //console.log(servicesTags);
        //console.log(services);
        data.delete('userid');
        
        url = 'http://localhost:3000/api/locations';
        const result = await fetch(url,{method: 'POST'});
        const locations = await result.json();
        provincias = locations['provincias'];
        cantones = locations['cantones'];
        distritos = locations['distritos'];
        plan = locations['plan'];
        category = locations['category'];
        
        showMyServices(services,servicesPictures,servicesTags);



        //console.log(services['0'].userid);
        //showServices(services);
    } catch (error) {
        console.log(error);
    }
}



function showMyServices(services,servicesPictures,servicesTags) {
     //console.log(tags);
     let html = ``;
     if(services.length <= 1) {
        document.getElementById('product-section').style.gridTemplateColumns = 'repeat(1, 1fr)';
     }
     console.log(services.length);
     //hay que escribir credencial
     services.forEach(service => {
         const serviceid = service.id;
         let imgurl = '';
         try {
             const objetosBuscados = servicesPictures.filter(obj => obj.serviceid == serviceid);
             const objetoBuscado = objetosBuscados.find(obj => obj.main == "1");
             imgurl = objetoBuscado.url;
            
         } catch (error) {
            
         }
         //console.log(objetoBuscado.url);
         const title = service.title;
        const descripcion = service.description;

        let provincia = '';
        let canton = '';
        let distrito = '';
        let direccion = '';
        let email = '';
        let tel = '';
        let tags = '';
        let categoria = '';
        let plans = '';
        let location_string = '';
        location_string += service.provincia;
            location_string += ', ';
            location_string += service.canton;
            location_string += ', ';
            location_string += service.distrito;
          category.forEach(function(element) {
            if(element.id == service.categoryid){
                categoria = element.name;
            }
          });
          plan.forEach(function(element) {
            if(element.id == service.planid){
                plans = element.name;
            }
          });
          let tag = "";
          let localtagcount = 0;
          servicesTags.forEach(function(element) {
            if(element.serviceid == service.id){
              
                if(localtagcount == 0) {
                    tag += element.name;
                    localtagcount++;
                } else {
                    tag += " | "+element.name;
                }
            }
          });
        email = service.email;
        tel = service.tel;
       
        html += `
        <fieldset>
            <legend>${categoria} - ${plans}</legend>
        <div class="product">
        <div class="slideshow-container" id="previewImageDiv">
                <div class="mySlides fade">
                    <picture>
                        <source id="imgWebp" srcset="/images/${imgurl}" type="image/webp">
                        <source id="imgJPG" srcset="/images/${imgurl}" type="image/jpeg">
                        <img style="max-height: 50rem" id="imgPreview" loading="lazy" src="/images/${imgurl}" >
                    </picture>
                </div>                 
    </div>
                    <h3>${title}</h3>
                    <p>${descripcion}</p>
                    <p>${tag}</p>
                    <p>${location_string}</p>
                  <!--  <p>${categoria}</p>
                    <p>${plans}</p> -->
                    <p>${email}</p>
                    <p>${tel}</p>
                    <a href="/services/edit?id=${serviceid}" class="button">Editar anuncio</a>
                    <a onclick="confirmDeleteService(${serviceid})" class="button">Eliminar anuncio</a>
                </div></fieldset>`;

            })
    const productSection = document.getElementById("product-section");
    productSection.innerHTML = html;
}



function confirmDeleteService(serviceid) {
    
    Swal.fire({
        title: 'Do you want to save the changes?',
       
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: 'red',
        confirmButtonText: 'Confirmar',
       
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            deleteService(serviceid);
        } 
      })
}
async function deleteService(serviceid) {
    
    const data = new FormData();
    data.append('serviceid', serviceid);
    
    //enviar el form con los datos, vamos a tratar de importar primero los servicios, despues imagenes y despues tags.
    url = 'http://localhost:3000/api/services/delete';
    const result = await fetch(url,{
        method: 'POST',
        body: data
    });
    const solved = await result.json();
    console.log(solved);
    if(solved) {
        Swal.fire({
            icon: 'success',
            title: '¡LISTO!',
            text: 'Su servicio se ha eliminida correctamente',
            //footer: '<a href="">Why do I have this issue?</a>'
            button: 'OK'
          }).then(() =>{
           
            location.reload();
            
            
          })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Lo sentimos, se ha producido un error al eliminar el servicio',
            button: 'OK'
          })

    }
    
}

async function queryAPI() {
    console.log('result');
    try {
        const url = 'http://localhost:3000/api/services';
        const result = await fetch(url);
        const services = await result.json();
        console.log(services.userid);
        showServices(services);
    } catch (error) {
        console.log(error);
    }
}

function showServices(services) {
    
    const title = "Título del producto";
const descripcion = "Descripción del producto";
const x = `<div class="product">
                <h3>${title}</h3>
                <p>${descripcion}</p>
                <a href="#" class="button">Editar anuncio</a>
            </div>`;

const productSection = document.getElementById("product-section");
productSection.innerHTML = x;
    /*
    services.forEach(service => {
        const {id, name, price} = service;
        const nameService = document.createElement('P');
        nameService.classList.add('name-service');
        nameService.textContent = name;

        const priceService = document.createElement('P');
        priceService.classList.add('price-service');
        priceService.textContent = `$${price}`;

        const divService = document.createElement('DIV');
        divService.classList.add('service');
        divService.dataset.idService = id;
        divService.onclick = function() {
            selectService(service);
        };
        divService.appendChild(nameService);
        divService.appendChild(priceService);
        document.querySelector('#services').appendChild(divService);
    })
    */
}


function selectService(service) {
    const {id} = service;
    const {services} = Appointment;
    const divService = document.querySelector(`[data-id-service="${id}"]`);

    if( services.some( item => item.id === id )) {
        Appointment.services = services.filter( item => item.id !== id);
        divService.classList.remove('selected');
    } else {

        Appointment.services = [...services,service];
        divService.classList.add('selected');
    }

}
function findID() {
    myid = document.querySelector('#accountid').value;
    //alert(myid);
}
function findName() {
    Appointment.name = document.querySelector('#name').value;
}

function findDate() {
    
    const inputDate = document.querySelector('#date');
    inputDate.addEventListener('input', function(e) {
        const day = new Date(e.target.value).getUTCDay();
        
        if ([6,0].includes(day)) {
            //alert('A');
            showmAlert('Fines de semana no abrimos','error','.form',true);
            
                
                e.target.value = '';
            
            
        
        } else {
            Appointment.date = e.target.value;
        }
    });
}
function findTime() {
    const inputTime = document.querySelector('#time');
    inputTime.addEventListener('input', function(e) {
        const dateTime = e.target.value;
        const time = dateTime.split(":")[0];
        if(time < 10 || time > 18) {
            showmAlert('Hora no válida','error','.form',true);
            e.target.value = '';
        } else {
            Appointment.time = e.target.value;
        }
    })
}

function showmAlert(mtext, mtype, mwhere, isHidden = true) {
    const preAlert = document.querySelector('.alert');

    if (preAlert) {preAlert.remove()};
    const malert = document.createElement('DIV');
    malert.textContent = mtext;
    malert.classList.add('alert');
    malert.classList.add(mtype);
    const mform = document.querySelector(mwhere);
    mform.appendChild(malert);
    if(isHidden) {

    
        setTimeout(() => {
            malert.remove();
        }, 3000);
    }
}

function showResume() {
    const resume = document.querySelector('.list-resume');
    
   
    
        while(resume.firstChild) {
            resume.removeChild(resume.firstChild);
        }
    
    if(Object.values(Appointment).includes('') || Appointment.services.length === 0) {
        showmAlert('Falta información', 'error', '.list-resume',false);
        return;
    }

    const {name, date, time, services} = Appointment;
    const dateObj = new Date(date);
    const month = dateObj.getMonth();
    const day = dateObj.getDate() + 2;
    const year = dateObj.getFullYear();
    const dateUTC = new Date(Date.UTC(year,month,day));
    const opt = {weekday: 'long', year: 'numeric', month:'long',day:'numeric'};
    const newDate = dateUTC.toLocaleDateString('es-MX',opt);

    const clientName = document.createElement('P');
    clientName.innerHTML = `<span>Nombre: </span>${name}`;
    const clientDate = document.createElement('P');
    clientDate.innerHTML = `<span>Fecha: </span>${newDate}`;
    const clientTime = document.createElement('P');
    clientTime.innerHTML = `<span>Hora: </span>${time}`;

    resume.appendChild(clientName);
    resume.appendChild(clientDate);
    resume.appendChild(clientTime);

    services.forEach(service => {
        const {id,price,name} = service;
        const containerService = document.createElement('DIV');
        containerService.classList.add('container-service');
        
        const textService = document.createElement('P');
        textService.textContent = name;
        
        const priceService = document.createElement('P');
        priceService.innerHTML = `<span>Precio: </span> $${price}`;
        
        
        containerService.appendChild(textService);
        
        containerService.appendChild(priceService);
        
        resume.appendChild(containerService);
        
    });
    const btnBook = document.createElement('BUTTON');
   
    btnBook.classList.add('button');
    btnBook.textContent = 'Reservar';
    btnBook.onclick = bookDate;

    resume.appendChild(btnBook);
}


 async function bookDate() {
    const {id, date, time,services} = Appointment;
    const idServices = services.map(service => service.id);
    const data = new FormData();
    data.append('userID', id);
    data.append('date', date);
    data.append('time', time);
    
    //console.log([...data]);
    //console.log(data);
    try {
        const url = 'http://localhost:3000/api/dates';
        const solved = await fetch(url,{
        method: 'POST',
        body: data
    });
    const result = await solved.json();
    console.log(result);
    if(result.result) {
        Swal.fire({
            icon: 'success',
            title: '¡LISTO!',
            text: 'Su cita se ha creado correctamente!',
            //footer: '<a href="">Why do I have this issue?</a>'
            button: 'OK'
          }).then(() =>{
            setTimeout(() => {
                window.location.reload();
            }, 1500);
            
          })
    }
    } catch (error) {
        Swal.fire({
            
            icon: 'error',
            title: 'ERROR',
            text: 'Lo sentimos, se ha producido un error al crear la cita',
            button: 'OK'
          })
    }
    //PETICION API
    const result = await solved.json();
    console.log(result.result);
 }



 async function createToken() {
     const id = document.getElementById('accountid').value;
     // Obtener la fecha de hoy
     const today = new Date();
     
     // Obtener el año, mes y día en formato numérico
     const year = today.getFullYear();
     const month = ("0" + (today.getMonth() + 1)).slice(-2); // Agregar ceros a la izquierda si el mes es menor a 10
     const day = ("0" + today.getDate()).slice(-2); // Agregar ceros a la izquierda si el día es menor a 10
     
     // Crear la fecha en formato "año-mes-día"
     const date = `${year}-${month}-${day}`;
     
     
     
     // Obtener la hora actual
     const now = new Date();
     
     // Obtener la hora, minutos y segundos en formato numérico
     const hour = ("0" + now.getHours()).slice(-2); // Agregar ceros a la izquierda si la hora es menor a 10
     const minute = ("0" + now.getMinutes()).slice(-2); // Agregar ceros a la izquierda si los minutos son menores a 10
     const second = ("0" + now.getSeconds()).slice(-2); // Agregar ceros a la izquierda si los segundos son menores a 10
     
     // Crear la hora en formato "hora:minuto:segundo"
     const time = `${hour}:${minute}:${second}`;
     
     // Almacenar la fecha en MySQL
     // Almacenar la hora en MySQL
     
     
     const data = new FormData();
     data.append('userID', id);
     data.append('date', date);
     data.append('time', time);
     
     //console.log(data);
     
     //console.log([...data]);
     //console.log(data);
     try {
        const url = 'http://localhost:3000/api/createtoken';
        const solved = await fetch(url,{method: 'POST',body: data});
        const result = await solved.json();
        console.log(result);
        if(result.result) {
            Swal.fire({
                icon: 'success',
                title: 'Verifica tu identidad',
                text: 'Hemos enviado la solicitud de cambio de contraseña a tu correo electronico, por favor revisalo.',
                //footer: '<a href="">Why do I have this issue?</a>'
              })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Verifica tu identidad',
                text: 'Algo ha acorrido, revisa tu email o intentalo nuevamente más tarde.',
                //footer: '<a href="">Why do I have this issue?</a>'
              })
        }
        
    } catch (error) {
        
    }
    
 }
 function confirmSendInstructions() {
    Swal.fire({
        title: '¿Solicitar cambio de contraseña?',
        text: "Enviaremos las instrucciones al correo electrónico",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Solicitar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            createToken()
        }
      })
 }
