$().ready(function(){
    $("#responsablesDropdown").addClass("active");
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
    $("#usuario").keyup(function(){
        if( $(this).val().match(exp) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#password").keyup(function(){
        if( $(this).val().match(exp) ){
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
        else{
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    });
    $("#confirmacion_password").keyup(function(){
        if( $(this).val().match(exp) ){
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
                console.log("la respuesta es:"+respuesta);
                if(respuesta=="Se Modificó Responsable Correctamente"){
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
                    if(errors.usuario){
                        $("#error_usuario").html(errors.usuario[0]);
                        $("#usuario").removeClass("is-valid");
                        $("#usuario").addClass("is-invalid");
                    }
                    if(errors.password){
                        $("#error_password").html(errors.password[0]);
                        $("#password").removeClass("is-valid");
                        $("#password").addClass("is-invalid");
                    }
                    if(errors.confirmacion_password){
                        $("#error_confirmacion_password").html(errors.confirmacion_password[0]);
                        $("#confirmacion_password").removeClass("is-valid");
                        $("#confirmacion_password").addClass("is-invalid");
                    }
                    $("#modal_danger").html("Ingresa los datos correctamente!");
                    $("#modal-danger").modal("show");
                }
            }
        });
    });
});