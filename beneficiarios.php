<?php
if (isset($_POST['Nome']) && !empty($_POST['Nome'])) {
    $nome = addslashes($_POST['Nome']);
    $sobrenome = addslashes($_POST['Sobrenome']);
    $QTD_bene = addslashes($_POST['QTD_bene']);
    $plano = addslashes($_POST['Plano']);

} 
        //Prices
        $json_prices = file_get_contents("json/prices.json");
        $dados_prices_decode = json_decode($json_prices);
        //Plans
        $json_plans = file_get_contents("json/plans.json");
        $dados_plans_decode = json_decode($json_plans);
            
    //Descobrindo o plano selecionado;
        foreach ($dados_plans_decode as $tipo) :
            if ($tipo->codigo == $plano) {
                $plano_nome = $tipo->nome;
                $plano_resgistro = $tipo->registro;
                $plano_codigo = $tipo->codigo;
            }
        endforeach;

    //Descobrindo o valor do plano;
        foreach ($dados_prices_decode as $valor) :
            if ($valor->codigo == $plano_codigo) {
                if($valor->minimo_vidas > $QTD_bene && $plano == 1){
                    $prices_codigo = $dados_prices_decode[0]->codigo;
                    $prices_minimo_vidas = $dados_prices_decode[0]->minimo_vidas;
                    $prices_faixa1 = $dados_prices_decode[0]->faixa1;
                    $prices_faixa2 = $dados_prices_decode[0]->faixa2;
                    $prices_faixa3 = $dados_prices_decode[0]->faixa3;
                }elseif($valor->minimo_vidas < $QTD_bene && $plano == 6){
                    $prices_codigo = $dados_prices_decode[7]->codigo;
                    $prices_minimo_vidas = $dados_prices_decode[7]->minimo_vidas;
                    $prices_faixa1 = $dados_prices_decode[7]->faixa1;
                    $prices_faixa2 = $dados_prices_decode[7]->faixa2;
                    $prices_faixa3 = $dados_prices_decode[7]->faixa3;
            }else{
                $prices_codigo = $dados_prices_decode[$plano]->codigo;
                $prices_minimo_vidas = $dados_prices_decode[$plano]->minimo_vidas;
                $prices_faixa1 = $dados_prices_decode[$plano]->faixa1;
                $prices_faixa2 = $dados_prices_decode[$plano]->faixa2;
                $prices_faixa3 = $dados_prices_decode[$plano]->faixa3;
            }
            
        }
        endforeach;
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include("header_script.php"); ?>
    <title>Cadastro de beneficiarios</title>
</head>

<body>
    <div class="container">
        <div class="row mt-3 d-flex justify-content-center">
            <div class="text-center">
                <h3>Cadastro de beneficiarios</h3>
            </div>

            <div class="col-md-5 p-3">
                <div class=" shadow rounded border p-3">
                    <div class="text-center">
                        <?php
                        ?>
                        <h5>Plano escolhido</h5>
                        <p>
                            <?php foreach ($dados_plans_decode as $tipo) :
                                if ($tipo->codigo == $plano) {
                            ?>
                                    <?= $tipo->nome ?>
                            <?php   }
                            endforeach; ?>
                        </p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Valores por pessoa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">0 a 17 anos</th>
                                    <td>R$<?= $prices_faixa1 ?>,00</td>
                                </tr>
                                <tr>
                                    <th scope="row"> 18 a 40 anos</th>
                                    <td>R$<?= $prices_faixa2 ?>,00</td>
                                </tr>
                                <tr>
                                    <th scope="row">40 anos +</th>
                                    <td>R$<?= $prices_faixa3 ?>,00</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <div class="col-md-7 p-3">
                <div class="p-3  shadow rounded border">
                    <form method="POST" action="./valor_total.php">
                        <div class="mb-3 row">
                            <div class="col-md-10">
                                <label for="exampleInputEmail1" class="form-label">Nome do beneficiario 1</label>
                                <input type="text" name="NomeBene1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$nome ." ".$sobrenome?>">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInputPassword1" class="form-label">Idade</label>
                                <input type="number" name="IdadeBene1" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="mb-3">

                        </div>
                        <?php for ($i = 1; $i < $QTD_bene; $i++) {
                        ?>
                            <div class="mb-3 row">
                                <div class="col-md-10">
                                    <label for="exampleInputEmail1" class="form-label">Nome do beneficiario <?= $i + 1 ?></label>
                                    <input type="text" name="NomeBene<?= $i + 1 ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInputPassword1" class="form-label">Idade</label>
                                    <input type="number" name="IdadeBene<?= $i + 1 ?>" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="mb-3">

                            </div>
                        <?php } ?>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <input type="hidden" name="QTD_BENE" value="<?= $QTD_bene ?>">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>