var tiempo;
$().ready(function(){
    tiempo=setTimeout(logout,300000);
    $(document).mouseover(restartTimer);
    $(document).keypress(restartTimer);
});
function restartTimer(){
    clearTimeout(tiempo);
    tiempo=setTimeout(logout,300000);
}
function logout(){
    $.ajax({
        url:$("#logout").attr("href"),
        type:"get",
        success:function(respuesta){
            location.reload();
        }
    });   
}