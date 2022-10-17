<?php 
include 'connection.php';
//initializing variables
$errors = array(); 
  

// error_reporting(0);

if (isset($_POST['submit'])) {
    //   // receive all input values from the form
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
    //   $contact =  $_POST['contact'];
      $aadhar = $_POST['regaadharno'];
      $email = $_POST['eid'];
      $pwd =  $_POST['password'];
      $password = md5($pwd);
    
    
    
      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM tbl_login WHERE email='$email'";
      $checkqueryresult = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($checkqueryresult);
      if ($user){ // if user exists
        if ($user['email'] == $email) {
            array_push($errors, "Email already exists");
            // echo"<script Type='text/javascript'>alert('Email already exists')</script>";
        }
        
      }
    
      //Finally, register user if there are no errors in the form
     if (count($errors) == 0)
       {
        $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$password',1,4)";
          $logqueryresult = mysqli_query($conn,$log_query);
        if($logqueryresult) {
          $idselectionquery = "SELECT login_Id FROM tbl_login WHERE email='$email'";
          $idselectionqueryresult = mysqli_query($conn, $idselectionquery);
          $user = mysqli_fetch_assoc($idselectionqueryresult);
          $loginId = $user['login_Id'];
          $reg_query = "INSERT INTO tbl_registration(login_Id,First_Name,Last_Name,Aadhar_no,mob_no,house_name,place,post_office,pin_code,dob,caste, gender,ward_no, religion)
          VALUES('$loginId','$fname','$lname','$aadhar',0,0,0,0,0,0,0,0,0,0)";
          $reg_queryresult = mysqli_query($conn, $reg_query);
          if($reg_queryresult){
            echo"<script Type='text/javascript'>alert('Registration Success,Use your email id as Username when login')</script>";
            echo"<script>window.location.href='dashindex.html';</script>";
          }
          else {
            echo"<script Type='text/javascript'>alert('Registration not Success')</script>";
          } 
        }
      }
    }
    
    ?>
    <?php  if (count($errors) > 0) : ?>
   <div class="error" style="color:red">
     <?php foreach ($errors as $error) : ?>
       <p><?php echo"<script Type='text/javascript'>alert('$error')</script>"; ?></p>
     <?php endforeach ?>
   </div>
 <?php  endif ?>
   

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>REGISTRATION PAGE </title>

    <link rel="shortcut icon" href="assets/logreg/images/fav.jpg">
    <link rel="stylesheet" href="assets/logreg/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/logreg/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/logreg/css/style.css" />
</head>

<body>
    <div class="container-fluid ">
        <div class="container ">
            <div class="row ">
                
                <div class="col-sm-10 login-box">
                    <div class="row">
                      <div class="col-lg-4 col-md-5 box-de">
                          <!-- <div class="small-logo">
                                <i class="fab fa-asymmetrik"></i> Style Login
                            </div>-->
                            <div class="ditk-inf sup-oi">
                                <h2 class="w-100">Already Have an Account </h2>
                                <p>Simply login to your account by clicking the login Button</p>
                                <a href="signin.php">
                                    <button type="button" class="btn btn-outline-light">SIGN IN</button>
                                </a>
                                <a href="index.html">
                                    <button type="button" class="btn btn-outline-light">HOME</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 log-det">
                            
                            <h2>Create Account</h2>
                            <div class="row">
                               <!-- <ul>
                                    <li><i class="fab fa-facebook-f"></i></li>
                                    <li><i class="fab fa-twitter"></i></li>
                                    <li><i class="fab fa-linkedin-in"></i></li>
                                </ul>-->
                            </div>
                            <div class="row">
                                
                            </div>
                           
                            <form action="" method="POST"  autocomplete="off">
                            <div class="text-box-cont">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        <span class="input-group-text" id="basic-addon1" >
                                        <i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="FIRST Name" required="true" id="fname" onkeyup='fnameValidation(this)' name="firstname" aria-label="username" aria-describedby="basic-addon1">
                                   <span id="name" class="new" style="color:red;"></span> 
                                </div>
                               
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="LAST NAME"  id="lname" required="true" onkeyup='lnameValidation(this)'  name="lastname" aria-label="username" aria-describedby="basic-addon1">
                                    <span id="name" class="new"></span> 
                                </div>




                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email Address"  required="true" onkeyup='emailValidation(this)' id="email"  name=" eid" aria-label="Username" aria-describedby="basic-addon1">
                                    <span id="mail" class="new"></span> 
                                </div>
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                   
                                      <input type="password" class="form-control" name="password"   required="ture" onkeyup='passwordValidation(this)' placeholder="Password(minimum 5characters)" id="pass" aria-label="Username" aria-describedby="basic-addon1">
                                      <span id="pass1" class="new"></span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                   
                                    <input type="password" class="form-control" placeholder="Retype-Password" required="true" id="repass"  onkeyup='cpasswordValidation(this)' aria-label="Username" aria-describedby="basic-addon1">
                                    <span id="pass2" class="new"></span>
                                      
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                   
                                    <input type="text" class="form-control"   name="regaadharno"  onkeyup='aadharValidation(this)' required="true" placeholder="Enter AadharNumber" id="aadharno" required="true" aria-label="Username" aria-describedby="basic-addon1">
                                    <span id="aadhar" class="new"></span>
                                      
                                </div>
                                
                                 <div class="form-row">
                                    <label class="form-checkbox">
                                        <input type="checkbox" name="checkbox" value="check" required="true">
                                        <span>I agree to the Aadhaar based demographic authentication and
                                            I also understand the confidential nature
                                            of my personal information provided by me
                                            for authentication.I will ensure safety</span>
                                           
                                    </label>
                                </div> 
                                
                                   
                               
                               
                                <div class="input-group center sup mb-3">
                                    <input type="submit" value="sign Up" name="submit" id="submit-button" onclick="registration()"class="btn btn-success btn-round"></button>
                                    <input type="reset" onclick="clearFunc()" class="btn btn-success btn-round"></button>
                                </div>    
                            </div>
                            


                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
<script>
   function fnameValidation(inputTxt){
    
    var regx = /^[a-zA-Z]+$/;
    var textField = document.getElementById("name");
        
    if(inputTxt.value != '' ){
    
        if(inputTxt.value.length >= 2){
        
            if(inputTxt.value.match(regx)){
                textField.textContent = '';
                textField.style.color = "green";
                    
            }else{
                textField.textContent = 'only characters are allowded to insert!';
                textField.style.color = "red";
            }  
        }else{
            textField.textContent = 'your input must more than two chracters';
            textField.style.color = "red";
        }   
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
function lnameValidation(inputTxt){
    
    var regx = /^[a-zA-Z]+$/;
    var textField = document.getElementById("name");
        
    if(inputTxt.value != '' ){
    
        if(inputTxt.value.length >= 2){
        
            if(inputTxt.value.match(regx)){
                textField.textContent = '';
                textField.style.color = "green";
                    
            }else{
                textField.textContent = 'only characters are allowded to insert!';
                textField.style.color = "red";
            }  
        }else{
            textField.textContent = 'your input must me more than two chracters';
            textField.style.color = "red";
        }   
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
function emailValidation(inputTxt){
    // ^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$
    var regx = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    var textField = document.getElementById("mail");
        
    if(inputTxt.value != '' ){
        if(inputTxt.value.match(regx)){
            textField.textContent = '';
            textField.style.color = "green";
        }else{
            textField.textContent = 'email id  is not valid!!! please insert a valid one';
            textField.style.color = "red";
        }  
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
function passwordValidation(inputTxt){
    
    var regx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/;
    var textField = document.getElementById("pass1");
        
    if(inputTxt.value != '' ){
            if(inputTxt.value.match(regx)){
                textField.textContent = '';
                textField.style.color = "green";
                    
            }else{
                textField.textContent = 'Must contain at least one number and one uppercase and lowercase letter and aleast 5 characters';
                textField.style.color = "red";
            }    
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
function cpasswordValidation(inputTxt){
    
    var regx =  document.getElementById("pass").value;
    var regy =  document.getElementById("repass").value;
    var textField = document.getElementById("pass2");
    var textField1 = document.getElementById("pass1");
        
    if(inputTxt.value != '' ){    
            if(regx == regy){
                textField.textContent = '';
                textField.style.color = "green";
                    
            }else{
                textField.textContent = 'Entered to passwords are not same!!';
                textField.style.color = "red";
            }  
        }else{
            textField.textContent = '';
            textField.style.color = "red";
        }  
}
function aadharValidation(inputTxt){
   
    var regx = /^[2-9]{1}[0-9]{3}\s{1}[0-9]{4}\s{1}[0-9]{4}$/;
    var textField = document.getElementById("aadhar");
        
    if(inputTxt.value != '' ){
        if(inputTxt.value.match(regx)){
            textField.textContent = '';
            textField.style.color = "green";
        }else{
            textField.textContent = 'Your aadhar number  is not valid!!! please insert a valid one';
            textField.style.color = "red";
        }  
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
</script>
<script src="assets/logreg/js/jquery-3.2.1.min.js"></script>
<script src="assets/logreg/js/popper.min.js"></script>
<script src="assets/logreg/js/bootstrap.min.js"></script>
 <script src="assets/logreg/js/signupscript.js"></script> 
</html>