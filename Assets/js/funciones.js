let tblUsuarios;

document.addEventListener("DOMContentLoaded" , function(){
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [ {
            'data' : 'id'
            },
            {
                'data' : 'usuario'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'nombre_rol'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
             
            
         ]
    });
})



function frmUsuario(){
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar ";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();

    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}

function registerUser(e){
    e.preventDefault();
    const usuario=document.getElementById("usuario");
    const nombre=document.getElementById("nombre");
    const clave=document.getElementById("clave");
    const confirmar=document.getElementById("confirmar");
    const rol=document.getElementById("rol");
    
    if(usuario.value =="" || nombre.value ==""   || rol.value ==""){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los Campos son Obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else {
        const url=base_url + "Usuarios/registrar";
        const frm=document.getElementById("frmUsuario");
        const http=new XMLHttpRequest();
        http.open("POST", url, true );
        http.send(new FormData(frm));
        
        http.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registrado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                 }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })   
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                }else{
                     
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No se puede crear el Usuario, ...ya Existe o las Contraseñas no coinciden',
                        showConfirmButton: false,
                        timer: 3000
                    })
                 }
            }
        }
    }
}

function btnEditarUser(id){
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Actualizar ";


        const url=base_url + "Usuarios/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET", url, true );
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send();
        
        http.onreadystatechange=function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("usuario").value = res.usuario;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("rol").value = res.id_rol;
                document.getElementById("claves").classList.add("d-none");
                $("#nuevo_usuario").modal("show");
            }
        }
   
}


function btnEliminarUser(id){
    Swal.fire({
        title: 'Está Seguro de Eliminar?',
        text: "El Usuario no se eliminará de forma permanente, pasará a estado Inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Inactivar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Usuario";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Usuarios/eliminar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Usuario Inactivado con Éxito.',
                                'success'
                            )
                            tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

function btnReactivarUser(id){
    Swal.fire({
        title: 'Está Seguro de Reactivar?',
        text: "El Usuario pasará a estado Activo nuevamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Activar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Usuario";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Usuarios/reactivar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Usuario Reactivado con Éxito.',
                                'success'
                            )
                            tblUsuarios.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

//fin del usuario-----------------empieza Tercero

let tblTerceros;

document.addEventListener("DOMContentLoaded" , function(){
    tblTerceros = $('#tblTerceros').DataTable({
        ajax: {
            url: base_url + "Terceros/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'documento'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'telefono'
            },
            {
                'data' : 'direccion'
            },
            {
                'data' : 'ciudad'
            },
            {
                'data' : 'nombre_tipos'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
             
            
         ]
    });
})

function frmTercero(){
    document.getElementById("title").innerHTML = "Nuevo tercero";
    document.getElementById("btnAccion").innerHTML = "Registrar ";
    //document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmTercero").reset();

    $("#nuevo_tercero").modal("show");
    document.getElementById("id").value = "";
}

function registerTercero(e){
    e.preventDefault();
    const documento=document.getElementById("documento");
    const nombre=document.getElementById("nombre");
    const telefono=document.getElementById("telefono");
    const direccion=document.getElementById("direccion");
    const ciudad=document.getElementById("ciudad");
    const tipo=document.getElementById("tipo");
    
    if(documento.value =="" || nombre.value ==""   ){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Los Campos Documento y Nombre son Obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else {
        const url=base_url + "Terceros/registrar";
        const frm=document.getElementById("frmTercero");
        const http=new XMLHttpRequest();
        http.open("POST", url, true );
        http.send(new FormData(frm));
        
        http.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Tercero registrado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_tercero").modal("hide");
                    tblTerceros.ajax.reload();
                 }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'tercero modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })   
                    $("#nuevo_tercero").modal("hide");
                    tblTerceros.ajax.reload();
                }else{
                     
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No se puede crear el tercero, ...ya Existe',
                        showConfirmButton: false,
                        timer: 3000
                    })
                 }
            }
        }
    }
}

function btnEditarTercero(id){
    document.getElementById("title").innerHTML = "Actualizar Tercero";
    document.getElementById("btnAccion").innerHTML = "Actualizar ";


        const url=base_url + "Terceros/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET", url, true );
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send();
        
        http.onreadystatechange=function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("documento").value = res.documento;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("telefono").value = res.telefono;
                document.getElementById("direccion").value = res.direccion;
                document.getElementById("ciudad").value = res.ciudad;
                document.getElementById("tipo").value = res.id_tipo;
                
                $("#nuevo_tercero").modal("show");
            }
        }
   
}


function btnEliminarTercero(id){
    Swal.fire({
        title: 'Está Seguro de Eliminar?',
        text: "El Tercero no se eliminará de forma permanente, pasará a estado Inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Inactivar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Tercero";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Terceros/eliminar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Tercero Inactivado con Éxito.',
                                'success'
                            )
                            tblTerceros.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

function btnReactivarTercero(id){
    Swal.fire({
        title: 'Está Seguro de Reactivar?',
        text: "El Tercero pasará a estado Activo nuevamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Activar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Tercero";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Terceros/reactivar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Tercero Reactivado con Éxito.',
                                'success'
                            )
                            tblTerceros.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

//fin del tercero-----------------empieza Categoria

let tblCategorias;

document.addEventListener("DOMContentLoaded" , function(){
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        columns: [ 
            
            {
                'data' : 'nombre'
            },
            {
                'data' : 'imagen'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
             
            
         ]
    });
})

function frmCategoria(){
    document.getElementById("title").innerHTML = "Nueva Categoria";
    document.getElementById("btnAccion").innerHTML = "Registrar ";
    //document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmCategoria").reset();
    document.getElementById("id").value = "";
    $("#nuevo_categoria").modal("show");
    
    deleteImg();
}

function registerCategoria(e){
    e.preventDefault();
    const nombre=document.getElementById("nombre");
    const imagen=document.getElementById("imagen");
        
    if(nombre.value ==""   ){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'El Campo Nombre es Obligatorio',
            showConfirmButton: false,
            timer: 3000
          })
    }else {
        const url=base_url + "Categorias/registrar";
        const frm=document.getElementById("frmCategoria");
        const http=new XMLHttpRequest();
        http.open("POST", url, true );
        http.send(new FormData(frm));
        
        http.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                const res = JSON.parse(this.responseText);
                
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Categoria registrada con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_categoria").modal("hide");
                    tblCategorias.ajax.reload();
                 }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Categoria modificada con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })   
                    $("#nuevo_categoria").modal("hide");
                    tblCategorias.ajax.reload();
                }else{
                     
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No se puede crear la Categoria, ...ya Existe',
                        showConfirmButton: false,
                        timer: 3000
                    })
                 }
                
                
            }
        }
    }
}

function btnEditarCategoria(id){
    document.getElementById("title").innerHTML = "Actualizar Categoria";
    document.getElementById("btnAccion").innerHTML = "Actualizar ";


        const url=base_url + "Categorias/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET", url, true );
        //http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send();
        
        http.onreadystatechange=function(){
            console.log(http);
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("img-preview").src = base_url + 'Assets/img/'+res.imagen;
              
                document.getElementById("icon-cerrar").innerHTML = `
                <button class= "btn btn-danger" onclick="deleteImg()">
                <i class= "fas fa-times"></i></button>`;
                document.getElementById("icon-image").classList.add("d-none");

                document.getElementById("foto_actual").value = res.imagen;
               

                $("#nuevo_categoria").modal("show");
            }
        }
   
}


function btnEliminarCategoria(id){
    Swal.fire({
        title: 'Está Seguro de Eliminar?',
        text: "La Categoria no se eliminará de forma permanente, pasará a estado Inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Inactivar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Categoria";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Categorias/eliminar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Categoria Inactivada con Éxito.',
                                'success'
                            )
                            tblCategorias.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

function btnReactivarCategoria(id){
    Swal.fire({
        title: 'Está Seguro de Reactivar?',
        text: "La Categoria pasará a estado Activo nuevamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Activar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Categoria";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Categorias/reactivar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Categoria Reactivada con Éxito.',
                                'success'
                            )
                            tblCategorias.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

function preview(e){
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTmp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML = `
    <button class= "btn btn-danger" onclick="deleteImg()"><i class= "fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg(){
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
   
}

//termina Categoria----------empieza Productos


let tblProductos;

document.addEventListener("DOMContentLoaded" , function(){
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [ 
            /*{
                'data' : 'codigo'
            },*/
            {
                'data' : 'nombre'
            },
            {
                'data' : 'valor_compra'
            },
            {
                'data' : 'valor_venta'
            },
            {
                'data' : 'cantidad'
            },
            {
                'data' : 'nombre_categoria'
            },
            {
                'data' : 'estado'
            },
            {
                'data' : 'acciones'
            }
             
            
         ]
    });
})

function frmProducto(){
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar ";
    //document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");
    
    
}

function registerProducto(e){
    e.preventDefault();
    const codigo= document.getElementById("nombre");
    const nombre=document.getElementById("nombre");
    const valor_compra=document.getElementById("valor_compra");
    const valor_venta=document.getElementById("valor_venta");
    const cantidad=document.getElementById("cantidad");
    const categoria=document.getElementById("categoria");

    
    
        
    if(nombre.value ==""   ){
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'El Campo Nombre es Obligatorio',
            showConfirmButton: false,
            timer: 3000
          })
    }else {
        const url=base_url + "Productos/registrar";
        const frm=document.getElementById("frmProducto");
        const http=new XMLHttpRequest();
        http.open("POST", url, true );
        http.send(new FormData(frm));
        
        http.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto registrado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                 }else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })   
                    $("#nuevo_producto").modal("hide");
                    tblProductos.ajax.reload();
                }else{
                     
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No se puede crear el Producto, ...ya Existe',
                        showConfirmButton: false,
                        timer: 3000
                    })
                 }
                
                
            }
        }
    }
}

function btnEditarProducto(id){
    document.getElementById("title").innerHTML = "Actualizar Producto";
    document.getElementById("btnAccion").innerHTML = "Actualizar ";

    //console.log(id);

        const url=base_url + "Productos/editar/"+id;
        const http=new XMLHttpRequest();
        http.open("GET", url, true );
        //http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send();
        
        http.onreadystatechange=function(){
            //console.log(http);
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("codigo").value = res.codigo;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("valor_compra").value = res.valor_compra;
                document.getElementById("valor_venta").value = res.valor_venta;
                document.getElementById("cantidad").value = res.cantidad;
                document.getElementById("categoria").value = res.id_categoria;

                $("#nuevo_producto").modal("show");
            }
        }
   
}


function btnEliminarProducto(id){
    Swal.fire({
        title: 'Está Seguro de Eliminar?',
        text: "El Producto no se eliminará de forma permanente, pasará a estado Inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Inactivar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Producto";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";

                //console.log(id);
                const url=base_url + "Productos/eliminar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Producto Inactivado con Éxito.',
                                'success'
                            )
                            tblProductos.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

function btnReactivarProducto(id){
    Swal.fire({
        title: 'Está Seguro de Reactivar?',
        text: "El Producto pasará a estado Activo nuevamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Activar!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("title").innerHTML = "Actualizar Producto";
            document.getElementById("btnAccion").innerHTML = "Actualizar ";


                const url=base_url + "Productos/reactivar/" + id;
                const http=new XMLHttpRequest();
                http.open("GET", url, true );
                http.send();
                
                http.onreadystatechange=function(){
                    if(this.readyState == 4 && this.status == 200){
                        const res = JSON.parse(this.responseText);
                        if (res == "ok"){
                            Swal.fire(
                                'Mensaje!',
                                'Producto Reactivado con Éxito.',
                                'success'
                            )
                            tblProductos.ajax.reload();
                        }else{
                            Swal.fire(
                                'Mensaje!',
                                res,
                                'error'
                            )
                        }
                    }
                }
                }
            })
}

/*function preview(e){
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTmp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML = `
    <button class= "btn btn-danger" onclick="deleteImg()"><i class= "fas fa-times"></i></button>
    ${url['name']}`;
}

function deleteImg(){
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
   
}*/



