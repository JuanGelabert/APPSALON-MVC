function iniciarApp(){buscarPorFecha()}function buscarPorFecha(){document.querySelector("#fecha").addEventListener("input",(function(n){const e=n.target.value;window.location="?fecha="+e}))}function alertaEliminar(){const n=document.querySelector(".boton-eliminar");console.log(n),n.onclick=function(n){Swal.fire({title:"Desea eliminar el registro?",text:"No podrás revertir los cambios",icon:"warning",showCancelButton:!0,confirmButtonColor:"#0da6f3",cancelButtonColor:"#d33",confirmButtonText:"Eliminar cita"}).then(e=>{e.isConfirmed?Swal.fire("Eliminado!","La cita ha sida eliminada."):n.preventDefault()})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));