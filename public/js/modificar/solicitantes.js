$().ready(function(){
    $("#solicitantesDropdown").addClass("active");
    $("#formulario_buscador").addClass("d-none");
    $("#barra_navegacion").removeClass("navbar-expand-lg");
    $("#barra_navegacion").addClass("navbar-expand-md");
    
    var exp=/[a-z0-9]/i;
    $("#nombre").keyup(function(){
        if( $(this).val().match(exp) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    var numb=/^[0-9]+$/;
    $("#telefono").keyup(function(){
        if( numb.test($(this).val()) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#asunto").keyup(function(){
        if( $(this).val().match(exp) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    var corr= /^[0-9a-záéíóú{}!"#$&/()=?¿_-]+[@][0-9a-záéíóú{}!"#$&/()=?¿_-]+\.[0-9a-záéíóú{}!"#$&/()=?¿_-]+$/i;
    $("#correo").keyup(function(){
        if( corr.test($(this).val()) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#fecha").change(function(){
        if( $(this).val()!="" ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#hora").change(function(){
        if( $(this).val()!="" ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#formulario").submit(function(e){
        e.preventDefault();
        var formulario = $(this);
        var token = formulario.find("input[name=_token]");
        $.ajax({
            headers:{"X-CSRF-TOKEN":token},
            url:formulario.attr("action"),
            type:formulario.attr("method"),
            data:formulario.serialize(),
            success:function(respuesta){
                if(respuesta=="Se Modificó Solicitante Correctamente"){
                    $("#modal_success").html(respuesta);
                    $("#modal-success").modal("show");
                    $("#modal-success").on("hidden.bs.modal",function(){
                        location.reload();
                    });
                }
                else{
                    if(respuesta=="reload"){
                        location.reload();
                    }
                    else{
                        $("#modal_danger").html(respuesta);
                        $("#modal-danger").modal("show");
                    }
                }
            },
            error:function(error){
                console.log("el error es:"+error);
                if(error.responseJSON.errors){
                    var errors= error.responseJSON.errors;
                    if(errors.nombre){
                        $("#error_nombre").html(errors.nombre[0]);
                        $("#nombre").removeClass("is-valid");
                        $("#nombre").addClass("is-invalid");
                    }
                    if(errors.telefono){
                        $("#error_telefono").html(errors.telefono[0]);
                        $("#telefono").removeClass("is-valid");
                        $("#telefono").addClass("is-invalid");
                    }
                    if(errors.asunto){
                        $("#error_asunto").html(errors.asunto[0]);
                        $("#asunto").removeClass("is-valid");
                        $("#asunto").addClass("is-invalid");
                    }
                    if(errors.correo){
                        $("#error_correo").html(errors.correo[0]);
                        $("#correo").removeClass("is-valid");
                        $("#correo").addClass("is-invalid");
                    }
                    if(errors.fecha){
                        $("#error_fecha").html(errors.fecha[0]);
                        $("#fecha").removeClass("is-valid");
                        $("#fecha").addClass("is-invalid");
                    }
                    if(errors.hora){
                        $("#error_hora").html(errors.hora[0]);
                        $("#hora").removeClass("is-valid");
                        $("#hora").addClass("is-invalid");
                    }
                    $("#modal_danger").html("Ingresa los datos correctamente!");
                    $("#modal-danger").modal("show");
                }
            }
        });
    });
});