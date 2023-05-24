$(".DT").on("click", ".EditarDoctor", function() {

    var Did = $(this).attr("Did");
    var datos = new FormData();

    datos.append("Did", Did);

    $.ajax({

        url: "Ajax/doctoresA.php",
        method: "POST",
        data: datos,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        
        success: function(resultado) {
            $("#Did").val(resultado["id"]);
            $("#apellidoE").val(resultado["apellido"]);
            $("#nombreE").val(resultado["nombre"]);
            $("#usuarioE").val(resultado["usuario"]);
            $("#claveE").val(resultado["clave"]);

            $("#sexoE").html(resultado["sexo"]);
            $("#sexoE").val(resultado["sexo"]);
        }
    })


})