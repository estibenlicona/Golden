<nav class="navbar navbar-light bg-dark text-light">
  <a class="navbar-brand text-light" href="<?= base_url('/jugadores') ?>">Jugadores</a>
  <form class="form-inline">
  	<?php if (!$this->session->userdata('login')): ?>	
    <a class="btn btn-success mt-2" href="<?= base_url('/login/start') ?>" type="submit">Entrar</a>
    <?php elseif($this->session->userdata('login')):  ?>
    <a class="btn btn-danger mt-2" href="<?= base_url('api/users/out') ?>" type="submit">Salir</a>
    <?php endif ?>
  </form>
</nav>