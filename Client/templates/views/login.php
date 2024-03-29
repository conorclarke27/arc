<!-- Reference Bootstrap: https://bootsnipp.com/snippets/vl4R7 -->

<style>
body {
  background-image: url("../Client/assets/images/test.png");
  background: cover;
  overflow: hidden;
}

.card {
  background-color: #99ddff;
}

#header-name {
  background: none;
  margin: 0;
  padding-bottom: 0;
}

#footer-name {
  background: none;
}

input span {
  margin: 10px;
  padding: 10px;
}

.input-group-text {
  background-color:#3399ff;
}

.imgcontainer {
  text-align: center;
  margin-bottom: 6px;
}

img.avatar {
  width: 40%;
}

#regLink {
  text-decoration: underline;
  color: blue;
}

#regLink:hover {
  color: white;
}

.btn {
  background-color: #5E85FE;
  opacity: 0.7;
}

form p.error {
    background-color: rgb(235, 97, 97);
    color: white;
    padding: 0.25em 0.75em;
    margin-bottom: 0.25em;
  }
  form p.error:last-of-type {
    margin-bottom: 1em;
  }
  
  form p.error {
    background-color: rgb(235, 97, 97);
    color           : white;
    padding         : 0.25em 0.75em;
    margin-bottom   : 0.25em;
  }
  form p.error:last-of-type {
    margin-bottom   : 1em;
  }
</style>


<div class="container">
  <div class="d-flex justify-content-center">

    <div class="card">
      <div class="card-header" id="header-name">
        <em>
          <h2>Sign In</h2>
        </em>
        <!-- <div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div> -->

      </div>
      <div class="card-body">

        <form id='login_form' action='' method='post'>
          <div class="imgcontainer">
            <img src="../Client/assets/images/user_profile.png" alt="Avatar" class="avatar">
          </div>
          <?php foreach($locals['form_error_messages'] as $errors) { ?>
            <p class='error' ><?=  $errors ?></p>
            <?php } ?>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" name='email' value='<?= $email ?>' placeholder="email">

          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" name='password' value='<?= $password ?>' placeholder="password">
          </div>
          
          <div class="form-group">
            <input type="submit" value="Login" class="btn float-right login_btn">
          </div>

        </form>
      </div>
      <div class="footer" id="footer-name">
        <div class="d-flex justify-content-center links">
          Don't have an account?<a id="regLink" href='<?= SITE_BASE_DIR ?>/register'>Sign Up</a>
        </div>
      </div>
    </div>
  </div>

</div>