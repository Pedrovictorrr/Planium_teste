<?php
$json_plans = file_get_contents("json/plans.json");
$dados_plans_decode = json_decode($json_plans);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Teste Planium</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5 ">
            <div class="col-md-12 p-3 shadow border rounded">
                <div class="text-center">
                    <h3>Planium</h3>
                </div>
                <form method="POST" action="./beneficiarios.php">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Nome:</label>
                            <input type="text" name="Nome" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Sobrenome:</label>
                            <input type="text" name="Sobrenome" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="exampleInputEmail1" class=" col-sm-4 mt-1 form-label">Qual a quantidade de beneficiarios para ser cadastrados?</label>
                        <div class="col-sm-2">
                            <input type="number" name="QTD_bene" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="selectbox" class="form-label">Informe seu plano</label>
                        <div class="col-sm-6">
                            <select class="form-select " name="Plano" aria-label="Default select example">
                                <option selected>Selecione seu plano</option>
                                <?php foreach ($dados_plans_decode as $Planos) :
                                ?>
                                    <option value="<?= $Planos->codigo ?>"><?= $Planos->nome ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Confirmar</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>