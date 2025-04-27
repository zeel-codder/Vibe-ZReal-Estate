<?php
// This component is conditionally included only for users who are not logged in
if (!isLoggedIn()): 
?>
<!-- Login Modal -->
<div id="loginpop" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-user"></i> Welcome Back</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 login">
            <h4><i class="fas fa-sign-in-alt"></i> Login</h4>
            <form action="login.php" method="post">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" placeholder="Email address" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
              </div>
             
              <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Sign in</button>
            </form>
          </div>
          <div class="col-sm-6">
            <h4><i class="fas fa-user-plus"></i> New User?</h4>
            <p>Join today and get updated with all the properties deal happening around.</p>
            <button type="button" class="btn btn-info btn-block" onclick="window.location.href='register.php'">
              <i class="fas fa-user-plus"></i> Create Account
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>