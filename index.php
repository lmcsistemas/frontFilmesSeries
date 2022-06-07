<?php

session_start();
//echo "access_token ". $_SESSION['access_token'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8000/api/productions/limit/3',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS =>'{
    "title":"Senhor dos Aneis",
    "category_id": 1,
    "duration": 60,
    "description": "Teste description",
    "genre": "ação",
    "photo_link": "www.uoll..com.br"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDUzNzM3NCwiZXhwIjoxNjU0NTQwOTc0LCJuYmYiOjE2NTQ1MzczNzQsImp0aSI6IjBGRXVmeW9DZkl1MW5qemUiLCJzdWIiOjMxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Akk6Ut7XMtxtNWD3ZJvBE50UikgNp-aLnKI9QQmLLgk',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$response = json_decode($response, true);
curl_close($curl);



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="includes/funcoes.js"></script>
    <title>NewWay - Produções</title>

  </head>
  <body>
    
    <?php include "includes/menu.php"?>
    <div class="container">    
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                <h1 class="display-4">A NewWay quer saber</h1>
                <p class="lead">Qual sua série ou filme favorito <br> Vote nas produções que escolhemos e vamos ver qual irá ganhar.</p>
                <!-- <p class="lead">
                    <a class="btn btn-primary btn-lg" href="planos_tarifas.php" role="button">Veja Mais</a>
                </p> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 titleForm">Filmes e Séries</div>
        </div>

        <div class='row justify-content-center'>
            
            <?php foreach($response['Production'] as $production){ ?>
        
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="card" style="width: 16rem;">
                        <img class="card-img-top" src="<?=$production['photo_link']?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$production['title']?></h5>
                            <p class="card-text"><?=substr($production['description'],0,200)?></p>
                            <button type='button' class="btn btn-primary vote" data-production='<?=$production['id']?>'>Votar</button>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>