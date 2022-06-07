

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><span style="color:#8725ff">NewWay-Produções</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="catalogo.php">Catalogo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ranking.php">Ranking</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <ul class="navbar-nav form-inline my-2 my-lg-0">
      <li class="nav-item">

        <?php 
        
          if(strlen(trim($token))>0){
            echo "<a class='nav-link' href='logoff.php'>Sair</a>";
          }else{
            echo "<a class='nav-link' href='login.php'>Entrar</a>";
          }
        
        ?>


        
      </li>
    </ul>
    
  </div>
</nav>