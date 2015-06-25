<?php

/********************************************
Lohud Admin tool
by: Kai
ver 1.1

Template to build a secure admin panel with
Default timeout is 30 mins
Requires PHP 5.3+ for blowfish hashing
********************************************/


//Filter any nasty input, limit user and pass to be no more than 32 chars, shutoff error reporting
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if (strlen($_POST['u']) > 32 || strlen($_POST['p']) > 32) die();
error_reporting(0);


// //Import credentials and init variables
require('login_cred.php');
$page = "login.php";
$submitted_username = "";
$fail_message = "";


//Check to see if the user is already logged in and hasn't timed out, if so bypass login page
session_start();
if(!empty($_SESSION['user'])){
    if ($_SESSION['timeout'] + 1800 >= time()){
        $_SESSION['timeout'] = time(); 
    }
} else {
  header("Location: " . $page); 
  die("Redirecting to " . $page);
}


//Credentials are being passed through the form, see if they're legit
if(!empty($_POST)){
    foreach ($credentials as $entry) {
        if ($_POST['u']===$entry['user']){
            if (crypt($_POST['p'], $entry['pass'])===$entry['pass']){
                //Username and password good
                session_start();
                $_SESSION['user'] = $entry['name'];
                $_SESSION['timeout'] = time();
                session_write_close(); 
                header("Location: " . $page); 
                die("Redirecting to: " . $page);
            }
            else {
                //Password failed
                $submitted_username = htmlentities($_POST['u'], ENT_QUOTES, 'UTF-8');
                $fail_message = "Login Failed";
            }
        }
        else {
            //Username failed
            $submitted_username = htmlentities($_POST['u'], ENT_QUOTES, 'UTF-8');
            $fail_message = "Login Failed";
        }
    }
}
?>
<?php
  include('header.php');
?>
<style type="text/css">
  body { 
    width: 100%;
    height:100%;
    font-family: 'Open Sans', sans-serif;
    background: #f2f2f2;
  }

  h1, h2, h3, h4, h5, h6, p {
  }
</style>

<form enctype="multipart/form-data" method="POST" action="insert.php">
  <div class="row">
    <div class="large-6 columns">
      <h3>Insert player info <a href="admin.php" style="font-size:.45em;">Back to admin</a></h3>
      <label>
        <input type="text" id="name" name="name" placeholder="Name" required="required" value="<?php echo $name;?>"/>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="school" name="school" placeholder="School" required="required" value="<?php echo $school;?>"/>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="year" name="year" placeholder="Class year" required="required" value="<?php echo $grade;?>"/>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="position" name="position" placeholder="Position" value="<?php echo $position;?>"/>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="sport" name="sport" placeholder="Sport" required="required" value="<?php echo $sport;?>"/>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>
        <textarea type="text" id="chip" name="chip" placeholder="Chip shots" required="required" value="<?php echo $chip;?>"/></textarea>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
        Select image to upload:
            <input name="fileToUpload" id="fileToUpload" type="file" />
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
        <label>
          <input type="text" id="credit" name="credit" placeholder="Photo credit" required="required" value="<?php echo $credit;?>"/>
        </label>
    </div>
  </div>
  <div class="row">
      <div class="small-3 columns">
          <input href="#" class="button" type="submit">
      </div>
  </div>
  
</form>
    <div id="myModal" class="reveal-modal" data-reveal>
      <h2>Success!</h2>
      <p>Your submission has been recorded and saved.</p>
      <p><a href="#" onclick="location.reload();">Refresh page</a> or return to <a href="admin.php">admin page</a>.</p>
      <a class="close-reveal-modal">&#215;</a>
    </div>
<?php
  include('footer.php');
?>