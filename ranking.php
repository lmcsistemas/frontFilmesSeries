<?php

include 'includes/config.php';
include 'includes/funcoes.php';

$response = getData("$base_url/votes/ranking", '');
$maior = (max($response['Votes']))['qtde_votes'];

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
            <div class="col-md-12 titleForm"> Ranking </div>
        </div>

        <div>
            <?php 
                foreach($response['Votes'] as $vote){

                    $qtdeVoto = $vote['qtde_votes']; 
                    $qtdep =ceil(($qtdeVoto*100)/$maior)."%" ; 
                    
                    ?>
                    <label><?=$vote['title']?></label><br>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: <?=$qtdep?>;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="<?=$maior?>"><?=$qtdeVoto?></div>
                    </div>
                    <br>


                <?php }
            
            ?>

            
        </div>        
                
    </div>
    <br><br>
    
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>