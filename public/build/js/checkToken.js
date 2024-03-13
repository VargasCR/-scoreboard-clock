const tk31="f2bc4d2b",tk72="ba63f356",tk63="30d598f9",tk24="3f18253b";

function setCheckToken(e){
    localStorage.setItem("tokenPass",e)
}
function getCheckToken(){
    localStorage.getItem("tokenPass")||Swal.fire({allowOutsideClick:!1,title:"Contraseña",input:"text",inputAttributes:{autocapitalize:"off"},allowEscapeKey:!1,showCancelButton:!1,confirmButtonText:"Comprobar",showLoaderOnConfirm:!0,preConfirm:async()=>{},allowOutsideClick:()=>!Swal.isLoading()}).then(e=>{e.isConfirmed?e.value==tk31+tk72+tk63+tk24?(setCheckToken(e.value),Swal.fire({title:"Usuario Aceptado"})):Swal.fire({title:"Usuario No Encontrado"}).then(()=>{getCheckToken()}):(e.dismiss===Swal.DismissReason.cancel||(e.dismiss,Swal.DismissReason.esc),getCheckToken())})}