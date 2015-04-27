<!DOCTYPE html>
<html lang="es">
    <head>
        <title>test</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    </head>
    <body>
    <div name="dynamicContent">
        <p id="result">Resultat</p>
        <input type="text"/>
    </div>
    <script type="text/javascript">
        var array;
        function enviar(array){
            var postassistencia = array;
            $.ajax({
                type: "POST",
                url: '<?=url('api/control/assistencies');?>',
                data: { array:postassistencia },
                success: function(data) {
                    if(data == 'ENTRADA'){
                        console.log(data);
                        $("#result").text(data);
                    } else {
                        if(data == 'SORTIDA'){
                            console.log(data);
                            $("#result").text(data);
                        }else{
                            $("#result").text(data);
                        }
                    }
                }
            });
        }
        function doKeyDown(e){
            /*console.log("Llegueix al clickar una tecla");
             console.log(e);
             console.log(e.key);
             console.log(e.keyCode);*/
            if(e.keyCode == "13"){
                console.log("array definitivo");
                console.log(array);

                enviar(array);

                array = "";
                console.log("array limpio");
                console.log(array);
            }else{
                array += e.key;
                console.log(e.key);
            }
        }

        function onLoadPage(){
            console.log("Entra al carregar la pagina");
            array = '';
            window.addEventListener( "keypress", doKeyDown);
        }

        window.addEventListener( "DOMContentLoaded", onLoadPage);
    </script>
    </body>
</html>