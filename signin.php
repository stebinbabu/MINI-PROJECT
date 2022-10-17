
<?php
    include 'connection.php';
    //connecting html form and php
    if(isset($_POST['submit'])){
        $email = $_POST['loginEmail'];
        $password = $_POST['password'];
        $pwd = md5($password);

        //fetching data from database
        $query = "SELECT * from tbl_login where email = '$email' AND password='$pwd'";
        $result = mysqli_query($conn,$query);

        //fetching username and password from query as object
        if($result && mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username']="Admin";
            $_SESSION['id']=$row['login_Id'];
            $_SESSION['email']=$row['email'];
            $role = $_COOKIE['login_role'];
            // if($role=" Citizen")
            echo"<script Type='text/javascript'>alert('Login Success')</script>";
            echo"<script>window.location.href='dashindex.html'</script>";
        }
        else{
            echo"<script Type='text/javascript'>alert('Oops!...Login Failed')</script>";
            echo"<script>window.location.href='http://localhost/NEW EVPLUG/index.html</script>";
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Login Page</title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
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
                      <div class="col-lg-8 col-md-7 log-det">
                             <!-- <div class="small-logo">
                                <i class="fab fa-asymmetrik"></i> 
                            </div>-->
                            <h2>Sign in</h2>
                            <div class="row">
                              
                            </div>
                        

                            <form action="signin.php" method="POST">
                                <div class="text-box-cont">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Username" id="uname" name="loginEmail" onkeyup='emailValidation(this)' aria-label="Username" aria-describedby="basic-addon1">
                                        <span id="mail" class="new"></span> 
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="pass"name="password" placeholder="password" onkeyup='passwordValidation(this)' aria-label="Username" aria-describedby="basic-addon1">
                                        <span id="pass1" class="new"></span>
                                    </div>
                                    
                                    <div class="form-control"  aria-label="Username" aria-describedby="basic-addon1">  Select the User type :
                                        <select name="role" id="role">
                                            <option value= disabled>Select a option</option>
                                            <option value="index.php">Citizen</option>
                                            <option value="member">Member</option>
                                            <option value="staff">Staff</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>

                                    <div class="g-recaptcha brochure__form__captcha" data-sitekey="6LduWTEiAAAAABmquMY3LVhUCbXeQOvn8j8q2LzR"></div>
                                    <div class="row">
                                        <a href="forgotpassword.html"><p class="forget-p">Forget Password ?</p></a>
                                    </div>
                                    <div class="input-group center mb-3">
                                        <input type="submit" name="submit" onclick="login()" class="btn btn-success btn-round"></button>
                                        <input type="reset" onclick="clearFunc()" class="btn btn-success btn-round"></button>
                                    </div>    
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-5 box-de">
                            <div class="ditk-inf">
                                <h2 class="w-100">Din't Have an Account </h2>
                                <p>Simply Create your account by clicking the Signup Button</p>
                                <a href="signup.php">
                                <button type="button" class="btn btn-outline-light">SIGN UP</button>
                                </a>
                                <a href="index.html">
                                    <button type="button" class="btn btn-outline-light">HOME</button>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

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
</script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="assets/logreg/js/jquery-3.2.1.min.js"></script>
<script src="assets/logreg/js/popper.min.js"></script>
<script src="assets/logreg/js/bootstrap.min.js"></script>
<script src="assets/logreg/js/signinscript.js"></script>
</html>
