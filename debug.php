<?php
    include 'connection.php';

    error_reporting(0);
    
    session_start();
    
    if (isset($_SESSION['username'])) {
        header("Location: index.php");
    }
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['eid'];
        $password = ($_POST['password']);
        $aadno = ($_POST['aano']);
        echo "$username";
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO `tbl_login`(`login_Id`, `email`, `password`, `Status`, `Role`) VALUES ('','$email','$password',1,4)";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Wow! User Registration Completed.')</script>";
                    
                } else {
                    echo "<script>alert('Woops! Something Wrong Went.')</script>";
                }
            }
            // $value="INSERT INTO   tbl_registration (email,Aadhar_no)
            // VALUES ('$email','$aadno')";
            
        } 
    
?>


if (isset($_POST['register'])) {
//   // receive all input values from the form
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
  $contact =  $_POST['contact'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $email = $_POST['email'];
  $pwd =  $_POST['pwd'];
  $password = md5($pwd);



  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_login WHERE email='$email'";
  $checkqueryresult = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($checkqueryresult);
  if ($user){ // if user exists
    if ($user['email'] == $email) {
      array_push($errors, "Email already exists");
    }
    
  }

  <!-- //Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $log_query = "INSERT INTO tbl_login(email,password,type,status)VALUES('$email','$password',2,1)";
  	$logqueryresult = mysqli_query($db,$log_query);
    if($logqueryresult) {
      $idselectionquery = "SELECT loginId FROM tbl_login WHERE email='$email'";
      $idselectionqueryresult = mysqli_query($db, $idselectionquery);
      $user = mysqli_fetch_assoc($idselectionqueryresult);
      $loginId = $user['loginId'];
      $reg_query = "INSERT INTO tbl_user(userFirstName,userLastName,userContact,city,state,loginId)
      VALUES('$fname','$lname','$contact','$city','$state','$loginId')";
      $reg_queryresult = mysqli_query($db,$reg_query);
      if($reg_queryresult){
        echo"<script Type='text/javascript'>alert('Registration Success')</script>";
        echo"<script>window.location.href='http://localhost/NEW EVPLUG/index.html';</script>";
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
 <?php  endif ?> -->



 session_start();
if(isset($_SESSION['islogged'])){
    $islogged=$_SESSION['islogged'];
    if($islogged==true){
        header('Location: index.php');
        
    }
}

if (isset($_POST['submit'])) {
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
	$firstname = $_POST['firstname'];
    $lastname = $_POST['lasttname'];
	$email = $_POST['eid'];
	$password = ($_POST['password']);
    $pass=md5($password);
    $aadno = ($_POST['aano']);
    $sql1 = "INSERT INTO `tbl_login`(`login_Id`, `email`, `password`, `Status`, `Role`) VALUES ('','$email','$pass',1,4)";
    if(mysqli_query($conn, $sql1)){
        $user_id= mysqli_insert_id();
			if( mysqli_query($conn, $sql2)) {
				// $sql2="INSERT INTO `tbl_registration`(`Reg_id`, `login_Id`, `First_Name`, `Last_Name`, `Aadhar_no`, `mob_no`, `house_name`, `place`, `post_office`, `pin_code`, `dob`, `caste`, `gender`, `ward_no`, `religion`) VALUES ('','$(select `login_Id` from `tbl_login` where `email`='$email')','$firstname',' $lastname',' $aadno',0,'no','no','no',0,0,'no','no',0,'no')";
                echo"<script> alert('registration successful');</script>";
                $_SESSION['islogged']=true;
                $_SESSION['login_user']= $name;
                header('Location: index.php');
		
	}  else{
        echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
    }
 }
else{
    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($conn);
}
}





<!-- <?php
//  if(isset($_POST['submit'])){
//     $uid = $_POST['username'];
//     // $role=$_POST['role'];
//     $password = $_POST['password'];
//     $pass=md5($password);

//     $login_sql= "SELECT * FROM tbl_login WHERE email='$uid' AND  password='$pass'";
//     $logress=mysqli_query($conn,$login_sql);
//     //echo($logress);
//     if (mysqli_num_rows($logress) === 1) {
//         $details_sql= "SELECT * FROM tbl_registration WHERE u_Id='$uid'";
//         $detailsres=mysqli_query($conn,$details_sql);
//         if($detailsres){
//             $row=mysqli_fetch_array( $detailsres);
//             $_SESSION['islogged']=true;
//          $_SESSION['login_user']= $row['name'];  // Initializing Session with value of PHP Variable
//          echo "<script>alert('Login Successful !!')</script>";
//             header('Location: index.php');
//         }
//     }
//     else{
//         echo "<script>alert('Unable to Login !! Invalid email or password')</script>";
//     }
// }
?> -->







const usernameEl = document.querySelector('#fname');
const emailEl = document.querySelector('#email');
const passwordEl = document.querySelector('#pass');
const confirmPasswordEl = document.querySelector('#repass');

const form = document.querySelector('#signup');


const checkUsername = () => {

    let valid = false;

    const min = 3,
        max = 25;

    const username = usernameEl.value.trim();

    if (!isRequired(username)) {
        showError(usernameEl, 'Username cannot be blank.');
    } else if (!isBetween(username.length, min, max)) {
        showError(usernameEl, `Username must be between ${min} and ${max} characters.`)
    } else {
        showSuccess(usernameEl);
        valid = true;
    }
    return valid;
};


const checkEmail = () => {
    let valid = false;
    const email = emailEl.value.trim();
    if (!isRequired(email)) {
        showError(emailEl, 'Email cannot be blank.');
    } else if (!isEmailValid(email)) {
        showError(emailEl, 'Email is not valid.')
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
};

const checkPassword = () => {
    let valid = false;


    const password = passwordEl.value.trim();

    if (!isRequired(password)) {
        showError(passwordEl, 'Password cannot be blank.');
    } else if (!isPasswordSecure(password)) {
        showError(passwordEl, 'Password must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)');
    } else {
        showSuccess(passwordEl);
        valid = true;
    }

    return valid;
};

const checkConfirmPassword = () => {
    let valid = false;
    // check confirm password
    const confirmPassword = confirmPasswordEl.value.trim();
    const password = passwordEl.value.trim();

    if (!isRequired(confirmPassword)) {
        showError(confirmPasswordEl, 'Please enter the password again');
    } else if (password !== confirmPassword) {
        showError(confirmPasswordEl, 'The password does not match');
    } else {
        showSuccess(confirmPasswordEl);
        valid = true;
    }

    return valid;
};

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordSecure = (password) => {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(password);
};

const isRequired = value => value === '' ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;


const showError = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    let isUsernameValid = checkUsername(),
        isEmailValid = checkEmail(),
        isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword();

    let isFormValid = isUsernameValid &&
        isEmailValid &&
        isPasswordValid &&
        isConfirmPasswordValid;

    // submit to the server if the form is valid
    if (isFormValid) {

    }
});


const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

form.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username':
            checkUsername();
            break;
        case 'email':
            checkEmail();
            break;
        case 'password':
            checkPassword();
            break;
        case 'confirm-password':
            checkConfirmPassword();
            break;
    }
}));