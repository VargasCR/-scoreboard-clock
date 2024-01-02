let admin_provincias = [];
let admin_cantones = [];
let admin_distritos = [];
let admin_plan = [];
let admin_category = [];

let admin_index_pictures = {};

let showing_admin_img_index = {};

let confirmed_admin_index = {};


async function saveAdminChanges() {
    try {
    const data = new FormData();
    let negativeValues = [];
    let positiveValues = [];

    for (let key in confirmed_admin_index) {
    if (confirmed_admin_index[key] === -1) {
        negativeValues.push("'" + key + "'");
    } else if (confirmed_admin_index[key] === 1) {
        positiveValues.push("'" + key + "'");
    }
    }

    let negativeValuesString = negativeValues.join(',');
    let positiveValuesString = positiveValues.join(',');
    

    data.append('negativeValues', negativeValuesString);
    data.append('positiveValues', positiveValuesString);
    //enviar el form con los datos, vamos a tratar de importar primero los servicios, despues imagenes y despues tags.
    let url = 'http://localhost:3000/api/admin/services/confirm';
    const myservicesresult = await fetch(url,{
        method: 'POST',
        body: data
    });
    const result = await myservicesresult.json();
    location.reload();
} catch {

}
}
function confirmService(e) {
    confirmed_admin_index[e] = 1;
    document.getElementById('fs-'+e).style.borderColor = 'green';
    document.getElementById('ls-'+e).style.color = 'green';

}
function declineService(e) {
    //alert(e);
    confirmed_admin_index[e] = -1;
    console.log(confirmed_admin_index)
    document.getElementById('fs-'+e).style.borderColor = 'red';
    document.getElementById('ls-'+e).style.color = 'red';

}

function changePublicPreviewSlide(x,y) {
    
 
    if(x === 1) {
        if (showing_admin_img_index[y]+1 < admin_index_pictures[y].length) {
            showing_admin_img_index[y]++;
            const url = '/images/'+admin_index_pictures[y][showing_admin_img_index[y]].url;
            document.getElementById('imgPreview' +y).setAttribute('src',url);
            document.getElementById('imgWebp' +y).setAttribute('srcset',url);
            document.getElementById('imgJPG' +y).setAttribute('srcset',url);
        } else {
            //alert('url');
            showing_admin_img_index[y] = 0;
            
            const url = '/images/'+admin_index_pictures[y][showing_admin_img_index[y]].url;
            console.log(url);
            document.getElementById('imgPreview' +y).setAttribute('src',url);
            document.getElementById('imgWebp' +y).setAttribute('srcset',url);
            document.getElementById('imgJPG' +y).setAttribute('srcset',url);
        }
    //alert(showing_public_img_index);
} else {
    if(showing_admin_img_index[y]-1 < 0) {
        //alert('url');
        showing_admin_img_index[y] = admin_index_pictures[y].length-1;
            
        const url = '/images/'+admin_index_pictures[y][showing_admin_img_index[y]].url;
        console.log(url);
        document.getElementById('imgPreview' +y).setAttribute('src',url);
        document.getElementById('imgWebp' +y).setAttribute('srcset',url);
        document.getElementById('imgJPG' +y).setAttribute('srcset',url);
    } else {
        showing_admin_img_index[y]--;
            const url = '/images/'+admin_index_pictures[y][showing_admin_img_index[y]].url;
            document.getElementById('imgPreview' +y).setAttribute('src',url);
            document.getElementById('imgWebp' +y).setAttribute('srcset',url);
            document.getElementById('imgJPG' +y).setAttribute('srcset',url);
    }
}
}

async function findVerifiedServices() {
   
    try {
        
        const data = new FormData();
        data.append('code', 'codeToGet');
        //enviar el form con los datos, vamos a tratar de importar primero los servicios, despues imagenes y despues tags.
        let url = 'http://localhost:3000/api/admin/services';
        const myservicesresult = await fetch(url,{
            method: 'POST',
            body: data
        });
        const services = await myservicesresult.json();
        console.log(services);
        if(services.services === null || services.services.length <= 0) {
            const productSection = document.getElementById("product-section");
            let html = `<h3>No hay servicios</h3>`;
           
            productSection.innerHTML = html;
            return;
        } else {
            
            showVerifiedServices(services['services'],services['pictures'],services['tags']);
        }
    } catch{

    }
}



function showVerifiedServices(services,servicesPictures,servicesTags) {
    let html = ``;
    admin_index_pictures = servicesPictures;
    
    //hay que escribir credencial
    services.forEach(service => {
        const serviceid = service.id;
        
        let imgurl = '';
        console.log(servicesPictures);
        try {
          

    for (let key in servicesPictures) {
    if (servicesPictures[key].length > 0) {
        let indexPicture = 0;
        servicesPictures[key].forEach(obj => {
        if (obj.serviceid == serviceid && obj.main == "1") {
            imgurl = obj.url;
            showing_admin_img_index[obj.serviceid] = indexPicture;
            confirmed_admin_index[obj.serviceid] = 0;
        }
        indexPicture++;
        });
    }
    }

    console.log(imgurl);

            
        } catch (error) {
            
        }
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
        admin_category.forEach(function(element) {
            if(element.id == service.categoryid){
                categoria = element.name;
            }
        });
        admin_plan.forEach(function(element) {
            if(element.id == service.planid){
                plans = element.name;
            }
        });
        
        let tag = "";
        let localtagcount = 0;
        for (let key in servicesTags) {
            servicesTags[key].forEach(element => {
                if (element.serviceid == service.id) {
                    if (localtagcount === 0) {
                        tag += element.name;
                        localtagcount++;
                    } else {
                        tag += " | " + element.name;
                    }
                }
            });
        }
        
        
        
        email = service.email;
        tel = service.tel;
        
       
        const legend = ' ' + categoria +' '+plans+' ';

        html += `
        <fieldset id="fs-${serviceid}">
            <legend id="ls-${serviceid}" style='padding: 0 0.5rem;'>${legend}</legend>
        <div class="product">
        <div class="slideshow-container" id="previewImageDiv">
                <div class="mySlides fade">
                    <picture>
                        <source id="imgWebp${serviceid}" srcset="/images/${imgurl}" type="image/webp">
                        <source id="imgJPG${serviceid}" srcset="/images/${imgurl}" type="image/jpeg">
                        <img style="max-height: 50rem" id="imgPreview${serviceid}" loading="lazy" src="/images/${imgurl}" >
                    </picture>

                    </div>`
                    if (servicesPictures[serviceid].length > 1) {
                        html += 
                        `
                        <a class="prev" id="btn-prev " onclick="changePublicPreviewSlide(0, ${serviceid})">&lt;</a>
                        <a class="next" id="btn-next" onclick="changePublicPreviewSlide(1, ${serviceid})">&gt;</a>
                        `
                    }
        html += `</div>
                    <h3>${title}</h3>
                    <p>${descripcion}</p>
                    <p>${tag}</p>
                    <p>${location_string}</p>
                  <!--  <p>${categoria}</p>
                    <p>${plans}</p> -->
                    <p>${email}</p>
                    <p>${tel}</p>
                    
                    <a id="btnd-${serviceid}" onclick="declineService(${serviceid})" class="button btn-orange">Eliminar anuncio</a>
                    <a id="btnc-${serviceid}" onclick="confirmService(${serviceid})" class="button btn-green">Confirmar anuncio</a>
                </div></fieldset>`;

            })
    const productSection = document.getElementById("product-section");
    productSection.innerHTML = html;
}
async function getLocation() { 
    try {
        const url = 'http://localhost:3000/api/locations';
        const result = await fetch(url,{method: 'POST'});
        const locations = await result.json();
        admin_provincias = locations['provincias'];
        admin_cantones = locations['cantones'];
        admin_distritos = locations['distritos'];
        admin_plan = locations['plan'];
        admin_category = locations['category'];
        
       // console.log(admin_provincias);
    } catch (error) {
        
    }
    
}
getLocation();
findVerifiedServices();