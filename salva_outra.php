<?php
include_once "conexao.php";

$id = 1;
$posicaoX = number_format($_POST["posX"], 2, '.', '');
$posicaoY = number_format($_POST["posY"], 2, '.', '');


$SALVAR_POSICAO = "UPDATE novapos set xpos = '$posicaoX', ypsilone = '$posicaoY' WHERE id =' $id' ";

$salva = mysqli_query($conn,$SALVAR_POSICAO );

if($salva):
  echo "<span style='color: green;'>Alterado com sucesso</span>";
else:
  echo "deu problema :(";
endif;