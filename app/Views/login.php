<?php if(isset($error)){ ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Email or password incorrect :(
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>

<div class="d-flex justify-content-center">
    <form action="login" method="POST">
        <input type="email" placeholder="Email" name="email" required><br><br>
        <input type="password" placeholder="Password" name="userpassword" required><br><br>
        <input type="submit" class="btn btn-outline-primary" value="Login">
        <a href="register" class="btn btn-outline-primary">Register</a>
    </form>
</div>
