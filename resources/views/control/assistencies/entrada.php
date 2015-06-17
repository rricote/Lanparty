<!DOCTYPE html>
<html lang="es">
<head>
    <title>test</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>


<body id="bodycolor" style="background-color: #add8e6">
<div id="result" name="dynamicContent" >

    <div style="width: 60%;
                height: 10%;
                margin: auto;
                position: absolute;
                top: 0; left: 0px; bottom: 0; right: 0;
                font-size: 700%;
                ;
                "
         id="result">
        Esperant qr...
    </div>

</div>
</body>

<script type="text/javascript">
    var array;
    function enviar(array) {
        var postassistance = array;
        $.ajax({
            type: "POST",
            url: '<?=url('api/control/assistances');?>',
            data: {array: postassistance},
            success: function (data) {
                if (data == 'ENTRADA') {
                    console.log(data);
                    var text = '<div style="width: 40%; height: 10%; margin: auto; position: absolute; top: 0; left: -200px; bottom: 0; right: 0; font-size: 700%;" id="result">';
                    text = text + data;
                    text = text + '</div>';
                    $("#result").html(text);
                    $("#bodycolor").css('background-color', '#98FB98');
                } else {
                    if (data == 'SORTIDA') {
                        console.log(data);
                        var text = '<div style="width: 40%; height: 10%; margin: auto; position: absolute; top: 0; left: -200px; bottom: 0; right: 0; font-size: 700%;" id="result">';
                        text = text + data;
                        text = text + '</div>';
                        $("#result").html(text);
                        $("#bodycolor").css('background-color', '#98FB98');
                    } else {
                        console.log(data);
                        var text = '<div style="width: 60%; height: 10%; margin: auto; position: absolute; top: 0; left: 0px; bottom: 0; right: 0; font-size: 700%;" id="result">';
                        text = text + data;
                        text = text + '</div>';
                        $("#result").html(text);
                        $("#bodycolor").css('background-color', '#FFAEB0');
                    }
                }
                setTimeout(function(){
                    $("#bodycolor").css('background-color', '#add8e6');
                    text = '<div style="width: 60%; height: 10%; margin: auto; position: absolute; top: 0; left: 0px; bottom: 0; right: 0; font-size: 700%;" id="result">Esperant qr...</div>';
                    $("#result").html(text);
                }, 1500);
            }
        });
    }
    function doKeyDown(e) {
        console.log("Llegueix al clickar una tecla");
        console.log(e);
        console.log(e.key);
        console.log(e.keyCode);

        if (e.keyCode == "13") {
            console.log("array definitivo");
            console.log(array);

            enviar(array);

            array = "";
            console.log("array limpio");
            console.log(array);
        } else {
            array += e.key;
            console.log(e.key);
        }
    }

    function onLoadPage() {
        console.log("Entra al carregar la pagina");
        array = '';
        window.addEventListener("keypress", doKeyDown);
    }
    window.addEventListener("DOMContentLoaded", onLoadPage);
</script>

</html>