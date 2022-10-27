<?php
// Criar logica para pegar todos os nomes e idades e salvar dentro de um array
$QTD_bene = addslashes($_POST['QTD_BENE']);
echo $QTD_bene;
 for ($i = 1; $i <= $QTD_bene; $i++) {
$nome_bene = addslashes($_POST['NomeBene'.$i]);
$idade_bene = addslashes($_POST['IdadeBene'.$i]);
if($beneficiarios == NULL){
$beneficiarios = array(
    array('Nome' => $nome_bene , 'idade' => $idade_bene),
);
}else{
   array_push($beneficiarios,
        array('Nome' => $nome_bene , 'idade' => $idade_bene),
    );
}
echo "<br>adicionou - ". $i;
 }
 echo '<pre>';
 print_r($beneficiarios); 
 echo 'RODOU';
?>