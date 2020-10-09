<div class="container">
    <div class="row justify-content-center mt-5">
        <form class="col-md-4 mt-5" action="<?php echo base_url('api/users/login'); ?>" method="POST">
              <div class="form-group">
                <label for="user">User</label>
                <input type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-dark form-control">Entrar</button>     
              </div>  
              <?php if (isset($_SESSION['error'])): ?>              
              <div class="form-group">
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>
              </div>
              <?php endif ?>            
        </form>
    </div>
</div>
<?php echo getenv('HTTP_CLIENT_IP'); ?>