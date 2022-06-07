<?php

    include 'includes/config.php';
    include 'includes/funcoes.php';

    session_start();
    if(!$_SESSION['access_token']){
        header('Location: /login.php');
        exit;
    }
    $token = $_SESSION['access_token'];

if($_GET['production']){

    $id = (int)$_GET['production'];

    $response = getData("$base_url/production/$id", '');

    if(isset($response['error'])){
        $msg_erro = $response['error'];
    }else{
        $title = $response['Production']['title'];
        $description = $response['Production']['description'];
        $duration = $response['Production']['duration'];
        $genre = $response['Production']['genre'];
        $category_id = $response['Production']['category_id'];
        $photo_link = $response['Production']['photo_link'];
    }
}

if(isset($_POST['btnacao'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $photo_link = $_POST['photo_link'];
    $category_id = $_POST['category_id'];
    $id = (int)$_POST['id'];

    $msg_erro = ""; 

    if(strlen(trim($title))==0){
        $msg_erro .= "Informe um Título. <br>";
    }
    if(strlen(trim($description))==0){
        $msg_erro .= "Informe uma descrição. <br>";
    }
    if(strlen(trim($duration))==0){
        $msg_erro .= "Informe uma duração/tempo. <br>";
    }
    if(strlen(trim($genre))==0){
        $msg_erro .= "Informe um genero. <br>";
    }
    if(strlen(trim($photo_link))==0){
        $msg_erro .= "Informe um link. <br>";
    }
    if(strlen(trim($category_id))==0){
        $msg_erro .= "Informe uma categoria. <br>";
    }
    
    if(strlen(trim($msg_erro)) == 0){
        $dados = array('title' => $title,
                        'description' => $description,
                        'duration' => $duration,
                        'genre' => $genre,
                        'photo_link' => $photo_link,
                        'category_id' => $category_id
                    );
        $dados = json_encode($dados);
        
        if($id == 0){        
            $response = postData("$base_url/production", $token, $dados);
        }else{
            $response = putData("$base_url/production/$id", $token, $dados);
        }


        if(isset($response['message'])){
            $ok = $response['message'];
        }
        if(isset($response['error'])){
            $msg_erro .= $response['error'];
        }

        $title = "";
        $description = "";
        $duration = "";
        $genre = "";
        $photo_link = "";
        $category_id = "";
        $id = "";

    }
} 
$productions = getData("$base_url/productions", '');
$categories = getData("$base_url/categories", $token);

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
            <div class="col-md-12 titleForm">Cadastro de Produções</div>
        </div>   
        <div class="row justify-content-md-center">
            <div class="formcadastro col-md-10 col-lg-10">
                <?php if(strlen(trim($ok))>0){ ?>
                    <div class="alert alert-success" role="alert">
                        <?=$ok?>
                    </div>
                <?php } ?>
                <?php if(strlen(trim($msg_erro))>0){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$msg_erro?>
                    </div>
                <?php } ?>
                <form method="POST" >
                    <div class="form-group col-md-12">
                        <label>Título</label>
                        <input type="text" name="title" maxlength="40" class="form-control" value="<?=$title?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Duração</label>
                        <input type="tel" maxlength="3" name="duration" class="form-control" value="<?=$duration?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Descrição</label>
                        <textarea class="form-control" name='description'><?=$description?></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Género</label>
                        <input type="text" name="genre" maxlength="40" class="form-control" value="<?=$genre?>" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Categoria</label>
                        <select name="category_id" class="form-control">
                            <?php 
                            foreach($categories['categories'] as $category){
                                echo "<option value=".$category['id'].">".$category['name']."</option>";
                            }                            
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Link de Foto</label>
                        <input type="text" name="photo_link" class="form-control" value="<?=$photo_link?>">
                    </div>
                    <center>
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input name="btnacao" type="submit" class="btn btn-primary" value="Gravar"><center>
                </form>

            </div>            
        </div>         
         <br><Br>
        
        <div class="row justify-content-md-center">
            <div class="col-md-10 col-lg-10">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($productions['Production'] as $key => $production){
                            echo "
                                <tr>
                                    <th scope='row'>".($key+1)."</th>
                                    <td>".$production['title']."</td>
                                    <td>".$production['description']."</td>
                                    <td>".$production['category_name']."</td>
                                    <td><a href='?production=".$production['id']."'>Editar</a></td>
                                </tr>
                            ";
                        }
                        
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br><br>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>