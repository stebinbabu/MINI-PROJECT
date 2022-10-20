<?php 
    include("admindashtemp.php");
    require_once ('connection.php');
    $errors = array(); 

    // session_start();
    if (isset($_POST['addemp_submit'])) {
        $firstname = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $house_name=$_POST['hname'];
        $gender = $_POST['gender'];
        $place=$_POST['palce'];
        $pincode=$_POST['pincode'];
        $dept = $_POST['dept'];
        $password = $_POST['psw'];
        $pwd = md5($password);
        $salary = $_POST['salary'];
        $dob =$_POST['dob'];
        //echo "$birthday";
        $files = $_FILES['file'];
        $filename = $files['name'];
        $filrerror = $files['error'];
        $filetemp = $files['tmp_name'];
        $fileext = explode('.', $filename);
        $filecheck = strtolower(end($fileext));
        $fileextstored = array('png' , 'jpg' , 'jpeg');
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM tbl_login WHERE email='$email'";
        $checkqueryresult = mysqli_query($conn, $user_check_query);
        if ($checkqueryresult){
            
            if(mysqli_num_rows($checkqueryresult)==1){
                // if user exists
                array_push($errors, "Email already exists");
                // echo"<script Type='text/javascript'>alert('Email already exists')</script>";
            }
            else if (count($errors) == 0){  

                if(in_array($filecheck, $fileextstored)){
            
                    $destinationfile = 'assets/images/'.$filename;
                    move_uploaded_file($filetemp, $destinationfile);
                
                    $sql = "INSERT INTO tbl_staff VALUES (null,'$firstname','$lastName','$gender',$contact,'$house_name','$place',$pincode,'$dept','$dob','$destinationfile')";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$pwd',1,3)";
                        $logqueryresult = mysqli_query($conn,$log_query);
                        if($logqueryresult){
                            echo ("<script>window.alert('Succesfully registered');</script>");
                            // window.location.href='..//viewemp.php';
                        }
                        else{
                            echo "<script>window.alert('Staff registration failed !!');</script>";
                        }
                        //header("Location: ..//aloginwel.php");
                    }
                    else{
                        echo ("<script>window.alert('Staff registration failed to regsiter !!');</script>");
                        // window.location.href='javascript:history.go(-1)';
                    }
    
                    // $last_id = $conn->insert_id;
                    
                    // $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
                    // $salaryQ = mysqli_query($conn, $sqlS);
                    // $rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");
                }
                else{
                    $sql = "INSERT INTO `tbl_staff`(`staff_id`, `firstName`, `lastName`, `gender`, `contact`, `HouseName`, `Palce`, `pincode`, `Department`, `dob`, `pic`,`status`) VALUES ('','$firstname','$lastName',' $gender',' $contact','$house_name','$place','$pincode',' $dept',' $dob ','images/no.jpg')";
                    //  $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`,  `address`, `dept`, `degree`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$nid','$address','$dept','$degree',)";
            
                    $result = mysqli_query($conn, $sql);
                    $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$pwd',1,3)";
                    $logqueryresult = mysqli_query($conn,$log_query);

                    if($result){
                        $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$pwd',1,3)";
                        $logqueryresult = mysqli_query($conn,$log_query);
                        if($logqueryresult){
                            echo ("<script>window.alert('Succesfully registered');</script>");
                        }
                        else{
                            echo "<script>window.alert('Staff registration failed !!');</script>";
                        }
                    }
                    else{
                        echo ("<script>window.alert('Staff registration failed to regsiter !!');</script>");
                    }
    
                    //  $last_id = $conn->insert_id;
                    
                    // $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
                    // $salaryQ = mysqli_query($conn, $sqlS);
                    // $rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");
            
                    // if(($result) == 1){
                        
                    //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                    //     window.alert('Succesfully Registered')
                    //     window.location.href='..//viewemp.php';
                    //     </SCRIPT>");
                        //header("Location: ..//aloginwel.php");
                    // }
                    
                    // else{
                    //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                    //     window.alert('Failed to Registere')
                    //     window.location.href='javascript:history.go(-1)';
                    //     </SCRIPT>");
                    // }
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
    <!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Add Employee</title>

    <!-- Icons font CSS-->
    <link href="addstaffvendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="addstaffvendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="addstaffvendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="addstaffvendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="assets\css\addstaffstyle.css" rel="stylesheet" media="all">
</head>

<body>
    <header>
        
    </header>
    
    <!-- <div class="divider"></div> -->
      <!-- <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo"> -->
     <div class="wrapper wrapper--w680">  
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form action="addemp.php" method="POST" enctype="multipart/form-data">


                        

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="First Name" name="firstName" onkeyup='fnameValidation(this)' required="required">
                                     <span id="lname" class="new" style="color:red;"></span> 
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Last Name" name="lastName"  onkeyup='lnameValidation(this)' required="required">
                                    <span id="name" class="new"></span> 
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email" onkeyup='emailValidation(this)' required="required">
                            <span id="mail" class="new"></span>
                        </div>
                        <p>Birthday</p>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="Date of Birth"  name="dob" required="required">
                                    <span id="data" class="new"></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">GENDER</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Contact Number" onkeyup='contactValidation(this)' name="contact" required="required" >
                            <span id="phno" class="new"></span>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="house name" name="hname" onkeyup='housenameValidation(this)'required="required">
                            <span id="hname" class="new"></span>
                        </div>

                        
                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="palce" name="palce" onkeyup='placeValidation(this)' required="required">
                            <span id="place" class="new"></span>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="postoffice" name="postoffice" onkeyup='pofficeValidation(this)' required="required">
                            <span id="poffice" class="new"></span>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="pincode" name="pincode" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Department" name="dept" required="required">
                        </div>

                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="password" onkeyup='passwordValidation(this)' name="psw" required="required">
   
                            <span id="pass1" class="new"></span>
                        </div> 

                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Salary" name="salary">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="file" placeholder="uplaod profie pic" name="file">
                        </div>







                        <div class="p-t-20">
                        <input class="btn btn--radius btn--green" type="submit" name="addemp_submit">
                            <!-- <button class="btn btn--radius btn--green" type="submit">Submit</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="addstaffvendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="addstaffvendor/select2/select2.min.js"></script>
    <script src="addstaffvendor/datepicker/moment.min.js"></script>
    <script src="addstaffvendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="assets\js\addstaffscp.js"></script>
    <script>function fnameValidation(inputTxt){
    
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
function contactValidation(inputTxt){
var phoneno =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
var textField = document.getElementById("phno");
        
    if(inputTxt.value != '' ){
        if(inputTxt.value.match(phoneno)){
            textField.textContent = '';
            textField.style.color = "green";
        }else{
            textField.textContent = 'phone no  is not valid!!! please insert a valid one';
            textField.style.color = "red";
        }  
    }else{
        textField.textContent = 'your are not allowed  to leave a field  empty';
        textField.style.color = "red";
    }
}
function housenameValidation(inputTxt){
    
    var regx = /^[a-zA-Z]+$/;
    var textField = document.getElementById("h name");
        
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
function placeValidation(inputTxt){
    
    var regx = /^[a-zA-Z]+$/;
    var textField = document.getElementById("place");
        
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
function pofficeValidation(inputTxt){
    
    var regx = /^[a-zA-Z]+$/;
    var textField = document.getElementById("poffice");
        
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
// function validatedate(inputText)
//   {
//   var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
//   // Match the date format through regular expression
//   if(inputText.value.match(dateformat))
//   {
//   document.form1.text1.focus();
//   //Test which seperator is used '/' or '-'
//   var opera1 = inputText.value.split('/');
//   var opera2 = inputText.value.split('-');
//   lopera1 = opera1.length;
//   lopera2 = opera2.length;
//   // Extract the string into month, date and year
//   if (lopera1>1)
//   {
//   var pdate = inputText.value.split('/');
//   }
//   else if (lopera2>1)
//   {
//   var pdate = inputText.value.split('-');
//   }
//   var dd = parseInt(pdate[0]);
//   var mm  = parseInt(pdate[1]);
//   var yy = parseInt(pdate[2]);
//   // Create list of days of a month [assume there is no leap year by default]
//   var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
//   if (mm==1 || mm>2)
//   {
//   if (dd>ListofDays[mm-1])
//   {
//   alert('Invalid date format!');
//   return false;
//   }
//   }
//   if (mm==2)
//   {
//   var lyear = false;
//   if ( (!(yy % 4) && yy % 100) || !(yy % 400)) 
//   {
//   lyear = true;
//   }
//   if ((lyear==false) && (dd>=29))
//   {
//   alert('Invalid date format!');
//   return false;
//   }
//   if ((lyear==true) && (dd>29))
//   {
//   alert('Invalid date format!');
//   return false;
//   }
//   }
//   }
//   else
//   {
//   alert("Invalid date format!");
//   document.form1.text1.focus();
//   return false;
//   }
//   }
</script>

</body>

</html>
<!-- end document-->


<!-- if (isset($_POST['addemp_submit'])) {
    $firstname = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $house_name=$_POST['hname'];
    $gender = $_POST['gender'];
    $place=$_POST['palce'];
    $pincode=$_POST['pincode'];
    $dept = $_POST['dept'];
    $password = $_POST['psw'];
    $salary = $_POST['salary'];
    $dob =$_POST['dob'];
    //echo "$birthday";
    $files = $_FILES['file'];
    $filename = $files['name'];
    $filrerror = $files['error'];
    $filetemp = $files['tmp_name'];
    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored = array('png' , 'jpg' , 'jpeg');
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM tbl_login WHERE email='$email'";
    $checkqueryresult = mysqli_query($conn, $user_check_query);
    if ($checkqueryresult){
        
        if(mysqli_num_rows($checkqueryresult)==1){
            // if user exists
            array_push($errors, "Email already exists");
            // echo"<script Type='text/javascript'>alert('Email already exists')</script>";
        }
        else if (count($errors) == 0){  

            if(in_array($filecheck, $fileextstored)){
        
                $destinationfile = 'images/'.$filename;
                move_uploaded_file($filetemp, $destinationfile);
            
                $sql = "INSERT INTO `tbl_staff`(`staff_id`, `firstName`, `lastName`, `gender`, `contact`, `HouseName`, `Palce`, `pincode`, `Department`, `dob`, `pic`,) VALUES ('$firstname','$lastName',' $gender',' $contact','$house_name','$place','$pincode',' $dept','$dob','$destinationfile')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$password',1,1)";
                    $logqueryresult = mysqli_query($conn,$log_query);
                    if($logqueryresult){
                        echo ("<script>window.alert('Succesfully registered');</script>");
                        // window.location.href='..//viewemp.php';
                    }
                    else{
                        echo "<script>window.alert('Staff registration failed !!');</script>";
                    }
                    //header("Location: ..//aloginwel.php");
                }
                else{
                    echo ("<script>window.alert('Staff registration failed to regsiter !!');</script>");
                    // window.location.href='javascript:history.go(-1)';
                }

                // $last_id = $conn->insert_id;
                
                // $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
                // $salaryQ = mysqli_query($conn, $sqlS);
                // $rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");
            }
            else{
                $sql = "INSERT INTO `tbl_staff`(`staff_id`, `firstName`, `lastName`, `gender`, `contact`, `HouseName`, `Palce`, `pincode`, `Department`, `dob`, `pic`,`status`) VALUES ('','$firstname','$lastName',' $gender',' $contact','$house_name','$place','$pincode',' $dept',' $dob ','images/no.jpg')";
                //  $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`,  `address`, `dept`, `degree`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$nid','$address','$dept','$degree',)";
        
                $result = mysqli_query($conn, $sql);
                $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$password',1,4)";
                $logqueryresult = mysqli_query($conn,$log_query);

                if($result){
                    $log_query = "INSERT INTO tbl_login(email,password,Status,Role)VALUES('$email','$password',1,4)";
                    $logqueryresult = mysqli_query($conn,$log_query);
                    if($logqueryresult){
                        echo ("<script>window.alert('Succesfully registered');</script>");
                    }
                    else{
                        echo "<script>window.alert('Staff registration failed !!');</script>";
                    }
                }
                else{
                    echo ("<script>window.alert('Staff registration failed to regsiter !!');</script>");
                }

                //  $last_id = $conn->insert_id;
                
                // $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
                // $salaryQ = mysqli_query($conn, $sqlS);
                // $rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");
        
                // if(($result) == 1){
                    
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //     window.alert('Succesfully Registered')
                //     window.location.href='..//viewemp.php';
                //     </SCRIPT>");
                    //header("Location: ..//aloginwel.php");
                // }
                
                // else{
                //     echo ("<SCRIPT LANGUAGE='JavaScript'>
                //     window.alert('Failed to Registere')
                //     window.location.href='javascript:history.go(-1)';
                //     </SCRIPT>");
                // }
            }
        }
    }
} -->
