<?php


require 'connect_DB.php';


?>

<html>
<head>
<title>Registration </title>
<link rel="stylesheet" type="text/css" href="sstyle.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script type="text/javascript">

function changeFunc(i) {
  if(i=='Teacher')
  {
    var x = document.getElementById("tcrid");
    x.style.display = "none";

  }
  else
  {

    var x = document.getElementById("tcrid");
    x.style.display = "block";


  }
}

</script>

</head>
<body>
<div class="d-flex justify-content-end" >
    <div style="margin: 10px;">
        <a href="main.php"><button class="btn btn-danger btn-block">Back</button> </a>
    </div>
</div>
                
	<div class="box" >
		<div class="login-box">
	
			<h2> Registration  </h2>
			<form method='post'>
				<div>
                    <select id="selectBox" onchange="changeFunc(value);" name="type" class="form-control">
                    <option  value="Student" >Student</option>    
                    <option value="Teacher" >Teacher</option>
                        
                    </select>
        
                </div>
            
                <div class="form-group">
					<label>Email*</label>
					<input type="email" name="email" class="form-control" required>
				</div>

				<div class="form-group">
					<label>password*</label>
					<input type="password" name="password" class="form-control" required>
				</div>
                <div class="form-group">
					<label>Re-password*</label>
					<input type="password" name="repassword" class="form-control"   required>
				</div>
                <div class="form-group">
					<label>Secret Code*</label>
					<input type="password" name="code" class="form-control" required>
				</div>
                <div class="form-group">
					<label>Name*</label>
					<input type="text" name="name" class="form-control" required>
				</div>
                <div class="form-group">
					<label>Phone Number</label>
					<input type="text" name="phone" class="form-control" value="">
				</div>
                <div class="form-group">
					<label>Department Name</label>
					<select class="form-control" name="deptid" required>
                    <?php  
                     global $id,$con;
                     $s = "select * from dept ";
                     $result = mysqli_query($con,$s);
                     $num = mysqli_num_rows($result);        
                     
                    while( $var = mysqli_fetch_assoc($result))
                        { ?><option value="<?php echo $var['deptid']?>" ><?php echo $var['deptcode']?></option>
                            <?php
                        }
                
                        ?>
                </select>
				</div>

                <div id="tcrid">
                <div class="form-group">
                <label>Year</label>
          <select class="form-control" name="year">
                    <option value='1st' >  1st year </option>
                    <option value='2nd' >  2nd year </option>
                    <option value='3rd' >  3rd year </option>
                    <option value='4th' >  4th year </option>
                </select>
           
          </div>
          <div class="form-group" >
          <label>Semester</label>


          <select class="form-control" name="sem">
          <option value='odd' >  Odd </option>
          <option value='even' >  Even </option>
      
        </select>   
    </div>     
                    </div>


				<button type="submit" class="btn btn-primary  btn-block" name="loginSubmit" > Login</button>

			</form> 
		</div>
        
            

	

    <?php 




if(isset($_POST["loginSubmit"]))
{

    $datatableLogin ="login";


    $email = $_POST['email'];
    $pass = $_POST['password'];
    $repass = $_POST['repassword'];
    $type = $_POST['type'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $deptid = $_POST['deptid'];
    $phone = $_POST['phone'];

    $year = $_POST['year'];
    $sem = $_POST['sem'];

    $datatablestudent ="student";
    
    $s = "select * from $datatableLogin where email='$email' ";
    $result = mysqli_query($con,$s);
    $num = mysqli_num_rows($result);

   



    if($pass==$repass)
    {


        if($num==0)
        {

            if(($code==47&&$type=="Teacher")||($code==67&&$type=="Student"))
            {
                session_start();
    
    
                $query = "INSERT INTO $datatableLogin VALUES('','$email','$pass','$type','$name',$deptid,'$phone','') ";
        
                //mysqli_query($con,$query);
                if(mysqli_query($con,$query)){
                    echo "<script>alert('data stored');</script>";
                    }else{
                    echo mysqli_error($con);
                    }
        
        
                $s = "select * from $datatableLogin where email='$email' && password = '$pass' && type='$type' ";
                $result = mysqli_query($con,$s);
                $var = mysqli_fetch_assoc($result);


    
                $iidd=$var['id'];
                if($type=="Teacher"){

                    $ss = "INSERT INTO $datatablestudent VALUES($iidd,$deptid,'','') ";
                    mysqli_query($con,$ss);
 
                }
                if($type=="Student")
                {
                    $ss = "insert into $datatablestudent values($iidd,$deptid,'$year','$sem') ";
                    mysqli_query($con,$ss);
                }
        
                $_SESSION['id']= $var["id"];
                $_SESSION['email']= $email ;
                $_SESSION['pass']= $pass ;
                $_SESSION['name']= $name ;
                $_SESSION['deptid']=$deptid ;
                $_SESSION['phone']=$phone ;
                $_SESSION['type']=$type;
        
                if($type=="Teacher"){
        
                    header('location:teacher.php');
        
                }
                if($type=="Student")
                {
                    header('location:student.php');
        
                }


            }
            else
            {
                ?>
            <div class="d-flex justify-content-center">
              
                 <h3> <p class="p-3 mb-2 bg-danger text-white">Secret-code Wrong</p> </h3>

            </div>
             <?php



            }




        }
        else{

            ?>
        <div class="d-flex justify-content-center  ">
            <h3> <p class="p-3 mb-2 bg-danger text-white">Email already exist</p> </h3>
        </div>
        <?php




        }



    }
    else{

        ?>
        <div class="d-flex justify-content-center">
        <h3> <p class="p-3 mb-2 bg-danger text-white">Password is diffrent</p> </h3>
        </div>
        <?php
    

    }

   



}




  
?>




    </div>
</body>


</html>