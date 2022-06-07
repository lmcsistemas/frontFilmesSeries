<?php

include 'includes/config.php';
include 'includes/funcoes.php';

session_start();
$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1NDU0MTIzMCwiZXhwIjoxNjU0NTQ0ODMwLCJuYmYiOjE2NTQ1NDEyMzAsImp0aSI6IlhLb0xaajBsTTRiYTM4dDAiLCJzdWIiOjMxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.4MET53JVzI50V6_fGmRvB15oht6RVcbdoySvOhoG3iU";

if(isset($_POST['btnacao'])){
    $search = str_replace(" ", "%20", $_POST['search']);
    
    if(strlen(trim($search))==0){
        $msg_erro = "Informe um nome para pesquisa";
    }else{
        $response = getData("$base_url/productions/name/$search", '');
    }
}
else{    
   $response = getData("$base_url/productions/limit/10", '');
}

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
            <div class="col-md-12 titleForm">
            <form method="POST" >
                <div class='row'>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Pesquisar</label>
                        <input type="text" name="search" class="form-control" id="search" aria-describedby="search" placeholder="Digite o nome da série ou Filme">
                        <br>                    
                        <input type="submit" name="btnacao" class="btn btn-primary" value="Pesquisar">
                    </div>
                </div>
            </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 titleForm">Filmes e Séries</div>
        </div>            
            <?php foreach($response['Production'] as $key => $production){                
                if($key == 0){ ?>
                    <div class='row justify-content-center'>
                <?php }else{ 
                    if(($key % 3) == 0){ ?>
                        </div>
                        <br>
                        <div class='row justify-content-center'>
                    <?php  }
                }            ?>   
                

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
                
    </div>
    <br><br>
    
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>