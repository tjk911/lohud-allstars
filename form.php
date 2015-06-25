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

// define variables and set to empty values
// $nameErr = $schoolErr = $gradeErr = $sportErr = $chipErr = "";
// $name = $school = $grade = $sport = $chip = "";
// if($valid){
//     // print_r($valid);
//    header("Location: insert.php"); 
//    exit();
// } else {
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//       if (empty($_POST["name"])) {
//         $nameErr = "<small class='error'>Name is required</small>";
//         $valid = false;
//       } else {
//         $name = test_input($_POST["name"]);
//       }

//       if (empty($_POST["school"])) {
//         $schoolErr = "<small class='error'>School is required</small>";
//         $valid = false;
//       } else {
//         $school = test_input($_POST["school"]);
//       }

//       if (empty($_POST["grade"])) {
//         $gradeErr = "<small class='error'>Grade is required</small>";
//         $valid = false;
//       } else {
//         $grade = test_input($_POST["grade"]);
//       }

//       if (empty($_POST["sport"])) {
//         $sportErr = "<small class='error'>Sport is required</small>";
//         $valid = false;
//       } else {
//         $sport = test_input($_POST["sport"]);
//       }

//       if (empty($_POST["chip"])) {
//         $chipErr = "<small class='error'>Chip shot is required</small>";
//         $valid = false;
//       } else {
//         $chip = test_input($_POST["chip"]);
//       }

//       if (empty($_POST["credit"])) {
//         $creditErr = "<small class='error'>Photo credit is required</small>";
//         $valid = false;
//       } else {
//         $credit = test_input($_POST["credit"]);
//       }

//     }
// };

// function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
// }
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
/*    background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
    background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
    background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
    background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
    background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );*/
    /*color:#f2f2f2;*/
  }

  h1, h2, h3, h4, h5, h6, p {
    /*color:#f2f2f2;*/
  }
</style>

<!-- <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> -->

<form enctype="multipart/form-data" method="POST" action="insert.php">
  <div class="row">
    <div class="large-6 columns">
      <h3>Insert player info <a href="admin.php" style="font-size:.45em;">Back to admin</a></h3>
      <label>
        <input type="text" id="name" name="name" placeholder="Name" required="required" value="<?php echo $name;?>"/>
        <!-- <?php echo $nameErr;?> -->
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="school" name="school" placeholder="School" required="required" value="<?php echo $school;?>"/>
        <!-- <?php echo $schoolErr;?> -->
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="year" name="year" placeholder="Class year" required="required" value="<?php echo $grade;?>"/>
        <!-- <?php echo $gradeErr;?> -->
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="position" name="position" placeholder="Position" value="<?php echo $position;?>"/>
        <!-- <?php echo $positionErr;?> -->
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>
        <input type="text" id="sport" name="sport" placeholder="Sport" required="required" value="<?php echo $sport;?>"/>
        <!-- <?php echo $sportErr;?> -->
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>
        <textarea type="text" id="chip" name="chip" placeholder="Chip shots" required="required" value="<?php echo $chip;?>"/></textarea>
        <!-- <?php echo $chipErr;?> -->
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
          <!-- <?php echo $creditErr;?> -->
        </label>
    </div>
  </div>
  <div class="row">
      <div class="small-3 columns">
          <input href="#" class="button" type="submit">
          <!-- <a href="#" class="button" onclick="insertUser()">Submit</a> -->
      </div>
  </div>
  
</form>
    <div id="myModal" class="reveal-modal" data-reveal>
      <h2>Success!</h2>
      <p>Your submission has been recorded and saved.</p>
      <p><a href="#" onclick="location.reload();">Refresh page</a> or return to <a href="admin.php">admin page</a>.</p>
      <a class="close-reveal-modal">&#215;</a>
    </div>
<!-- <script type="text/javascript">
    // $('#image').fileUpload();

    function insertUser(){

    //capture the file object
    files = $('#fileupload')[0].files;

    //create new formdata object and add files to it
    var data = new FormData();
        $.each(files, function(key, value){
            data.append(key, value);
        });

    console.log(data);

    //handle the ajax upload
    $.ajax({
            url: 'insert.php?',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            // success: mySuccessHandler()
    });

    }

    // function insertUser(){
    //     var name = $("#name").val();
    //     var age = $("#age").val();
    //     var school = $("#school").val();
    //     var sport = $("#sport").val();
    //     // var photo = $("#photo").files[0];
    //     if (name.length === 0){
    //         alert("Name is required!");
    //         return false;
    //     }
    //     if (age.length === 0){
    //         alert("Age is required!");
    //         return false;
    //     }
    //     if (school.length === 0){
    //         alert("School is required!");
    //         return false;
    //     }
    //     if (sport.length === 0){
    //         alert("Sport is required!");
    //         return false;
    //     }
    //     var dataString = 'name=' + name + '&age=' + age + '&school=' + school + '&sport=' + sport;
    //     $.ajax({
    //       type: "POST",
    //       url: "insert.php",
    //       data: dataString,
    //     });
    //     $('#myModal').foundation('reveal', 'open');
    //     return false;
    // }
</script> -->


<?php
  include('footer.php');
?>