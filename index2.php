<?php
include_once "conexao.php";
$result_posicoes = "SELECT * FROM novapos ";
$resultado_posicoes = mysqli_query($conn, $result_posicoes);
$row_posicoes = mysqli_fetch_array($resultado_posicoes);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title>DragDrop</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <style>
        .draggable {
            position: absolute;
            width: 25%;
            min-height: 6.5em;
            margin: 1rem 0 0 1rem;
            background-color: #29e;
            color: white;
            border-radius: 0.75em;
            padding: 4%;
            touch-action: none;
            user-select: none;
            left: <?php echo $row_posicoes['xpos']; ?>px;
            top: <?php echo $row_posicoes['ypsilone']; ?>px;
        }
    </style>




</head>

<body>
    <div id="msg"></div>

    <div class="draggable" id="box"> Draggable Element </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>

        var position = {
            x : 0,
            y : 0
        }

        interact('.draggable').draggable({
            listeners: {
                end(event) {
                    console.log(event.type, event.target)
                    // seleciona elemento
                    let el = document.getElementById('box');
                    // utiliza método
                    let elCoordenadas = el.getBoundingClientRect();
                    // verificar as propriedades com as coord
                   // console.log(elCoordenadas);
                    
                    $.post("salva_outra.php", {
                            posX: elCoordenadas.x,
                            posY: elCoordenadas.y
                        })
                        .done(function(retorno) {
                            //Imprimir retorno do arquivo proc_alt_ordem.php
                            $("#msg").html(retorno);
                            //Apresentar a mensagem leve
                            $("#msg").slideDown('slow');
                            retirarMsg();
                        });
                    //Retirar a mensagem após 1700 milissegundos
                    function retirarMsg() {
                        setTimeout(function() {
                            $("#msg").slideUp('slow', function() {});
                        }, 1700);
                    }
                },
                move(event) {
                    position.x += event.dx
                    position.y += event.dy

                    event.target.style.transform =
                        `translate(${position.x}px, ${position.y}px)`
                },
            }
        })
    </script>


</body>

</html>