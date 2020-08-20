<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
              <div class="form-group">
                <label for="user">User</label>
                <input type="email" class="form-control" id="user" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass">
              </div>
              <button id="login" class="btn btn-dark form-control">Entrar</button>     
        </div>
    </div>
</div>
<script type="text/javascript">
  var url_base = "<?php echo base_url(); ?>";
  $('#login').click(function () {
      var user = $('#user').val(); 
      var pass = $('#pass').val(); 

      fetch(
          url_base + "api/users/login", {
          method: 'POST',
          body: JSON.stringify({ user: user, pass: pass }),
          headers:{'Content-Type': 'application/json'}
      })
      .then(response => response.json());
  });
</script>