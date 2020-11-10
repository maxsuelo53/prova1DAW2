function progresso(id){
    var totalFaltas = document.getElementById('totalFaltas'+id).value;
    var maxFaltas = document.getElementById('maxFaltas'+id).value;

    //console.log(totalFaltas);
    //console.log(maxFaltas);

    var perc = (totalFaltas/maxFaltas)*100;
    document.getElementById('progressoFalta'+id).style.width=perc.toFixed(0)+"%";
}

$(document).ready(function(){
    $(".progressoFaltaBar").each( function(){

        var id = $(this).data("id");
        progresso(id);

    })
})