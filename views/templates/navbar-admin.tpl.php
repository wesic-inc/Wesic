<header>
    <nav class="navbar">
      <a href="index.html">
        <img class="navbar-icon" src="../public/img/dark.svg">
      </a>
      <div class="hamburger hidden-lg" id="hamburger-menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>
      <ul class="nav" id="menu">
        <li ><a href="index.html" class="active">Accueil</a></li>
        <li class="dropdown-link" >
          <a href="articles.html" >Articles</a>
          <div class="dropdown">
            <ul> 
              <li><a href="articles.html">Tous les articles</a> </li> 
              <li><a href="<?php echo ROOT_URL ?>admin/ajouter-article">Ajouter un article</a> </li> 
              <li><a href="#">Catégories</a> </li> 
              <li><a href="#">Tags</a> </li> 
            </ul>
          </div>
        </li>
        <li class="dropdown-link" ><a href="#">Pages</a>
          <div class="dropdown">
            <ul> 
              <li><a href="#">Toutes les pages</a> </li> 
              <li><a href="#">Ajouter une page</a> </li>  
            </ul>
          </div>
        </li>
        <li><a href="#">Médias</a></li>
        <li class="dropdown-link" >
          <a href="#">Evènements</a>
          <div class="dropdown">
            <ul> 
              <li><a href="#">Tous les événements</a> </li> 
              <li><a href="#">Ajouter un événement</a> </li>  
            </ul>
          </div>
        </li>
        <li><a href="#">Commentaires</a></li>
        <li class="dropdown-link">
          <a  href="#">Apparence</a>
          <div class="dropdown">
            <ul> 
              <li><a href="#">Modifier le thème</a> </li> 
              <li><a href="#">Mes thèmes</a> </li>  
              <li><a href="#">Theme Creator</a> </li>  
            </ul>
          </div></li>
          <li ><a href="#">Paramètres</a></li>
          <div class="user-menu ">
            <a href="#">
              <span> Elon Musk </span>
              <img class="avatar" src="../public/img/user.jpg">
              <img class="cicon-carret " src="../public/img/carret.svg">
            </a>
          </div>
        </ul>
      </nav>  
    </header>