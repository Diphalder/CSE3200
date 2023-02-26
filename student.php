<?php

require 'connect_DB.php';

session_start();
$id =  $_SESSION['id'];

if($id==null){

    header('location:main.php');

}



$datatablelogin='login';
$dtPhoto='photo';
$dtfinalmark='finalmark';
$dtlogin='login';
$s = "select * from $dtlogin where id=$id ";
$r = mysqli_query($con,$s);
$v = mysqli_fetch_assoc($r);
$name=$v['name'];
$email= $v['email'];
$pass= $v['password'];
$type=$v['type'];
if($type=='Student')
{
    $roll=$v['roll'];
}
$dept=$v['dept'];
$phone=$v['phone'];

$profileCall=1;


if($type!="Student"){

    header('location:main.php');

}



$s = "select * from $datatablelogin where id=$id ";
$result = mysqli_query($con,$s);
$var = mysqli_fetch_assoc($result);
if($var['roll']=="")
{
    ?>
      <div class="d-flex justify-content-center">
    <div class="list" >
  
        <form  method='post'>
            <div class="form-group">
				<label>Enter your Roll</label>
					<input type="text" name="roll" class="form-control" required>
			</div>
            <div class="d-flex justify-content-end" >
                <button type="submit" class="btn btn-success" name="addroll" >Add</button></div>
            
        </form>
    </div>
    </div>
    <?php
}
else
{
    global $roll;
    $roll=$var['roll'];
}

if(isset($_POST["addroll"]))
{
    global $roll,$datatablelogin;
    $roll = $_POST['roll'];
    $s = "UPDATE $datatablelogin SET roll='$roll'  where id=$id ";
    mysqli_query($con,$s);
    ?>
    <script>
        alert('roll successfully added')
    </script>
    <?php
    header('location:student.php');

}

?>






<!DOCTYPE html>
<html>
<head>
<style>
        .largerCheckbox {
            width: 35px;
            height: 35px;
        }
    </style>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<title>Student Home Page</title>
<link rel="stylesheet" type="text/css" href="sstyle.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
        function myFunction() {
  var x = document.getElementById("profileid");
    x.style.display = "none";
  
}
        
    </script>
</head>
<body>

 


<div class="topnav">

  <form  method='post'>
            <button type="submit" class="btn btn-primary " name="viewprofile" >Home</button>
        </form>
 
    <a class="split" href="logout.php"><button class="btn btn-danger ">logout</button> </a>
    
</div>



<div id="profileid" >

<div class="list">

 

<div class="row">
        <div class="col-sm-3">
            <div class="minibox" >
                <div class="d-flex justify-content-center">
                    <p><h4><?php echo $name ?></h4></p>
                </div>
            </div>

                <?php 
                $sql = "SELECT * FROM $dtPhoto WHERE personID=$id ORDER BY id DESC";
                $res = mysqli_query($con,  $sql);

                if (mysqli_num_rows($res) != 0) {
                      $image = mysqli_fetch_assoc($res) 
                        ?>
         
                        <div class="d-flex justify-content-center" >
                             <img class="profilePic" alt="Image not found"   src="uploads/<?=$image['image_url']?>"  >
                        </div>
                    <?php 
                }
                else
                {
                    ?>
                    <div class="d-flex justify-content-center" >
                        <img class="profilePic"alt="Image not found"  src="uploads/blank.webp"  >
                    </div>
               <?php 

                }
                    
                ?>
          
    

        </div>
        <div class="col-sm-7">
            <div class="minibox">
                <div class="container" >
                <h3><p>Information :  </p></h3>


                <div class="row">
                        <div class="col-sm-3" >
                        <h6><p> Roll   </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php echo $roll;   ?></p>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Dept. code  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);
                        $deptcode=$dv['deptcode'];
                        $deptname=$dv['deptname'];

                        echo $deptcode;

                        
                        ?></p>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Dept. Name  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);
                        $deptcode=$dv['deptcode'];
                        $deptname=$dv['deptname'];

                        echo $deptname;

                        
                        ?></p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Year </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT year FROM student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['year'];

                        
                        ?></p>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Semester </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT sem From student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['sem'];

                        
                        ?></p>

                        </div>
                    </div>

                
                    <div class="row" >
                        <div class="col-sm-3" >
                        <h6><p>Email  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php echo $email ;?></p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" >

                        <h6><p>Phone No.  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >

                        <p>    <?php echo $phone; ?></p>

                        </div>
                    </div>
                    

                   






                

                 
                    


                </div>


             
            </div>
            <div class="d-flex justify-content-end" style="margin: 10px;">
                 <a href="editProfile.php"><button class="btn btn-success ">Edit Profile</button> </a>    
            </div>
            
        </div>
        
        <div class="col-sm-2">

 
            

         </div>

       

</div>


</div>



</div>




<?php
if(isset($_POST["viewprofile"]))
{
    echo '<script type="text/javascript">myFunction();</script>';

    ?>

    
<div class="list">

 

<div class="row">
        <div class="col-sm-3">
            <div class="minibox" >
                <div class="d-flex justify-content-center">
                    <p><h4><?php echo $name ?></h4></p>
                </div>
            </div>

                <?php 
                $sql = "SELECT * FROM $dtPhoto WHERE personID=$id ORDER BY id DESC";
                $res = mysqli_query($con,  $sql);

                if (mysqli_num_rows($res) != 0) {
                      $image = mysqli_fetch_assoc($res) 
                        ?>
         
                        <div class="d-flex justify-content-center" >
                             <img class="profilePic" alt="Image not found"   src="uploads/<?=$image['image_url']?>"  >
                        </div>
                    <?php 
                }
                else
                {
                    ?>
                    <div class="d-flex justify-content-center" >
                        <img class="profilePic"alt="Image not found"  src="uploads/blank.webp"  >
                    </div>
               <?php 

                }
                    
                ?>
          
    

          </div>
        <div class="col-sm-7">
            <div class="minibox">
                <div class="container" >
                <h3><p>Information :  </p></h3>

                
                    <div class="row" >
                        <div class="col-sm-3" >
                        <h6><p>Email  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php echo $email ;?></p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" >

                        <h6><p>Phone No.  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >

                        <p>    <?php echo $phone; ?></p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Dept. code  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);
                        $deptcode=$dv['deptcode'];
                        $deptname=$dv['deptname'];

                        echo $deptcode;

                        
                        ?></p>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Dept. Name  </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);
                        $deptcode=$dv['deptcode'];
                        $deptname=$dv['deptname'];

                        echo $deptname;

                        
                        ?></p>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Year </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT year FROM student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['year'];

                        
                        ?></p>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Semester </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT sem From student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['sem'];

                        
                        ?></p>

                        </div>
                    </div>







                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p> Roll   </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php echo $roll;   ?></p>

                        </div>
                    </div>

                 
                    


                </div>


             
            </div>
            <div class="d-flex justify-content-end" style="margin: 10px;">
                 <a href="editProfile.php"><button  class="btn btn-success ">Edit Profile</button> </a>    
            </div>
            
        </div>
        
        <div class="col-sm-2">

 
            

         </div>

       

</div>


</div>





<?php
}
?>



  



<div class="list" >
    <div class="d-flex justify-content-center">

    <div   class="btn-group">
        <form   method='post'>
            <button type="submit"  class="btn btn-primary"   name="viewCourse" >view current Semester Courses</button>
        </form>
    </div>

    <div  onclick="myFunction()" class="btn-group">
        <form  method='post'>
            <button type="submit"  class="btn btn-primary"  name="viewResult1" >view Result</button>
        </form>
    </div>

</div>
</div>








<?php







  //____________view course_____________
 

  if(isset($_POST["viewCourse"]))
  {
    echo '<script type="text/javascript">myFunction();</script>';

    ?>
    
    <?php



    if($roll!='')
    {
        echo '<script type="text/javascript">myFunction();</script>';
      global $id,$con,$datatablelogin;
      $datatable ="course";
      $s = "SELECT courselist.cid, courselist.ccode, courselist.cname, courselist.type, courselist.credit FROM courselist,student WHERE student.deptid=courselist.deptid and courselist.year=student.year and courselist.semester= student.sem and student.id =$id; ";
      $result = mysqli_query($con,$s);
      $num = mysqli_num_rows($result);

      if($num!=0)
      {
          ?>
          <div class="d-flex justify-content-center">

          <div class="list" >
          <div class='list'> 
          <div class="container" >
          <h3><p>Course list of :  </p></h3>
      

                
                    

                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Year </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT year FROM student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['year'];

                        
                        ?></p>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-3" >
                        <h6><p>Semester </p></h6>

                        </div>
                        <div class="col-sm-1" >
                        <h6><p>:</p></h6>
                        </div>
                        <div class="col-sm-8" >
                        <p>    <?php
                        
                        $ds = "SELECT sem From student WHERE student.id=$id";
                        $dr = mysqli_query($con,$ds);
                        $dv = mysqli_fetch_assoc($dr);

                        echo $dv['sem'];

                        
                        ?></p>

                        </div>
                    </div>


                </div>


      </div>   

       

          <table class="table table-striped table-bordered">
              <tr>
                  <td><h5>Course Code</h5></td>
                  <td><h5>Course Name</h5></td>
                  <td><h5>Credit</h5></td>
                  <td><h5>Type</h5></td>
                  <td colspan="10000000"><h5>Teacher allocated</h5></td>
              </tr>
          <?php

          while( $var = mysqli_fetch_assoc($result))
          {
              ?>
              <tr>
                  <td ><?php echo $var['ccode']?></td> 
                  <td ><?php echo $var['cname']?></td> 
                  <td ><?php echo $var['credit']?></td> 
                  <td ><?php echo $var['type']?></td>    
              <?php

              $c= $var['cid'];
              $s = "select * from $datatable where type='Teacher' && cid=$c ";
              $r = mysqli_query($con,$s);
              ?><?php
              while( $v = mysqli_fetch_assoc($r))
              {
                  $newid=$v['personID'];
                  $q = "select * from $datatablelogin WHERE id=$newid ";
                  $k = mysqli_query($con,$q);
                  $d = mysqli_fetch_assoc($k);
                  $tcrName=$d['name'];
                  echo "<td>".$tcrName."</td>";

              }
              ?><?php
           ?>
           </tr>
           
           <?php

          }

          ?>
            </table>
            

          </div>
          </div>

          <?php
        
      }
      else
      {
          ?>

        <div class="d-flex justify-content-center">
            
        <div class='list'>
            <div class="minibox">
                <h3>No Course are available</h3>

            </div>
        </div>
           
        </div>
  
          <?php

      }

    }
    else
    {
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Please add Roll number</h3>
            </div>
        </div>
        <?php


    }


     
  }





//______________view result____________________

if(isset($_POST["viewResult1"]))
{
    echo '<script type="text/javascript">myFunction();</script>';
        ?>
        <div class="d-flex justify-content-center">
        <div class="list" >
    <form method='post'>
        
        <div>
         <label>Year</label>
            <select class="form-control" name="year">
                <option value='1st' >  1st year </option>
                <option value='2nd' >  2nd year </option>
                <option value='3rd' >  3rd year </option>
                <option value='4th' >  4th year </option>
            </select>

        </div>
        <div>
         <label>Semester</label>
            <select class="form-control" name="sem">
                <option value='odd' >  Odd </option>
                <option value='even' >  Even </option>
            </select>

        </div>

        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success" name="viewResult2" >NEXT</button>

        </div>
    </form> 
    </div>
        </div>


    <?php

        
}





  if(isset($_POST["viewResult2"]))
  {
    echo '<script type="text/javascript">myFunction();</script>';

    if($roll!='')
    {
        $datatableMarks='marks';
    $datatableAttendance ="attendance";

    $days = ['Saturday','Sunday','Monday','Tuesday' ,'Wednesday'];

    $year = $_POST['year'];
    $sem = $_POST['sem'];


    $_SESSION['year']=$year;  
    $_SESSION['sem']=$sem;  


    $datatableCourse ="course";
    $s = "SELECT courselist.cid, courselist.ccode, courselist.cname FROM courselist,student WHERE student.deptid=courselist.deptid and courselist.year='$year' and courselist.semester='$sem' and student.id =$id and  courselist.type='Theory'; ";
    $result = mysqli_query($con,$s);
    $number = mysqli_num_rows($result);


    $courses=array($number);

    $i=0;
    while( $var = mysqli_fetch_assoc($result))
    {
        $cid[$i]=$var['cid'];
        $ccccc=$cid[$i];
        $ds = "SELECT * From courselist WHERE cid=$ccccc";
        $dr = mysqli_query($con,$ds);
        $dv = mysqli_fetch_assoc($dr);
        $course[$i]=$dv['ccode'];
        $i++;

    }



    ?>
    <div class='container'>
     <div class="d-flex justify-content-center">
    <div class="list" >
    <div class="d-flex justify-content-end" >
     <a target="_blank" href="generatePDF.php?id=<?=$row['id']?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
     </div>

    <div class="d-flex justify-content-center">
        <div class="list">
        

     <h3 style="text-align: center;">Result-sheet</h3>
     <h5 style="text-align: center;" >Dept code : <?php echo $deptcode?></h5>
    <h5 style="text-align: center;"> Dept name : <?php echo $deptname?></h5>
    <h5 style="text-align: center;">Year : <?php echo $year?></h5>
    <h5 style="text-align: center;">Semester : <?php echo $sem?></h5>
        <table class="table table-striped table-bordered"">
            <tr>
                <td><h5>Course<br> Code</h5></td>
                <td><h5>Percentage<br> of<br> Attendance</h5></td>
                <td><h5>Attendance<br> Marks</h5></td>
                <td><h5>CT-1</h5></td>
                <td><h5>CT-2</h5></td>
                <td><h5>CT-3</h5></td>
                <td><h5>CT-4</h5></td>
                <td><h5>CT<br> Marks<br>(best<br> of<br> three)</h5></td>
                <td><h5>Final<br> mark <br>[ Part-A ]</h5></td>
                <td><h5>Final<br> mark <br>[ Part-B ]</h5></td>
                <td><h5>Total<br> Marks</h5></td>
                <td><h5>Grade</h5></td>
                <td><h5>Grade<br> Point</h5></td>
            </tr>

    <?php
    for($i=0;$i<$number;$i++)
    {
        echo "<tr>";
        echo "<td>$course[$i]</td>";

        $total=0;
        $prsnt=0;

        for($j=1;$j<=15;$j++)
        {
            foreach($days as $k)
            {                  
                $s = "select * from $datatableAttendance where day='$k' && cycle='$j' && cid='$cid[$i]' && roll='$roll'  ORDER BY id DESC";
                $result = mysqli_query($con,$s);
                $num = mysqli_num_rows($result);
                $ans=0;

                if($num==0)
                {
                    continue;
                }
                $total++;
                
                $var = mysqli_fetch_assoc($result);
                $ans=$var['attendance'];
                 
                if($ans==1)
                {
                    $prsnt++;
                }
                
            } 

        }
        if($total==0)
        {
            $percentage=0;
        }
        else
        {
            $percentage=round(($prsnt/$total)*100,2);
        }
        
        echo "<td>$percentage%</td>";

        $Amark=0;
        if($percentage>=90)
        {
            $Amark=8;
        }
        else if($percentage>=85)
        {
            $Amark=7;
        }
        else if($percentage>=80)
        {
            $Amark=6;
        }
        else if($percentage>=70)
        {
            $Amark=5;
        }
        else if($percentage>=60)
        {
            $Amark=4;
        }
        echo "<td> $Amark</td>";
        //_________________CT MARKS_______________

        $marksList=array(6);
        for($j=0;$j<=5;$j++)
        {
            $marksList[$j]=0;
        }
        
        for($j=1;$j<=4;$j++)
        {
            $ans=0;              
                $s = "select * from $datatableMarks where ctNo='$j' && cid='$cid[$i]' && roll='$roll' ORDER BY id DESC ";
                $result = mysqli_query($con,$s);
                $num = mysqli_num_rows($result);
                

                if($num==0)
                {
                    echo "<td></td>";
                    continue;
                }

                else
                {
                    $var = mysqli_fetch_assoc($result);
                    
                    $ans=$var['marks'];
                    $tcrName=$var['teacher'];
                    if($ans=='A')
                    {
                        $ans=0;
                    }

                }
                echo "<td title='$tcrName'>$ans</td>";
                 
                $marksList[$j]=$ans;     

        }


        rsort($marksList);
        $ans=$marksList[0]+$marksList[1]+$marksList[2];

        $CTmarks=ceil($ans/3);
        echo "<td>$CTmarks</td>";



        //_________final mark_________________


        $finalmark=0;
        $partAmark=0;
        $partBmark=0;


        $s = "select * from $dtfinalmark  Where cid='$cid[$i]' && roll='$roll' ORDER BY id DESC ";
        $result = mysqli_query($con,$s);
        $nummm = mysqli_num_rows($result);
                

        
        if($nummm!=0)
        {
            $var = mysqli_fetch_assoc($result);
            $partAmark= (int)$var['partA'];
            $partBmark= (int)$var['partB'];           
            $finalmark=$partAmark+$partBmark;

        }


        echo "<td>$partAmark</td>";
        echo "<td>$partBmark</td>";




        $totalmarks=$CTmarks+$Amark+$finalmark;
        echo "<td>$totalmarks</td>";



        if($totalmarks>=80)
        {
            $grade='A+';
            $gradePoint='4.00';
        }
        else if($totalmarks>=75)
        {
            $grade='A';
            $gradePoint='3.75';
        }
        else if($totalmarks>=70)
        {
            $grade='A-';
            $gradePoint='3.50';
        }
        else if($totalmarks>=65)
        {
            $grade='B+';
            $gradePoint='3.25';
        }
        else if($totalmarks>=60)
        {
            $grade='B';
            $gradePoint='3.00';
        }
        else if($totalmarks>=55)
        {
            $grade='B-';
            $gradePoint='2.75';
        }
        else if($totalmarks>=50)
        {
            $grade='C+';
            $gradePoint='2.50';
        }
        else if($totalmarks>=45)
        {
            $grade='C';
            $gradePoint='2.25';
        }
        else if($totalmarks>=40)
        {
            $grade='D';
            $gradePoint='2.00';
        }
        else
        {
            $grade='F';
            $gradePoint='0';
        }



        echo "<td>$grade</td>";
        echo "<td>$gradePoint</td>";



        echo "</tr>";
        
    }

    $_SESSION['pdf']='stu_result.php';

    ?></table>

    </div>
    
    </div>
    
    </div><?php



    
        





    }
    else
    {
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Please add Roll number</h3>
            </div>
        </div>
        <?php


    }



    



  }













?>











</body>
</html>