<?php if(isset($error)){ ?>

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Something went wrong! Please check your data :(
        <?php var_dump($error); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php } ?>
<div class="d-flex justify-content-center">
    <form action="" method="POST">
        <input type="text" placeholder="Name" name="username" required><br><br>
        <input type="text" placeholder="Last name" name="userlastname" required><br><br>
        <input type="email" placeholder="Email" name="email" required><br><br>
        <input type="password" placeholder="Password" name="userpassword" required><br><br>
        <div class="form-check">
            <input type="radio" class="form-check-input" name="category" id="student" value="student" checked required>
            <label for="student" class="form-check-label">Student</label>
        </div>
        <br>
        <input type="submit" class="btn btn-outline-primary" value="Sign up">
        <a href="login" class="btn btn-outline-primary">Login</a>
    </form>
</div>