<?php
    include "includes/config.php";

    if($_POST['btnacao']){
        $name       = $_POST['name'];
        $email      = $_POST['email'];
        $password   = $_POST['password'];

        if(strlen(trim($email)) > 0 and strlen(trim($password)) > 0 and strlen(trim($name)) > 0 ){
            
            $curl = curl_init();
            $dados = array("email" => $email, 'password' => $password, 'name' => $name);
            $dados = json_encode($dados);

            curl_setopt_array($curl, array(
            CURLOPT_URL => "$base_url/register",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$dados,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);

            if(isset($response['message'])){
                $ok = $response['message'];
            }          

        }else{
            $msg_erro = "Todos os campos são obrigatórios";
        }

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

    <title>NewWay - Produções</title>

    </head>
  <body>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="loginarea col-md-6 col-lg-6">
                <h3>Autenticação</h3>
 
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
                    <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" aria-describedby="namelHelp" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <center><input name="btnacao" type="submit" class="btn btn-primary" value="Gravar"><center>                    
                    
                </form>
            </div>            
        </div>
    </div> 
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>