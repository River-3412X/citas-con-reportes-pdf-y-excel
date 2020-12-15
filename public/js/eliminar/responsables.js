$().ready(function(){
    $("#responsablesDropdown").addClass("active");
    $("#responsables_consultar").addClass("active");

    $("#forms > form").each(function(){
        $(this).submit(function(e){
            e.preventDefault();
            var formulario = $(this);
            var token = formulario.find("input[name=_token]");
            $.ajax({
                headers:{"X-CSRF-TOKEN":token},
                type:formulario.attr("method"),
                url:formulario.attr("action"),
                data:formulario.serialize(),
                success:function(respuesta){
                    console.log("la respuesta es: "+respuesta);
                    if(respuesta=="Se Eliminó Responsable Correctamente"){
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
                    console.log("el erorr es: "+error);
                }
            });
        });
    });
});