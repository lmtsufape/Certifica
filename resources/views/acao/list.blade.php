<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar ações</title>
    <link rel="stylesheet" href={{"/css/acoes/list.css"}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <section class="listar-acoes-view">

        <section class="container d-flex flex-column justify-content-center tittle-page-box">
            <div class="row text-center">
                <h1 class="tittle-page ">Ações</h1>
            </div>
            <div class="row text-end">
                <p class="text-button-box">
                    <button><img class="button-icon" src={{"/images/acoes/listView/button-create-acao.svg"}}></button>
                    <span class="text-button">Criar ação</span>
                </p>
            </div>
        </section>

        <section class="container d-flex flex-column mb-2 justify-content-evenly filter-box">
        <!--Futuramente será transformado em layout com passagem de parametro para cada tipo de user-->
            <div class="row container tittles-filter-box">
                <div class="col-6">Buscar ação</div>
                <div class="col-4">Natureza</div>
                <div class="col-1">Data</div>
            </div>
            <div class="row container">
                <div class="col-6">
                    <input class="campos w-buscar" type="text" name="" id="">
                </div>
                <div class="col-4">
                    <select class="campos w-natureza" name="" id="">
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="col-2">
                    <input class="campos w-date" type="date" name="" id="">
                </div>
            </div>
        </section>

        <section class="list-box container">
            <div class="row d-flex align-items-center container-tittles">
                <div class="col text-start">Título</div>
                <div class="col text-center">Data</div>
                <div class="col text-center">Natureza</div>
                <div class="col text-center">Funções</div>
            </div>
            <div>
                <!--For each aqui ! -->
                <div class="row acao d-flex align-items-center ">
                    <div class="col text-start">V Semana de Pedagogia</div>
                    <div class="col text-center">Jan 6, 2022 </div>
                    <div class="col text-center">Projeto de ensino</div>
                    <div class="col text-center"><img src={{"/images/acoes/listView/func.svg"}}></div>
                </div>
                <div class="row acao d-flex align-items-center ">
                    <div class="col text-start">Integra BCC</div>
                    <div class="col text-center">Out 2, 2023 - Out 5, 2022  </div>
                    <div class="col text-center">Outros</div>
                    <div class="col text-center"><img src={{"/images/acoes/listView/func.svg"}}></div>
                </div>
                <div class="row acao d-flex align-items-center ">
                    <div class="col text-start">Saúde Mental </div>
                    <div class="col text-center">Fev 8, 2022 </div>
                    <div class="col text-center">Projeto de extensão</div>
                    <div class="col text-center"><img src={{"/images/acoes/listView/func.svg"}}></div>
                </div>

            </div>
        </section>
    </section>
</body>
</html>

