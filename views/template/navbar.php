<nav class="nav nav-dark">
    <div class="hamburger visible-xs" id="hamburger-menu">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
    <ul class="nav-collapse" id="menu">
      <li  class="active">
        <a href="#">
          Home
        </a>
      </li>
      <li>
        <a href="<?php echo routing::getRoot() ?>/login/logout">
          Se déconnecter
        </a>
      </li>
      <li>
        <a href="<?php echo routing::getRoot() ?>/user/add">
          Nouvel utilisateur
        </a>
      </li>
            <li>
        <a href="<?php echo routing::getRoot() ?>/admin">
          Administration
        </a>
      </li>
    </ul>
    </div>
</nav>