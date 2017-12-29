<nav class="nav nav-dark">
  <div class="hamburger visible-xs" id="hamburger-menu">
    <span class="line"></span>
    <span class="line"></span>
    <span class="line"></span>
  </div>
  <ul class="nav-collapse" id="menu">
    <li  class="active">
      <a href="<?php echo ROOT_URL ?>">
        Home
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>login">
        Se connecter
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>newuser">
        Nouvel utilisateur
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>article/new">
        Add article
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>event/add">
        Add event
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>media/add">
        Add media
      </a>
    </li>
    <li>
      <a href="<?php echo ROOT_URL ?>page/new">
        Add page
      </a>
    </li>
        <li>
      <a href="<?php echo ROOT_URL ?>category/add">
        Add category
      </a>
    </li>
    <li class="pull-right">
      <a href="<?php echo ROOT_URL ?>profile">
        <?php echo $pseudo ?>
      </a>
    </li>
  </ul>
</div>
</nav>