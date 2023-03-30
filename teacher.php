<?php

use Sabberworm\CSS\Value\Size;

require 'connect_DB.php';

session_start();
$id =    $_SESSION['id'];
$dtlogin = 'login';
$s = "select * from $dtlogin where id=$id   ";
$r = mysqli_query($con, $s);
$v = mysqli_fetch_assoc($r);
$name = $v['name'];
$email = $v['email'];
$pass = $v['password'];
$type = $v['type'];
if ($type == 'Student') {
    $roll = $v['roll'];
}
$dept = $v['dept'];
$phone = $v['phone'];
$datatablelogin = 'login';

$dtfinalmark = 'finalmark';




$dtPhoto = 'photo';


if ($type != "Teacher") {

    header('location:main.php');
}


?>





<html>

<head>
    <title> login and registration </title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("profileid");
            x.style.display = "none";

        }





        function selects() {
            var ele = document.getElementsByName('attendanceStatus[]');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
            }

            document.getElementById("unselectall").style.display = "block";
            document.getElementById("selectall").style.display = "none";
        }

        function deSelect() {
            var ele = document.getElementsByName('attendanceStatus[]');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = false;
            }
            document.getElementById("selectall").style.display = "block";
            document.getElementById("unselectall").style.display = "none";
        }
    </script>

    <style>
        input.largerCheckbox {
            width: 35px;
            height: 35px;
        }
    </style>

</head>

<body>





    <div class="topnav">

        <form method='post'>
            <button type="submit" class="btn btn-primary " name="viewprofile">Home</button>
        </form>

        <a class="split" href="logout.php"><button class="btn btn-danger ">logout</button> </a>

    </div>


    <div id="profileid">


        <div class="list">



            <div class="row">
                <div class="col-sm-3">
                    <div class="minibox">
                        <div class="d-flex justify-content-center">
                            <p>
                            <h4><?php echo $name ?></h4>
                            </p>
                        </div>
                    </div>


                    <?php
                    $sql = "SELECT * FROM $dtPhoto WHERE personID=$id ORDER BY id DESC";
                    $res = mysqli_query($con,  $sql);

                    if (mysqli_num_rows($res) != 0) {
                        $image = mysqli_fetch_assoc($res)
                    ?>

                        <div class="d-flex justify-content-center">
                            <img class="profilePic" alt="Image not found" src="uploads/<?= $image['image_url'] ?>">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="d-flex justify-content-center">
                            <img class="profilePic" alt="Image not found" src="uploads/blank.webp">
                        </div>
                    <?php

                    }

                    ?>



                </div>
                <div class="col-sm-7">
                    <div class="minibox">
                        <div class="container">
                            <h3>
                                <p>information : </p>
                            </h3>




                            <div class="row">
                                <div class="col-sm-3">
                                    <h6>
                                        <p>dept. code </p>
                                    </h6>

                                </div>
                                <div class="col-sm-1">
                                    <h6>
                                        <p>:</p>
                                    </h6>
                                </div>
                                <div class="col-sm-8">
                                    <p> <?php

                                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                                        $dr = mysqli_query($con, $ds);
                                        $dv = mysqli_fetch_assoc($dr);
                                        $deptcode = $dv['deptcode'];
                                        $deptname = $dv['deptname'];

                                        echo $deptcode;


                                        ?></p>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <h6>
                                        <p>Dept. Name </p>
                                    </h6>

                                </div>
                                <div class="col-sm-1">
                                    <h6>
                                        <p>:</p>
                                    </h6>
                                </div>
                                <div class="col-sm-8">
                                    <p> <?php

                                        $ds = "SELECT dept.deptcode,dept.deptname FROM dept,student WHERE dept.deptid=student.deptid and student.id=$id";
                                        $dr = mysqli_query($con, $ds);
                                        $dv = mysqli_fetch_assoc($dr);
                                        $deptcode = $dv['deptcode'];
                                        $deptname = $dv['deptname'];

                                        echo $deptname;


                                        ?></p>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6>
                                        <p>Email </p>
                                    </h6>

                                </div>
                                <div class="col-sm-1">
                                    <h6>
                                        <p>:</p>
                                    </h6>
                                </div>
                                <div class="col-sm-8">
                                    <p> <?php echo $email; ?></p>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">

                                    <h6>
                                        <p>Phone No. </p>
                                    </h6>

                                </div>
                                <div class="col-sm-1">
                                    <h6>
                                        <p>:</p>
                                    </h6>
                                </div>
                                <div class="col-sm-8">

                                    <p> <?php echo $phone; ?></p>

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





    </div>

    <div class="list">
        <div class="container">
            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="viewCourse">view Courses list</button>
                </form>
            </div>

            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="attendance">take Attendance</button>
                </form>

            </div>
            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="viewAttendance">view Attendance-Sheet</button>
                </form>

            </div>
            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="ctmark">store CT Mark</button>
                </form>
            </div>
            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="viewCTmarks">view CT-Mark Sheet</button>
                </form>
            </div>

            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="finalmark">add Final Mark</button>
                </form>
            </div>

            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="addlabmark">Lab Mark</button>
                </form>
            </div>
            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="addprojectmark">Project Mark</button>
                </form>
            </div>


            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="codesign">CO design</button>
                </form>
            </div>


            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="syllabusdesign">Syllabus design</button>
                </form>
            </div>


            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="inputco">Input CO marks</button>
                </form>
            </div>

            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="co">Course Outcome</button>
                </form>
            </div>

            <div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="viewResult">View Result</button>
                </form>
            </div>
        </div>
    </div>



    <?php


 // _________________syllabus design________________

 if (isset($_POST["syllabusdesign"]))
 {

    echo '<script type="text/javascript">myFunction();</script>';
    global $id, $con;
    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab')";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);




    if ($num != 0) {
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <form method='post'>
                    <h2> Syllabus Design </h2>
                    <div>
                        <label>Course Code</label>
                        <select class="form-control" name="course" required>
                            <?php
                            global $id, $con;
                            $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab')";
                            $result = mysqli_query($con, $s);
                            $num = mysqli_num_rows($result);

                            while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                            <?php
                            }

                            ?>
                        </select>

                    </div >
                    <br>
                    <br>
                    <div  >
                        <button type="submit" class="btn btn-success btn-block" name="syllabusview">View</button>

                    </div>
                    <br>

                    <div  >
                        <button type="submit" class="btn btn-success btn-block" name="syllabusesign2">Edit</button>

                    </div>
                </form>
            </div>
        </div>


    <?php


    } else {
    ?>

        <div class="d-flex justify-content-center">

            <div class='list'>
                <div class="minibox">
                    <h3>No Course are available</h3>

                </div>
                <div class="minibox">
                    <div class="form-group">
                        <form method='post'>
                            <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    <?php

    }



 }

 if (isset($_POST["syllabusview"]))
 {
    echo '<script type="text/javascript">myFunction();</script>';
    $cid = $_POST['course'];

    
    ?>


    <div class="d-flex justify-content-center">
        <div class="list">

          




  <div class="mini">
                <h3 style="text-align: center;">Syllabus Design</h3>
  </div>
  
  <div class="list">
                <table class="table table-striped">
                    <tr>
                    <td style="text-align: center;">
                            <h5>Week <br> no.</h5>
                        </td> 
                        <td style="text-align: center;">
                            <h5>Topic</h5>
                        </td>
                        <td style="text-align: center;" colspan="5">
                            <h5>Course Outcome </h5>
                        </td>
                   

                    
                    <?php 
                    
                    for($i=1;$i<=13;$i++)
                    {

                        $s = "select * from syllabus where personid='$id' && cid='$cid' && week='$i' ORDER BY id DESC";
                        $result = mysqli_query($con, $s);
                        $num = mysqli_num_rows($result);
                        $var = mysqli_fetch_assoc($result);
                        ?>
                    <tr>
                    <td style="text-align: center;"><h5><?php echo $i ?></h5></td>
                        <td style="max-width:500px;word-wrap:break-word;">
                          
                                <?php echo $var['topic']  ?>
                          
                        </td>
                            <?php
 
                            for($j=1;$j<=5;$j++)
                            {
                                $z='co'.$j;
                                if ($num != 0) 
                                {
                                if ($var[$z]=='1') 
                                {
                                    ?>
                           
                                        <td style="text-align: center;"> CO-<?php echo $j ?>  </td>
                                                                    
                                    <?php
                                }
                            }
                        
                             
                            }
                            ?>


                    </tr> 




                    <?php 
                    }?>


                </table>
  </div>
    

          
        </div>
    </div>

    <?php

 }


 if (isset($_POST["syllabusesign2"]))
 {
    echo '<script type="text/javascript">myFunction();</script>';
    $cid = $_POST['course'];

    
    ?>


    <div class="d-flex justify-content-center">
        <div class="list">

            <div class="form-group">

  <form  method='post'>

  <input type="hidden" name="cid" value="<?php echo $cid ?>">
  <div class="mini">
                <h3 style="text-align: center;">Syllabus Design</h3>
  </div>
  <form  method='post'> 
  
                <table class="table table-striped">
                    <tr>
                    <td style="text-align: center;">
                            <h5>Week <br> no.</h5>
                        </td> 
                        <td style="text-align: center;">
                            <h5>Topic</h5>
                        </td>
                        <td style="text-align: center;">
                            <h5>CO-1 </h5>
                        </td>
                        <td style="text-align: center;">
                            <h5>CO-2 </h5>
                        </td>
                        <td style="text-align: center;">
                            <h5>CO-3 </h5>
                        </td>
                        <td style="text-align: center;">
                            <h5>CO-4 </h5>
                        </td>
                        <td style="text-align: center;">
                            <h5>CO-5 </h5>
                        </td>

                    
                    <?php 
                    
                    for($i=1;$i<=13;$i++)
                    {

                        $s = "select * from syllabus where personid='$id' && cid='$cid' && week='$i' ORDER BY id DESC";
                        $result = mysqli_query($con, $s);
                        $num = mysqli_num_rows($result);
                        $var = mysqli_fetch_assoc($result);

                        $tpk="";
                        if($num)
                        {
                            $tpk=$var['topic'] ;
                        }

                        ?>
                    <tr>
                    <td style="text-align: center;"><h5><?php echo $i ?></h5></td>
                        <td>
                            <div class=" form-group">
                                <input type="text"  name="topic<?php echo $i ?>" class="form-control" value="<?php echo $tpk ?>">
                            </div>
                        </td>
                            <?php
 
                            for($j=1;$j<=5;$j++)
                            {
                                $z='co'.$j;
                                $click='';
                                if ($num != 0) {
                                if ($var[$z]=='1') 
                                {
                                    $click = 'checked';
                                }
                            }
                        
                            ?>
                           
                            <td style="text-align: center;"> <input type="checkbox" class="largerCheckbox" <?php echo  $click ?> value="wk<?php echo $i ?>co<?php echo $j ?>" name="wk[]"></td>
                                                                    
                            <?php 
                            }
                            ?>


                    </tr> 




                    <?php 
                    }?>


                </table>
    

                <button type="submit" class="btn btn-success btn-block" name="savesyllabus">Save</button>
                </form>
            </div>
        </div>
    </div>

    <?php

 }

 if (isset($_POST["savesyllabus"])) 
 {

    global $id;
    $cid = $_POST['cid'];
    $wk = $_POST['wk'];


    
    for ($i = 1; $i <= 13; $i++)
    {
        for ($j = 1; $j <= 5; $j++)
        {
            $z='wk'.$i.'co'.$j;
            $wkco[$z]="";
        }
    }

    for ($i = 0; $i < sizeof($wk); $i++) {
        $wkco[$wk[$i]]='1';
    }

    for ($i = 1; $i <= 13; $i++)
    {
        $z = 'topic' . $i;
        $topic = $_POST[$z];

        $co[]="";
        
        for ($j = 1; $j <= 5; $j++)
        {
            $z='wk'.$i.'co'.$j;
            $co[$j]=$wkco[$z];
        }



            $s = "select * from syllabus where personid='$id' && cid='$cid' && week='$i' ORDER BY id DESC";
            $result = mysqli_query($con, $s);
            $num = mysqli_num_rows($result);

            
            if ($num == 0) {
                $query = "INSERT INTO syllabus VALUES('','$id','$cid','$i','$topic','$co[1]','$co[2]','$co[3]','$co[4]','$co[5]') ";
                mysqli_query($con, $query);
            } 
            else {
                $var = mysqli_fetch_assoc($result);
                $newID = $var['id'];

                $query = "UPDATE syllabus SET co1='$co[1]', co2='$co[2]', co3='$co[3]',co4='$co[4]',co5='$co[5]',topic='$topic' WHERE id=$newID";

                mysqli_query($con, $query);
            }



            
    }
    ?>


    <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Data Store successfully</h3>
            </div>
        </div>
        <?php

 }










    // _________________course outcome design________________

    if (isset($_POST["codesign"])) 
    {

        echo '<script type="text/javascript">myFunction();</script>';
        global $id, $con;
        $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab')";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);




        if ($num != 0) {
            ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <form method='post'>
                        <h2> Course outcome Design </h2>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab')";
                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                <?php
                                }

                                ?>
                            </select>

                        </div >
                        <br>
                        <br>
                        <div  >
                            <button type="submit" class="btn btn-success btn-block" name="coview">View</button>

                        </div>
                        <br>

                        <div  >
                            <button type="submit" class="btn btn-success btn-block" name="codesign2">Edit</button>

                        </div>
                    </form>
                </div>
            </div>


        <?php


        } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php

        }
    }
    if (isset($_POST["coview"])) {
        echo '<script type="text/javascript">myFunction();</script>';
        $cid = $_POST['course'];


        ?>


        <div class="d-flex justify-content-center">
            <div class="list">

                <div class="form-group">


      <div class="list">
      <div class="mini">
                    <h3>Design CO[course outcome] Map PO [program outcome]</h3>
      </div>
      
                    <table class="table table-striped">
                        <tr> 
                            <td>
                                <h5>Course<br>outcome</h5>
                            </td>
                            <td>
                                <h5>CO statement</h5>
                            </td>
                    
                            <td>
                                <h5>Content</h5>
                            </td>
                            
                        </tr>

                        <?php

                        for ($i = 1; $i <= 5; $i++) {
                            $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory')";
                            $result = mysqli_query($con, $s);
                            $num = mysqli_num_rows($result);
                            $var = mysqli_fetch_assoc($result);



                            global $id, $con;
                            $sss = "SELECT * from copo where personid='$id' and co='$i' and cid='$cid'";
                            $rrr = mysqli_query($con, $sss);
                            $nnn = mysqli_num_rows($rrr);
                            $vvv = mysqli_fetch_assoc($rrr);


                            $stmnt = "";
                            $cnnt = "";
                            if ($nnn != 0) {
                                $stmnt = $vvv['statement'];
                                $cnnt = $vvv['content'];
                            }


                        ?>
                            <tr>
                            <td><div class="mini">CO-<?php echo $i ?></div> </td>

                                <td style="max-width:400px;word-wrap:break-word;">
                                    <div class=" form-group">
                                       <?php echo $stmnt ?>
                                    </div>
                              
                                <td style="max-width:400px;word-wrap:break-word;">
                                    <div class=" form-group">
                                        <?php echo $cnnt ?>

                                    </div>
                                <td>

                            <tr>

                            <tr>
                                <td></td>
                                
                                <td style="text-align: center;" colspan="2">
                                <div  style="text-align: center;" class="mini">
                                <table>
                                
                                <tr>
                                    
                                        <?php
                                        for ($j = 1; $j <= 12; $j++) 
                                        {
                                            $z='po'.$j;
                                            $click='';
                                            if ($nnn != 0) {
                                            if ($vvv[$z]=='1') 
                                            {
                                        ?> 
                            
                                            <td style="text-align: center;">PO-<?php echo $j ?></h5></td>
                                                
                                        <?php
                                            }
                                        }
                                        }
                                        ?>
                                        </tr>
                                        
            
                                        
                                </table>
                                </div>    
                            </td>

                            </tr>
                            <?php
                        } ?>
                    </table>
        

        
                </div>
            </div>
        </div>
        </div>

        <?php


    }




    if (isset($_POST["codesign2"])) {
        echo '<script type="text/javascript">myFunction();</script>';
        $cid = $_POST['course'];


        ?>


        <div class="d-flex justify-content-center">
            <div class="list">

                <div class="form-group">

      <form  method='post'>

      <input type="hidden" name="cid" value="<?php echo $cid ?>">
      <div class="mini">
                    <h3>Design CO[course outcome] Map PO [program outcome]</h3>
      </div>
      
                    <table class="table table-striped">
                        <tr> 
                            <td>
                                <h5>Course<br>outcome</h5>
                            </td>
                            <td>
                                <h5>CO statement</h5>
                            </td>
                    
                            <td>
                                <h5>Content</h5>
                            </td>
                            
                        </tr>

                        <?php

                        for ($i = 1; $i <= 5; $i++) {
                            $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory')";
                            $result = mysqli_query($con, $s);
                            $num = mysqli_num_rows($result);
                            $var = mysqli_fetch_assoc($result);



                            global $id, $con;
                            $sss = "SELECT * from copo where personid='$id' and co='$i' and cid='$cid'";
                            $rrr = mysqli_query($con, $sss);
                            $nnn = mysqli_num_rows($rrr);
                            $vvv = mysqli_fetch_assoc($rrr);


                            $stmnt = "";
                            $cnnt = "";
                            if ($nnn != 0) {
                                $stmnt = $vvv['statement'];
                                $cnnt = $vvv['content'];
                            }


                        ?>
                            <tr>
                            <td><div class="list">CO-<?php echo $i ?></div> </td>

                                <td>
                                    <div class=" form-group">
                                        <input type="text"  name="costatement<?php echo $i ?>" class="form-control" value="<?php echo $stmnt ?>">
                                    </div>
                              
                                <td>
                                    <div class=" form-group">
                                        <input type="text"  name="cocontent<?php echo $i ?>" class="form-control" value="<?php echo $cnnt ?>">

                                    </div>
                                <td>

                            <tr>

                            <tr>
                                <td></td>
                                
                                <td style="text-align: center;" colspan="2">
                                <div  style="text-align: center;" class="list">
                                <table>
                                
                                <tr>
                                    
                                        <?php
                                        for ($j = 1; $j <= 12; $j++) 
                                        { 
                                        ?>   
                                            <td style="text-align: center;">PO-<?php echo $j ?></h5></td>
                                                
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                        
                                        <tr>

                                         <?php
                                        for ($j = 1; $j <= 12; $j++) 
                                        { 



                                            $z='po'.$j;
                                            $click='';
                                            if ($nnn != 0) {
                                            if ($vvv[$z]=='1') 
                                            {
                                                $click = 'checked';
                                            }
                                        }



                                        ?>
                                            <td style="text-align: center;"> <input type="checkbox" class="largerCheckbox" <?php echo  $click ?> value="CO<?php echo $i ?>PO<?php echo $j ?>" name="pos[]"></td>
                                            
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                        
                                </table>
                                </div>    
                            </td>

                            </tr>
                            <?php
                        } ?>
                    </table>
        

                    <button type="submit" class="btn btn-success btn-block" name="savecopo">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <?php


    }



    if (isset($_POST["savecopo"])) {
        global $id;

        $cid = $_POST['cid'];
        $pos = $_POST['pos'];
    

        for ($i = 1; $i <= 5; $i++)
        {
            for ($j = 1; $j <= 12; $j++)
            {
                $z='CO'.$i.'PO'.$j;
                $copo[$z]="";
            }
        }

        for ($i = 0; $i < sizeof($pos); $i++) {
            $copo[$pos[$i]]='1';
        }



        for ($i = 1; $i <= 5; $i++) {

            $z = 'costatement' . $i;
            $costatement = $_POST[$z];
            
            $z = 'cocontent'.$i;
            $cocontent = $_POST[$z];

            $po[]="";
            for ($j = 1; $j <= 12; $j++)
            {
                $z='CO'.$i.'PO'.$j;
                $po[$j]=$copo[$z];
            }

            $s = "select * from copo where personid='$id' && cid='$cid' && co='$i' ORDER BY id DESC";
            $result = mysqli_query($con, $s);
            $num = mysqli_num_rows($result);

            if ($num == 0) {
                $query = "INSERT INTO copo VALUES('','$id','$cid','$i','$costatement','$cocontent','$po[1]','$po[2]','$po[3]','$po[4]','$po[5]','$po[6]','$po[7]','$po[8]','$po[9]','$po[12]','$po[11]','$po[12]') ";
                mysqli_query($con, $query);
            } else {
                $var = mysqli_fetch_assoc($result);
                $newID = $var['id'];

                $query = "UPDATE copo SET statement='$costatement', content='$cocontent' ,po1='$po[1]',po2='$po[2]',po3='$po[3]',po4='$po[4]',po5='$po[5]',po6='$po[6]',po7='$po[7]',po8='$po[8]',po9='$po[9]',po10='$po[10]',po12='$po[12]',po11='$po[11]' WHERE id=$newID";

                mysqli_query($con, $query);
            }
        }
        ?>


        <div class="d-flex justify-content-center">
                <div class="list">
                    <h3>Data Store successfully</h3>
                </div>
            </div>
            <?php
    }





    // _____________input co marks________________-
    if (isset($_POST["inputco"])) 
    {

        echo '<script type="text/javascript">myFunction();</script>';
        global $id, $con;
        $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id  and courselist.type ='Theory' ";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        if ($num != 0) {

        ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <form method='post'>
                        <h2> Input CO Marks </h2>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory')";
                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>


                        <div>
                            <label>select Exam type</label>
                            <select class="form-control" name="ctno">
                                <?php
                                echo "<option value='5' >  Semester-Final part-A  </option>";
                                echo "<option value='6' >  Semester-Final part-B  </option>";
                                for ($i = 1; $i <= 4; $i++) {
                                    echo "<option value='$i' >  CT-$i  </option>";
                                }
                                ?>
                            </select>

                        </div>

                        <div>
                            <label>Course Outcome</label>

                            <table class="table table-striped table-bordered" ">
                        <tr>
                            <td>Course outcome </td>
                            <td>select </td>
                            <td>Total mark </td>
                        </tr>
                        <?php
                         
                        for ($i = 1; $i <= 5; $i++) 
                        { 
                            ?><tr><td style=" text-align: center;">CO<?php echo $i ?></td>
                                <div class="checkbox">
                                    <td style="text-align: center;"><input type="checkbox" class="largerCheckbox" value="CO<?php echo $i ?>" name="COS[]"></td>
                                </div>

                                <td style="text-align: center;"><input type="number" min="0" max="100" value="0" name="totalCO<?php echo $i ?>"></td>
                                </tr>
                            <?php
                        }
                        ?>
                            </table>

                        </div>




                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="showCOmarkForm">NEXT</button>

                        </div>
                    </form>
                </div>
            </div>


        <?php


        } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php

        }
    }



    if (isset($_POST["showCOmarkForm"])) 
    {
        echo '<script type="text/javascript">myFunction();</script>';

        $rollStart = $_POST['rollStart'];
        $rollEnd = $_POST['rollEnd'];
        $course = $_POST['course'];
        $ctno = $_POST['ctno'];
        $COS = $_POST['COS'];

        $coTotalMark[] = "";


        for ($i = 0; $i < sizeof($COS); $i++) {
            $coTotalMark["$COS[$i]"] = $_POST["total$COS[$i]"];
        }



        $ds = "SELECT * From courselist WHERE cid=$course";
        $dr = mysqli_query($con, $ds);
        $dv = mysqli_fetch_assoc($dr);



        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <div class="list">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Code </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['ccode'] ?> </p>
                                </h5>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Name </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['cname'] ?> </p>
                                </h5>

                            </div>
                        </div>
                        <?php if ($ctno >= '1' && $ctno <= '4') { ?>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Class Test no. </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $ctno ?> </p>
                                    </h5>

                                </div>
                            </div>

                        <?php
                        } else if ($ctno == '5') {
                        ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        <p> Semester-final part-A </p>
                                    </h5>
                                </div>
                            </div>


                        <?php
                        } else if ($ctno == '6') {
                        ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        <p> Semester-final part-B </p>
                                    </h5>
                                </div>
                            </div>


                        <?php
                        }
                        ?>
                    </div>
                </div>



                <div class="d-flex justify-content-center">
                    <form method='post'>
                        <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                        <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                        <input type="hidden" name="course" value="<?php echo $course ?>">
                        <input type="hidden" name="ctno" value="<?php echo $ctno ?>">

                        <?php
                        for ($i = 0; $i < sizeof($COS); $i++) {
                        ?>
                            <input type="hidden" name="COS[]" value="<?php echo $COS[$i] ?>">
                        <?php

                        }
                        for ($i = 0; $i < sizeof($COS); $i++) {
                        ?>
                            <input type="hidden" name="total<?php echo $COS[$i] ?>" value="<?php echo $coTotalMark["$COS[$i]"] ?>">
                        <?php
                        }

                        ?>



                        <table class="table table-striped table-bordered" style="max-width: 500px;">
                            <tr>
                                <td>
                                    <h5>student Roll</h5>
                                </td>
                                <?php
                                for ($i = 0; $i < sizeof($COS); $i++) {
                                    $coid = $COS[$i];
                                    echo "<td><h5>$COS[$i]<br>$coTotalMark[$coid]</h5></td>";
                                }
                                ?>
                            </tr>

                            <?php
                            $datatable = 'marks';
                            for ($i = $rollStart; $i <= $rollEnd; $i++) {



                            ?>

                                <tr>
                                    <td><?php echo $i ?></td>



                                    <?php

                                    for ($j = 0; $j < sizeof($COS); $j++) {

                                        $s = "select * from co where no='$ctno' && cid='$course' && roll='$i' && cono='$COS[$j]' ORDER BY id DESC";
                                        $result = mysqli_query($con, $s);
                                        $num = mysqli_num_rows($result);

                                        $value;
                                        if ($num == 0) {
                                            $value = '';
                                        } else {
                                            $var = mysqli_fetch_assoc($result);
                                            $value = $var['mark'];
                                        }
                                        $coid = $COS[$j];

                                    ?>
                                        <td style="text-align: center;"><input type="number" min="0" max="<?php echo $coTotalMark[$coid] ?>" value="<?php echo $value ?>" name="<?php echo "$i$COS[$j]" ?>"></td>


                                    <?php

                                    }


                                    ?>
                                </tr><?php


                                    }

                                        ?>
                        </table>

                        <button type="submit" class="btn btn-success  btn-block" name="takeCOmarksDone">DONE</button>

                    </form>
                </div>
            </div>
        </div>
        <?php


    }


    if (isset($_POST["takeCOmarksDone"])) 
    {
        echo '<script type="text/javascript">myFunction();</script>';
        global $name;
        global $con;

        $rollStart = $_POST['rollStart'];

        $rollEnd = $_POST['rollEnd'];
        $course = $_POST['course'];
        $ctno = $_POST['ctno'];
        $COS = $_POST['COS'];

        $coTotalMark[] = '';


        for ($i = 0; $i < sizeof($COS); $i++) {
            $coTotalMark["$COS[$i]"] = $_POST["total$COS[$i]"];
            echo $coTotalMark["$COS[$i]"];
        }





        for ($i = $rollStart; $i <= $rollEnd; $i++) {


            for ($j = 0; $j < sizeof($COS); $j++) {

                $x = $_POST["$i$COS[$j]"];
                if ($x == "") {
                    $x = 'A';
                }
                $coid = $COS[$j];


                $s = "select * from co where no='$ctno' && cid='$course' && roll='$i' && cono='$COS[$j]' ORDER BY id DESC";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);

                if ($num == 0) {
                    $query = "INSERT INTO co VALUES('','$i','$course','$ctno','$COS[$j]','$x','$coTotalMark[$coid]') ";


                    mysqli_query($con, $query);
                } else {
                    $var = mysqli_fetch_assoc($result);
                    $newID = $var['id'];

                    $query = "UPDATE co  SET mark='$x' ,fullmark='$coTotalMark[$coid]' WHERE id=$newID";

                    mysqli_query($con, $query);
                }
            }
        }
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Data Store successfully</h3>
            </div>
        </div>
        <?php



    }







    //_____________CO_____________

    if (isset($_POST["co"])) 
    {
        echo '<script type="text/javascript">myFunction();</script>';

        global $id, $con;
        $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory' or courselist.type ='Lab' ";

        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        if ($num != 0) {

        ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3 style="text-align: center;"> Course Outcome </h3>
                    <form method='post'>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory' or courselist.type ='Lab' ";

                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>

                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-end">

                            <button type="submit" class="btn btn-success" name="viewCO">NEXT</button>

                        </div>
                    </form>

                </div>
            </div>
        <?php


        } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php


        }
    }


    if (isset($_POST["viewCO"])) 
    {
        echo '<script type="text/javascript">myFunction();</script>';

        $rollStart = $_POST['rollStart'];
        $rollEnd = $_POST['rollEnd'];
        $course = $_POST['course'];

        $ds = "SELECT * From courselist WHERE cid=$course";
        $dr = mysqli_query($con, $ds);
        $dv = mysqli_fetch_assoc($dr);

        $datatable = 'marks';
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <div class="d-flex justify-content-end">
                    <form method='post'>
                        <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                        <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                        <input type="hidden" name="course" value="<?php echo $course ?>">
                        <button type="submit" class="btn btn-success btn-block " name="COmoredetails">more details</button>
                    </form>
                </div>
                <div class="d-flex justify-content-end">


                    <!--<a target="_blank" href="generatePDF.php?id=<?= $row['id'] ?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
                -->


                </div>

                <h3 style="text-align: center;">Course Outcome</h3>
                <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode'] ?></h5>
                <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>
                <table class="table table-striped table-bordered" style="text-align: center;">
                    <tr>
                        <td>
                            <h5>Roll</h5>

                        </td>
                        <td>
                            <h5>CO performance (%)</h5>
                        </td>
                    </tr>

                    <?php
                    $totalper = 0;
                    for ($i = $rollStart; $i <= $rollEnd; $i++) {
                        echo "<tr>";
                        echo "<td>$i</td>";

                        $s = "select sum(mark) as mark from co where cid='$course' && roll='$i' ";
                        $result = mysqli_query($con, $s);
                        $dvv = mysqli_fetch_assoc($result);
                        $mark = $dvv['mark'];
                        $s = "select sum(fullmark) as mark from co where cid='$course' && roll='$i' ";
                        $result = mysqli_query($con, $s);
                        $dvv = mysqli_fetch_assoc($result);
                        $fullmark = $dvv['mark'];
                        if ($fullmark == 0) {
                            $per = '0';
                        } else {
                            $per = ($mark * 100) / $fullmark;
                        }
                        $totalper += $per;

                        $per = round($per, 2);






                    ?>


                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $per ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per ?>%">
                                </div>
                            </div>
                            <?php echo "<td>$per%</td>"; ?>
                        </td>


                        </tr>
                    <?php



                    }




                    ?>
                </table>
                <div class="list">
                    <?php $totalper = round($totalper, 2);
                    $totalper /= ($rollEnd - $rollStart + 1);
                    $totalper = round($totalper, 2);

                    ?>
                    <h3>Avg. performance of all is <?php echo $totalper ?>%</h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalper ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $totalper ?>%">
                        </div>
                    </div>

                </div>

            </div>





         </div><?php







    }


    if (isset($_POST["COmoredetails"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];

                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);

                $datatable = 'marks';
                ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <div class="d-flex justify-content-end">

                </div>
                <div class="d-flex justify-content-end">


                    <!--<a target="_blank" href="generatePDF.php?id=<?= $row['id'] ?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
                        -->


                </div>

                <h3 style="text-align: center;">Course Outcome</h3>
                <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode'] ?></h5>
                <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>

                <table class="table table-striped table-bordered" style="text-align: center;">
                    <tr>
                        <td>
                            <h5>Roll</h5>

                        </td>
                        <td>
                            <h5>CO performance %</h5>
                        </td>
                        <td>
                            <h5>CO-1</h5>
                        </td>
                        <td>
                            <h5>CO-2</h5>
                        </td>
                        <td>
                            <h5>CO-3</h5>
                        </td>
                        <td>
                            <h5>CO-4</h5>
                        </td>
                        <td>
                            <h5>CO-5</h5>
                        </td>
                    </tr>

                    <?php
                    $totalper = 0;


                    $totalco[1] = 0;
                    $totalco[2] = 0;
                    $totalco[3] = 0;
                    $totalco[4] = 0;
                    $totalco[5] = 0;
                    for ($i = $rollStart; $i <= $rollEnd; $i++) {
                        echo "<tr>";
                        echo "<td>$i</td>";

                        $s = "select sum(mark) as mark from co where cid='$course' && roll='$i' ";
                        $result = mysqli_query($con, $s);
                        $dvv = mysqli_fetch_assoc($result);
                        $mark = $dvv['mark'];
                        $s = "select sum(fullmark) as mark from co where cid='$course' && roll='$i' ";
                        $result = mysqli_query($con, $s);
                        $dvv = mysqli_fetch_assoc($result);
                        $fullmark = $dvv['mark'];
                        if ($fullmark == 0) {
                            $per = '0';
                        } else {
                            $per = ($mark * 100) / $fullmark;
                        }
                        $totalper += $per;

                        $per = round($per, 2);


                    ?>


                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $per ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per ?>%">
                                </div>
                            </div>
                            <?php echo "$per%"; ?>
                        </td>
                        <?php




                        for ($j = 1; $j <= 5; $j++) {
                            $xyz = "CO" . $j;
                            $s = "select sum(mark) as mark from co where cono='$xyz' && cid='$course' && roll='$i' ";
                            $result = mysqli_query($con, $s);
                            $dvv = mysqli_fetch_assoc($result);
                            $mark = $dvv['mark'];

                            $s = "select sum(fullmark) as mark from co where cono='$xyz' && cid='$course' && roll='$i' ";
                            $result = mysqli_query($con, $s);
                            $dvv = mysqli_fetch_assoc($result);
                            $fullmark = $dvv['mark'];
                            if ($fullmark == 0) {
                                $perr = '0';
                            } else {
                                $perr = ($mark * 100) / $fullmark;
                            }


                            $perr = round($perr, 2);
                            $totalco[$j] += $perr;

                        ?>


                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $perr ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perr ?>%">
                                    </div>
                                </div>
                                <?php echo "$perr%"; ?>
                            </td>
                        <?php

                        }



                        ?>
                        </tr>
                    <?php



                    }




                    ?>
                </table>
                <div class="list">
                    <?php $totalper = round($totalper, 2);
                    $totalper /= ($rollEnd - $rollStart + 1);
                    $totalper = round($totalper, 2);

                    ?>
                    <h3>Total Avg. performance of all is <?php echo $totalper ?>%</h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalper ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $totalper ?>%">
                        </div>
                    </div>

                </div>

                <div class="list">
                    <h3>Avg. performance of </h3>
                    <table class="table table-striped table-bordered" style="text-align: center;">

                        <?php

                        for ($j = 1; $j <= 5; $j++) {
                            $totalco[$j] = round($totalco[$j], 2);
                            $totalco[$j] /= ($rollEnd - $rollStart + 1);
                            $totalco[$j] = round($totalco[$j], 2);

                        ?>
                            <tr>
                                <td>CO<?php echo $j ?></td>
                                <td><?php echo $totalco[$j] ?>%
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $totalco[$j] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $totalco[$j] ?>%">
                                        </div>
                                    </div>
                                </td>

                            </tr>

                        <?php


                        }

                        ?>
                    </table>


                </div>

            </div>





        </div><?php






    }










    //______________lab mark_____________
    if (isset($_POST["addlabmark"])) 
    {

                echo '<script type="text/javascript">myFunction();</script>';


                global $id, $con;


                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Lab'";


                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

                ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3 style="text-align: center;"> Add Lab marks </h3>
                    <form method='post'>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Lab'";

                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>

                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-end">

                            <button type="submit" class="btn btn-success" name="getLabmark">NEXT</button>

                        </div>
                    </form>

                </div>
            </div>
        <?php


                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php

                }
    }












    if (isset($_POST["getLabmark"])) 
    {

                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];

                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);



        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <div class="list">
                    <div class="container">
                        <h4>
                            <p> <u> Lab mark </u> </p>
                        </h4>

                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Code </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['ccode'] ?> </p>
                                </h5>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Name </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['cname'] ?> </p>
                                </h5>

                            </div>
                        </div>
                    </div>
                </div>




                <form method='post'>
                    <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                    <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                    <input type="hidden" name="course" value="<?php echo $course ?>">


                    <table class="table table-striped table-bordered" style="max-width: 500px;">
                        <tr>
                            <td>Roll</td>
                            <td>Attandance Mark(8%)</td>
                            <td>Quiz(20%)</td>
                            <td>Performance/Report(47%)</td>
                            <td>Viva(25%)</td>
                        </tr>

                        <?php
                        $datatable = 'lab';
                        for ($i = $rollStart; $i <= $rollEnd; $i++) {

                            $s = "select * from $datatable where  cid='$course' && roll='$i'";
                            $result = mysqli_query($con, $s);
                            $num = mysqli_num_rows($result);

                            $quiz;
                            $perform;
                            $viva;
                            if ($num == 0) {

                                $quiz = '';
                                $perform = '';
                                $viva = '';
                            } else {
                                $var = mysqli_fetch_assoc($result);

                                $quiz = $var['quiz'];
                                $perform = $var['perform'];
                                $viva = $var['viva'];
                            }


                            $ls = "SELECT AVG(attendance.attendance)*100 as per FROM attendance WHERE attendance.roll='$i' and attendance.cid='$course';";
                            $lresult = mysqli_query($con, $ls);
                            $lvar = mysqli_fetch_assoc($lresult);

                            $Amark = 0;
                            $percentage = $lvar['per'];
                            if ($percentage >= 90) {
                                $Amark = 8;
                            } else if ($percentage >= 85) {
                                $Amark = 7;
                            } else if ($percentage >= 80) {
                                $Amark = 6;
                            } else if ($percentage >= 70) {
                                $Amark = 5;
                            } else if ($percentage >= 60) {
                                $Amark = 4;
                            }

                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $Amark ?></td>
                                <td style="text-align: center;"><input type="number" min="0" max="20" value="<?php echo  $quiz ?>" name="quiz<?php echo $i ?>"></td>
                                <td style="text-align: center;"><input type="number" min="0" max="47" value="<?php echo   $perform ?>" name="perform<?php echo $i ?>"></td>
                                <td style="text-align: center;"><input type="number" min="0" max="25" value="<?php echo  $viva ?>" name="viva<?php echo $i ?>"></td>
                            </tr>

                        <?php

                        }

                        ?>
                    </table>

                    <button type="submit" class="btn btn-success  btn-block" name="savelabmarks">Save</button>

                </form>
            </div>
        </div>

         <?php





    }
            
    
    if (isset($_POST["savelabmarks"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                global $name;
                global $con;

                $rollStart = $_POST['rollStart'];

                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];


                $datatable = "lab";

                for ($i = $rollStart; $i <= $rollEnd; $i++) {

                    $xquiz = $_POST['quiz' . $i];
                    $xperform = $_POST['perform' . $i];
                    $xviva = $_POST['viva' . $i];


                    $s = "select * from $datatable where  cid='$course' && roll='$i' ";
                    $result = mysqli_query($con, $s);
                    $num = mysqli_num_rows($result);

                    if ($num == 0) {
                        $query = "INSERT INTO $datatable VALUES('$i','$course','$xquiz','$xperform','$xviva') ";

                        mysqli_query($con, $query);
                    } else {
                        $var = mysqli_fetch_assoc($result);
                        $query = "UPDATE $datatable  SET quiz='$xquiz',perform='$xperform',viva='$xviva' WHERE roll=$i and cid=$course";

                        mysqli_query($con, $query);
                    }
                }
                ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Data Store successfully</h3>
            </div>
        </div>
        <?php





    }






    //______________project mark_____________
    if (isset($_POST["addprojectmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                global $id, $con;


                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Project/Thesis'";


                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

        ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3 style="text-align: center;"> Add Project Marks </h3>
                    <form method='post'>
                        <div class="form-group">
                            <div>
                                <label>
                                    <h5>Course Code</h5>
                                </label>
                                <select class="form-control" name="course" required>
                                    <?php
                                    global $id, $con;
                                    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Project/Thesis'";

                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);

                                    while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>


                                    <?php
                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="viewprojectmark">View marks</button>
                            </div>





                            <h5>add mark</h5>
                            <table class="table table-striped ">
                                <tr>
                                    <td>
                                        <h5>Roll</h5>
                                    </td>
                                    <td>
                                        <h5>Marks (out of 100)</h5>
                                    </td>
                                </tr>

                                <?php

                                for ($i = 0; $i < 10; $i++) {
                                    $ii = $i + 1; ?>
                                    <tr>
                                        <td>
                                            <div class="form-group">

                                                <input type="text" name="roll<?php echo $i ?>" class="form-control" value="">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                <input type="number" min="0" max="100" name="mark<?php echo $i ?>" class="form-control" value=''>

                                            </div>
                                        </td>

                                    <tr>
                                    <?php
                                } ?>
                            </table>

                            <button type="submit" class="btn btn-success btn-block" name="saveprojectmark">Save</button>

                    </form>

                </div>
            </div>
        <?php


                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php

                }
    }
            
    if (isset($_POST["saveprojectmark"])) 
    {

                global $id, $con;

                $datatable = "projectmark";

                $cid = $_POST["course"];


                for ($i = 0; $i < 10; $i++) {
                    $roll = $_POST["roll" . $i];
                    $mark = $_POST["mark" . $i];
                    if ($roll != "" && $mark != "") {
                        $s = "INSERT INTO $datatable VALUES('','$roll','$cid','$mark')";
                        mysqli_query($con, $s);
                    }
                }


        ?>

        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Data stored</h3>
            </div>
        </div>

        <?php
    }

            
    if (isset($_POST["viewprojectmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $cid = $_POST["course"];
                $datatable = "projectmark";
                $s = "select * from  $datatable where cid='$cid'";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);

                if ($num != 0) {
        ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                <h5>Roll</h5>
                            </td>
                            <td>
                                <h5>Mark</h5>
                            </td>
                        </tr>
                        <?php
                        $datatable = "projectmark";
                        $ds = "select * from  $datatable where cid='$cid'";
                        $dr = mysqli_query($con, $ds);
                        while ($num--) {
                            $dv = mysqli_fetch_assoc($dr);

                        ?>
                            <tr>
                                <td><?php echo $dv['roll'] ?></td>
                                <td><?php echo $dv['mark'] ?></td>
                            </tr>

                        <?php

                        }

                        ?>
                    </table>

                    <div class="form-group">
                        <form method='post'>
                            <input type="hidden" name="cid" value="<?php echo $cid ?>">
                            <button type="submit" class="btn btn-success  btn-block" name="editprojectmark">Edit</button>
                            <button type="submit" class="btn btn-danger btn-block " name="deleteprojectmark">Delete</button>
                        </form>
                    </div>

                </div>
            </div>

        <?php

                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>Empty</h3>

                    </div>

                </div>

            </div>

        <?php


                }
    }
            
    if (isset($_POST["editprojectmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $cid = $_POST["cid"];
                $datatable = "projectmark";
                $s = "select * from  $datatable where cid='$cid'";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);


        ?>

        <div class="d-flex justify-content-center">
            <div class="list">
                <form method='post'>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                <h5>Roll</h5>
                            </td>
                            <td>
                                <h5>Mark</h5>
                            </td>
                        </tr>
                        <?php
                        $datatable = "projectmark";
                        $ds = "select * from  $datatable where cid='$cid'";
                        $dr = mysqli_query($con, $ds);

                        while ($num--) {
                            $dv = mysqli_fetch_assoc($dr);

                        ?>
                            <tr>
                                <td><?php echo $dv['roll'] ?></td>
                                <td style="text-align: center;"><input type="number" min="0" max="100" value="<?php echo $dv['mark'] ?>" name="<?php echo $dv['roll'] ?>"></td>
                            </tr>

                        <?php

                        }

                        ?>
                    </table>

                    <input type="hidden" name="cid" value="<?php echo $cid ?>">
                    <button type="submit" class="btn btn-success  btn-block" name="saveeditprojectmark">Save</button>

                </form>
            </div>

        </div>
        </div>

        <?php


        ?>


        <?php


    }

            
    if (isset($_POST["saveeditprojectmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $cid = $_POST["cid"];
                $datatable = "projectmark";
                $s = "select * from  $datatable where cid=$cid";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);


                while ($num--) {
                    $dv = mysqli_fetch_assoc($result);
                    $roll = $dv['roll'];
                    $mark = $_POST[$roll];
                    //echo $roll;
                    //echo $mark;
                    $ds = "update $datatable set mark=$mark where roll=$roll and cid=$cid";
                    $dr = mysqli_query($con, $ds);
                }











                global $id, $con;
                $datatable = "projectmark";
                $s = "select * from  $datatable where cid='$cid'";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);

                if ($num != 0) {
        ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                <h5>Roll</h5>
                            </td>
                            <td>
                                <h5>Mark</h5>
                            </td>
                        </tr>
                        <?php
                        $datatable = "projectmark";
                        $ds = "select * from  $datatable where cid='$cid'";
                        $dr = mysqli_query($con, $ds);
                        while ($num--) {
                            $dv = mysqli_fetch_assoc($dr);

                        ?>
                            <tr>
                                <td><?php echo $dv['roll'] ?></td>
                                <td><?php echo $dv['mark'] ?></td>
                            </tr>

                        <?php

                        }

                        ?>
                    </table>

                    <div class="form-group">
                        <form method='post'>
                            <input type="hidden" name="cid" value="<?php echo $cid ?>">
                            <button type="submit" class="btn btn-success  btn-block" name="editprojectmark">Edit</button>
                            <button type="submit" class="btn btn-danger btn-block " name="deleteprojectmark">Delete</button>
                        </form>
                    </div>

                </div>
            </div>

        <?php

                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>Empty</h3>

                    </div>

                </div>

            </div>

        <?php


                }
            
    }



    if (isset($_POST["deleteprojectmark"])) 
    {

                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $cid = $_POST["cid"];
                $datatable = "projectmark";
                $s = "select * from  $datatable where cid='$cid'";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);


        ?>
        <form method='post'>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                <h5>Roll</h5>
                            </td>
                            <td>
                                <h5>Mark</h5>
                            </td>
                            <td>
                                <h5>Select For Delete</h5>
                            </td>
                        </tr>

                        <?php
                        $datatable = "projectmark";
                        $ds = "select * from  $datatable where cid='$cid'";
                        $dr = mysqli_query($con, $ds);
                        while ($num--) {
                            $dv = mysqli_fetch_assoc($dr);
                        ?>
                            <tr>
                                <td><?php echo $dv['roll'] ?></td>
                                <td><?php echo $dv['mark'] ?></td>
                                <div class="checkbox ">
                                    <td style="text-align: center;"><input type="checkbox" class="largerCheckbox" value="<?php echo $dv['id'] ?>" name="projectids[]"></td>
                                </div>
                            </tr>
                        <?php

                        }

                        ?>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block " name="donedeleteprojectmark">Delete</button>
        </form>
        </div>
        </div>
        </div>

    <?php
    }
            
    if (isset($_POST["donedeleteprojectmark"])) 
    {

                echo '<script type="text/javascript">myFunction();</script>';

                $ids = $_POST['projectids'];


                if (empty($ids)) {
                    goto kkkk;
                }


                global $id, $con;
                $datatable = "projectmark";
                foreach ($ids as $c) {
                    $s = "DELETE FROM $datatable where id=$c ";
                    mysqli_query($con, $s);
                }

                kkkk:
                ?>

        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Delete successfully</h3>
            </div>
        </div>


        <?php

    }





    //______________final marks_____________

    if (isset($_POST["finalmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';


                global $id, $con;


                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory'";


                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

        ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3 style="text-align: center;"> Add final marks </h3>
                    <form method='post'>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory'";

                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>


                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end">

                            <button type="submit" class="btn btn-success" name="getfinalmark">NEXT</button>

                        </div>
                    </form>

                </div>
            </div>
        <?php


                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        <?php


                }
    }

            
    
    if (isset($_POST["getfinalmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];

                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);




        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <div class="list">
                    <div class="container">
                        <h4>
                            <p> <u> Semester final mark </u> </p>
                        </h4>

                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Code </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['ccode'] ?> </p>
                                </h5>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>
                                    <p> Course Name </p>
                                </h5>
                            </div>
                            <div class="col-sm-1">
                                <h5>
                                    <p>:</p>
                                </h5>
                            </div>
                            <div class="col-sm-6">
                                <h5>
                                    <p> <?php echo $dv['cname'] ?> </p>
                                </h5>

                            </div>
                        </div>
                    </div>
                </div>




                <form method='post'>
                    <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                    <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                    <input type="hidden" name="course" value="<?php echo $course ?>">



                    <table class="table table-striped table-bordered" style="max-width: 500px;">
                        <tr>
                            <td>Roll</td>
                            <td>Part-A</td>
                            <td>Part-B</td>

                        </tr>

                        <?php
                        $datatable = 'finalmark';
                        for ($i = $rollStart; $i <= $rollEnd; $i++) {

                            $s = "select * from $datatable where  cid='$course' && roll='$i' ORDER BY id DESC";
                            $result = mysqli_query($con, $s);
                            $num = mysqli_num_rows($result);

                            $valueA;
                            $valueB;
                            if ($num == 0) {
                                $valueA = '';
                                $valueB = '';
                            } else {
                                $var = mysqli_fetch_assoc($result);
                                $valueA = $var['partA'];
                                $valueB = $var['partB'];
                            }


                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td style="text-align: center;"><input type="number" min="0" max="36" value="<?php echo $valueA ?>" name="A<?php echo $i ?>"></td>
                                <td style="text-align: center;"><input type="number" min="0" max="36" value="<?php echo $valueB ?>" name="B<?php echo $i ?>"></td>

                            </tr><?php

                                }

                                    ?>



                    </table>

                    <button type="submit" class="btn btn-success  btn-block" name="savefinalmarks">Save</button>

                </form>
            </div>
        </div>
        <?php
        
    }
            
    
    
    
    if (isset($_POST["savefinalmarks"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                global $name;
                global $con;

                $rollStart = $_POST['rollStart'];

                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];


                $datatable = "finalmark";

                for ($i = $rollStart; $i <= $rollEnd; $i++) {

                    $xA = $_POST['A' . $i];
                    $xB = $_POST['B' . $i];


                    $s = "select * from $datatable where  cid='$course' && roll='$i' ORDER BY id DESC";
                    $result = mysqli_query($con, $s);
                    $num = mysqli_num_rows($result);

                    if ($num == 0) {
                        $query = "INSERT INTO $datatable VALUES('','$i','$course','$xA','$xB','$name') ";

                        mysqli_query($con, $query);
                    } else {
                        $var = mysqli_fetch_assoc($result);
                        $newID = $var['id'];

                        $query = "UPDATE $datatable  SET partA='$xA',partB='$xB',teacher='$name' WHERE id=$newID";

                        mysqli_query($con, $query);
                    }
                }
            ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>Data Store successfully</h3>
            </div>
        </div>
        <?php
        
    }




    //______________view attendance sheet_____________
            
    if (isset($_POST["viewAttendance"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                global $id, $con;

                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab')";

                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

        ?>


            <div class="d-flex justify-content-center">
                <div class="list">
                    <h2> Attendance Sheet </h2>
                    <form method='post'>
                        <div>
                            <label>Course Code</label>
                            <select name="course" class="form-control" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory','Lab') ";

                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);


                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="showAttendance">NEXT</button>

                        </div>
                    </form>
                </div>
            </div>


        <?php



                } else {
        ?>

            <div class="d-flex justify-content-center">

                <div class='list'>
                    <div class="minibox">
                        <h3>No Course are available</h3>

                    </div>
                    <div class="minibox">
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <?php

                }
    }

            
    if (isset($_POST["showAttendance"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];

                global $id, $con;
                $datatable = "attendance";


                $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday'];


                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);




            ?><?php

                ?>

            <div class="outer-wrapper">
                <div class="d-flex justify-content-end">
                    <a target="_blank" href="generatePDF.php?id=<?= $row['id'] ?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
                </div>
                <div class="minibox">
                    <h3 style="text-align: center;">Attendance Sheet</h3>
                    <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode'] ?></h5>
                    <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>




                    <div class="table-wrapper">
                        <table class="table table-striped table-bordered" style="margin: 10px;">
                            <tr>
                                <td>
                                    <h5>Roll</h5>
                                </td>
                                <?php
                                for ($j = 1; $j <= 15; $j++) {
                                    foreach ($days as $k) {
                                        $s10 = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll>='$rollStart' && roll<='$rollEnd'";
                                        $result10 = mysqli_query($con, $s10);
                                        $num10 = mysqli_num_rows($result10);

                                        if ($num10 != 0) {
                                            echo "<td ><h5>$j $k[0]$k[1]$k[2]</h5></td>";
                                        }
                                    }
                                }
                                ?>

                                <td>
                                    <h5>Present</h5>
                                </td>
                                <td>
                                    <h5>Percentage</h5>
                                </td>
                            </tr>

                            <?php
                            for ($i = $rollStart; $i <= $rollEnd; $i++) {
                                echo "<tr>";
                                echo "<td><h5>$i</h5></td>";

                                $total = 0;
                                $prsnt = 0;

                                for ($j = 1; $j <= 15; $j++) {
                                    $zz = 0;
                                    foreach ($days as $k) {
                                        $s10 = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll>='$rollStart' && roll<='$rollEnd'";
                                        $result10 = mysqli_query($con, $s10);
                                        $num10 = mysqli_num_rows($result10);

                                        if ($num10 != 0) {

                                            $s = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll='$i'  ORDER BY id DESC";
                                            $result = mysqli_query($con, $s);
                                            $num = mysqli_num_rows($result);
                                            $ans = 0;

                                            $total++;
                                            if ($num == 0) {
                                                echo "<td></td>";
                                                continue;
                                            }


                                            $var = mysqli_fetch_assoc($result);
                                            $ans = $var['attendance'];
                                            $tcrName = $var['teacher'];


                                            if ($ans == 1) {
                                                $prsnt++;
                                            }
                                            echo "<td title='$tcrName'>$ans</td>";
                                        }
                                    }
                                }
                                //echo "<td>$total</td>";
                                echo "<td>$prsnt</td>";
                                if ($total == 0) {
                                    $percentage = 0;
                                } else {
                                    $percentage = round(($prsnt / $total) * 100, 2);
                                }
                                echo "<td>$percentage%</td>";
                                echo "</tr>";


                                $_SESSION['rollStart'] = $rollStart;
                                $_SESSION['rollEnd '] = $rollEnd;
                                $_SESSION['course'] = $course;
                                $_SESSION['pdf'] = 'tcr_attendance.php';
                            }

                            ?>
                        </table>


                    </div>
                </div>

            </div>
            <?php
    }


//____________view course_____________

    if (isset($_POST["viewCourse"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                showCourse();
    }


    //________________add course______________
    if (isset($_POST["addCourse"])) 
    {

                echo '<script type="text/javascript">myFunction();</script>';


                global $id, $con, $datatablelogin;
                $datatable = "courselist";

                $ds = "SELECT * FROM student WHERE student.id=$id";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);
                $deptid = $dv['deptid'];

                $s = "select * from $datatable where  deptid=$deptid and cid not in( select cid from course where personID=$id ) order by year,semester desc";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);


                if ($num != 0) {
            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <form method='post'>

                            <table class="table table-striped table-bordered" ">
                                <tr>
                                    <td>Course code</td>
                                    <td>Course Name</td>
                                    <td>Type</td>
                                    <td>Year</td>
                                    <td>Semester</td>
                                    <td>select for add</td>
                                </tr>
                        
                        <?php
                        while ($var = mysqli_fetch_assoc($result)) {
                            $cid = $var['cid'];
                            $ccccc = $cid;
                            $ds = "SELECT * From courselist WHERE cid=$ccccc";
                            $dr = mysqli_query($con, $ds);
                            $dv = mysqli_fetch_assoc($dr);
                        ?>
                
                                <tr>
                                    <td>
                                        <?php echo $dv['ccode']; ?>
                                    </td>
                                    <td>
                                    <?php echo $dv['cname']; ?>
                                    </td>
                                    <td>
                                    <?php echo $dv['type']; ?>
                                    </td>
                                    <td>
                                    <?php echo $dv['year']; ?>
                                    </td>
                                    <td>
                                    <?php echo $dv['semester']; ?>
                                    </td>

                                    <div class=" checkbox "  ><td style=" text-align: center;"><input type="checkbox" class="largerCheckbox" value="<?php echo $cid ?>" name="courses[]"></td>
                    </div>
                    </tr>

                <?php

                        }

                ?>
                </table>
                <button type="submit" class="btn btn-success btn-block" name="courseAddDone">Add</button>


                </form>
                </div>
                </div>

            <?php

                } else {
            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <h3>No Course are available</h3>
                    </div>
                </div>
            <?php
                }
    }


    if (isset($_POST["courseAddDone"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $courses = $_POST['courses'];


                if (empty($courses)) {
                    goto kk;
                }


                global $id, $con;
                $datatable = "course";

                foreach ($courses as $c) {
                    $s = "INSERT INTO $datatable VALUES('','$id','$c','$type')";
                    mysqli_query($con, $s);
                }

                kk:

            ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3>Add successfully</h3>
                </div>
            </div>


            <?php

                showCourse();
    }





    function showCourse()
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $datatable = "course";
                $s = "select distinct(courselist.cid) from course,courselist where courselist.cid=course.cid and   personID = $id  order by year,semester desc";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);

                if ($num != 0) {
            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>
                                    <h5>Course Code</h5>
                                </td>
                                <td>
                                    <h5>Course Name</h5>
                                </td>
                                <td>
                                    <h5>Type</h5>
                                </td>
                                <td>
                                    <h5>Year</h5>
                                </td>
                                <td>
                                    <h5>Semester</h5>
                                </td>
                                <td colspan="10000000">
                                    <h5>Other Teacher<br>Name</h5>
                                </td>
                            </tr>
                            <?php

                            while ($var = mysqli_fetch_assoc($result)) {

                                $ccccc = $var['cid'];
                                $ds = "SELECT * From courselist WHERE cid=$ccccc";
                                $dr = mysqli_query($con, $ds);
                                $dv = mysqli_fetch_assoc($dr);

                            ?>
                                <tr>
                                    <td><?php echo $dv['ccode'] ?></td>
                                    <td><?php echo $dv['cname'] ?></td>
                                    <td><?php echo $dv['type'] ?></td>
                                    <td><?php echo $dv['year'] ?></td>
                                    <td><?php echo $dv['semester'] ?></td>
                                    <?php

                                    global $datatablelogin;
                                    $c = $var['cid'];
                                    $s = "select * from $datatable where type='Teacher' && cid='$c' && personID<>$id ";
                                    $r = mysqli_query($con, $s);
                                    ?><?php
                                        while ($v = mysqli_fetch_assoc($r)) {
                                            $newid = $v['personID'];
                                            $q = "select * from $datatablelogin WHERE id=$newid ";
                                            $k = mysqli_query($con, $q);
                                            $d = mysqli_fetch_assoc($k);
                                            $tcrName = $d['name'];
                                            echo "<td>" . $tcrName . "</td>";
                                        }
                                        ?><?php


                                            ?>
                                </tr>

                            <?php


                            }

                            ?>
                        </table>


                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                            </form>
                        </div>
                        <div class="form-group">
                            <form method='post'>
                                <button type="submit" class="btn btn-danger btn-block " name="deleteCourse">Delete Course</button>
                            </form>
                        </div>



                    </div>
                </div>

            <?php

                } else {
            ?>

                <div class="d-flex justify-content-center">

                    <div class='list'>
                        <div class="minibox">
                            <h3>No Course are available</h3>

                        </div>
                        <div class="minibox">
                            <div class="form-group">
                                <form method='post'>
                                    <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            <?php


                }
    }

    //__________delete course_____________

            
    if (isset($_POST["deleteCourse"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';


                global $id, $con;
                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.type, courselist.cname , courselist.year, courselist.semester FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id order by year,semester desc";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);


                if ($num != 0) {
            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <form method='post'>

                            <table class="table table-striped table-bordered" ">
                    <tr>
                        <td>Course Code </td>
                        <td>Course Name </td>
                        <td>Type </td>
                        <td>Year </td>
                        <td>Semester </td>
                        <td>Select for Delete</td>
                    </tr>
            
            <?php
                    while ($var = mysqli_fetch_assoc($result)) {
                        $cid = $var['cid'];
            ?>
    
                    <tr>
                        <td><?php echo $var['ccode'] ?></td>
                        <td><?php echo $var['cname'] ?></td>
                        <td><?php echo $var['type'] ?></td>
                        <td><?php echo $var['year'] ?></td>
                        <td><?php echo $var['semester'] ?></td>
                        <div class=" checkbox">
                                <td style="text-align: center;"><input type="checkbox" class="largerCheckbox" value="<?php echo $cid ?>" name="courses[]"></td>
                    </div>
                    </tr>

                <?php

                    }

                ?>
                </table>
                <button type="submit" class="btn btn-danger btn-block" name="courseDeleteDone">Delete</button>


                </form>
                </div>
                </div>

            <?php

                } else {
            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <h3>No Course are available</h3>
                    </div>
                </div>
            <?php
                }
            
            
    }


    if (isset($_POST["courseDeleteDone"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $courses = $_POST['courses'];


                if (empty($courses)) {
                    goto k;
                }


                global $id, $con;
                $datatable = "course";

                foreach ($courses as $c) {
                    $s = "DELETE FROM $datatable where  personID = '$id' && cid='$c' ";
                    mysqli_query($con, $s);
                }

                k:

            ?>

            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3>Delete successfully</h3>
                </div>
            </div>


            <?php

                showCourse();
    }









    //_____________input attendance___________________

    if (isset($_POST["attendance"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                global $id, $con;
                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id  and courselist.type in('Lab','Theory') ";

                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

                    showAttendanceform();
                } else {
            ?>

                <div class="d-flex justify-content-center">

                    <div class='list'>
                        <div class="minibox">
                            <h3>No Course are available</h3>

                        </div>
                        <div class="minibox">
                            <div class="form-group">
                                <form method='post'>
                                    <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            <?php


                }
    }


    function showAttendanceform()        
    {
                echo '<script type="text/javascript">myFunction();</script>';
            ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <h2> take Attendance </h2>
                    <form method='post'>
                        <div>
                            <label>Course Code</label>
                            <select class="form-control" name="course" required>
                                <?php
                                global $id, $con;
                                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Lab','Theory') ";
                                $result = mysqli_query($con, $s);

                                while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Roll range</label>
                            <input type="text" name="rollStart" class="form-control" required>
                            <br>
                            <input type="text" name="rollEnd" class="form-control" required>
                        </div>

                        <div>
                            <label>Cycle</label>
                            <select name="cycle" class="form-control">
                                <?php
                                for ($i = 1; $i <= 15; $i++) {
                                    echo "<option value='$i' >  $i  </option>";
                                }
                                ?>
                            </select>

                        </div>

                        <div>
                            <label>Day</label>
                            <select name="day" class="form-control">
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                            </select>

                        </div>
                        <br>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success" name="takeAttendance">NEXT</button>
                        </div>

                    </form>
                </div>
            </div>


        <?php

    }



            
    if (isset($_POST["takeAttendance"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $cycle = $_POST['cycle'];
                $day = $_POST['day'];
                $course = $_POST['course'];


                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);

        ?>
            <div class="d-flex justify-content-center">
                <div class="list">


                    <div class="list">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Course Code </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $dv['ccode'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Course Name </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $dv['cname'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Cycle </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $cycle ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Day </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $day ?> </p>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>





                    <form method='post'>
                        <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                        <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                        <input type="hidden" name="cycle" value="<?php echo $cycle ?>">
                        <input type="hidden" name="day" value="<?php echo $day ?>">
                        <input type="hidden" name="course" value="<?php echo $course ?>">





                        <table class="table table-striped table-bordered">

                            <tr>

                                <td></td>
                                <td>
                                    <input class="btn btn-success btn-block" id='selectall' onclick='selects()' type="button" value="Select All" />

                                    <input class="btn btn-success  btn-block  unselectall " id='unselectall' onclick='deSelect()' type="button" value="UnSelect All" />
                                </td>


                            </tr>
                            <tr>
                                <td>
                                    <h5>Roll</h5>
                                </td>
                                <td>
                                    <h5>Attendance Status</h5>
                                </td>
                            </tr>

                            <?php

                            $datatable = "attendance";
                            for ($i = $rollStart; $i <= $rollEnd; $i++) {
                                $click = "";


                                $s = "select * from $datatable where day='$day' && cycle='$cycle' && cid='$course' && roll='$i'  ORDER BY id DESC";
                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);
                                $ans = 0;


                                if ($num != 0) {
                                    $var = mysqli_fetch_assoc($result);
                                    $ans = $var['attendance'];
                                }

                                if ($ans == 1) {
                                    $click = 'checked';
                                }
                            ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" class="largerCheckbox" <?php echo $click ?> value="<?php echo $i ?>" name="attendanceStatus[]">

                                    </td>

                                </tr>

                            <?php

                            }


                            ?>
                        </table>
                        <button type="submit" class="btn btn-success  btn-block" name="takeAttendanceDone">DONE</button>




                    </form>
                </div>
            </div>

        <?php





    }

            
    
    if (isset($_POST["takeAttendanceDone"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $cycle = $_POST['cycle'];
                $day = $_POST['day'];
                $course = $_POST['course'];
                $rolls = $_POST['attendanceStatus'];

                $attendance = array($rollEnd - $rollStart + 1);
                for ($i = $rollStart; $i <= $rollEnd; $i++) {
                    $attendance[$i - $rollStart] = 0;
                }


                foreach ($rolls as $roll) {
                    $attendance[$roll - $rollStart] = 1;
                }

                global $con, $name;
                $datatable = "attendance";

                for ($i = $rollStart; $i <= $rollEnd; $i++) {

                    $s = "select * from $datatable where day='$day' && cycle='$cycle' && cid='$course' && roll='$i'  ORDER BY id DESC";
                    $result = mysqli_query($con, $s);
                    $num = mysqli_num_rows($result);

                    $status = $attendance[$i - $rollStart];
                    if ($num == 0) {
                        $s = "INSERT INTO $datatable VALUES('','$i','$course','$cycle','$day','$status','$name')";
                        mysqli_query($con, $s);
                    } else {
                        $var = mysqli_fetch_assoc($result);
                        $newID = $var['id'];

                        $s = "UPDATE $datatable SET attendance=$status , teacher='$name' WHERE id=$newID  ";
                        mysqli_query($con, $s);
                    }
                }

        ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3>Data Store successfully</h3>
                </div>
            </div>
            <?php

    }



    //_____ input ct marks_______________
            
    if (isset($_POST["ctmark"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id  and courselist.type ='Theory' ";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <form method='post'>
                            <h2> Input CT Marks </h2>
                            <div>
                                <label>Course Code</label>
                                <select class="form-control" name="course" required>
                                    <?php
                                    global $id, $con;
                                    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type in('Theory')";
                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);

                                    while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Roll range</label>
                                <input type="text" name="rollStart" class="form-control" required>
                                <br>
                                <input type="text" name="rollEnd" class="form-control" required>
                            </div>


                            <div>
                                <label>Class-Test No.</label>
                                <select class="form-control" name="ctno">
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) {
                                        echo "<option value='$i' >  $i  </option>";
                                    }
                                    ?>
                                </select>

                            </div>



                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="showCTmarkForm">NEXT</button>

                            </div>
                        </form>
                    </div>
                </div>


            <?php


                } else {
            ?>

                <div class="d-flex justify-content-center">

                    <div class='list'>
                        <div class="minibox">
                            <h3>No Course are available</h3>

                        </div>
                        <div class="minibox">
                            <div class="form-group">
                                <form method='post'>
                                    <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            <?php

                }
            
    }

            
    if (isset($_POST["showCTmarkForm"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];
                $ctno = $_POST['ctno'];






                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);



            ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <div class="list">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Course Code </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $dv['ccode'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Course Name </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $dv['cname'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>
                                        <p> Class Test no. </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5>
                                        <p> <?php echo $ctno ?> </p>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-center">
                        <form method='post'>
                            <input type="hidden" name="rollStart" value="<?php echo $rollStart ?>">
                            <input type="hidden" name="rollEnd" value="<?php echo $rollEnd ?>">
                            <input type="hidden" name="course" value="<?php echo $course ?>">
                            <input type="hidden" name="ctno" value="<?php echo $ctno ?>">

                            <?php


                            ?>



                            <table class="table table-striped table-bordered" style="max-width: 500px;">
                                <tr>
                                    <td>
                                        <h5>student Roll</h5>
                                    </td>
                                    <td>
                                        <h5>Class-Test Marks <br>(20)</h5>
                                    </td>

                                </tr>

                                <?php
                                $datatable = 'marks';
                                for ($i = $rollStart; $i <= $rollEnd; $i++) {

                                    $s = "select * from $datatable where ctNo='$ctno' && cid='$course' && roll='$i' ORDER BY id DESC";
                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);

                                    $value;
                                    if ($num == 0) {
                                        $value = '';
                                    } else {
                                        $var = mysqli_fetch_assoc($result);
                                        $value = $var['marks'];
                                    }


                                ?>

                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td style="text-align: center;"><input type="number" min="0" max="20" value="<?php echo $value ?>" name="<?php echo $i ?>"></td>


                                        <?php



                                        ?>
                                    </tr><?php


                                        }

                                            ?>
                            </table>

                            <button type="submit" class="btn btn-success  btn-block" name="takeCTmarksDone">DONE</button>

                        </form>
                    </div>
                </div>
            </div>

        <?php


    }


            
    if (isset($_POST["takeCTmarksDone"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $name;
                global $con;

                $rollStart = $_POST['rollStart'];

                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];
                $ctno = $_POST['ctno'];





                $datatable = "marks";

                for ($i = $rollStart; $i <= $rollEnd; $i++) {

                    $x = $_POST[$i];
                    if ($x == "") {
                        $x = 'A';
                    }

                    $s = "select * from $datatable where ctNo='$ctno' && cid='$course' && roll='$i' ORDER BY id DESC";
                    $result = mysqli_query($con, $s);
                    $num = mysqli_num_rows($result);

                    if ($num == 0) {
                        $query = "INSERT INTO $datatable VALUES('','$i','$course','$ctno','$x','$name') ";

                        mysqli_query($con, $query);
                    } else {
                        $var = mysqli_fetch_assoc($result);
                        $newID = $var['id'];

                        $query = "UPDATE $datatable  SET marks='$x',teacher='$name' WHERE id=$newID";

                        mysqli_query($con, $query);
                    }
                }


        ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <h3>Data Store successfully</h3>
                </div>
            </div>
            <?php



    }


            
    //_________ view ct marks__________

            
    if (isset($_POST["viewCTmarks"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';
                global $id, $con;
                $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory' ";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num != 0) {

            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <h2> View CT marks sheet </h2>
                        <form method='post'>
                            <div>
                                <label>Course Code</label>
                                <select class="form-control" name="course" required>
                                    <?php
                                    global $id, $con;

                                    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory'";

                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);

                                    if ($num == 0) {
                                        echo "<script>alert('please add Course')</script>";
                                    }


                                    while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>
                                    <?php
                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Roll range</label>
                                <input type="text" name="rollStart" class="form-control" required>
                                <br>
                                <input type="text" name="rollEnd" class="form-control" required>
                            </div>


                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" name="showCTmarks">NEXT</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php


                } else {
            ?>

                <div class="d-flex justify-content-center">

                    <div class='list'>
                        <div class="minibox">
                            <h3>No Course are available</h3>

                        </div>
                        <div class="minibox">
                            <div class="form-group">
                                <form method='post'>
                                    <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            <?php

                }
            
    }

            
    if (isset($_POST["showCTmarks"])) 
    {
                echo '<script type="text/javascript">myFunction();</script>';

                $rollStart = $_POST['rollStart'];
                $rollEnd = $_POST['rollEnd'];
                $course = $_POST['course'];

                $ds = "SELECT * From courselist WHERE cid=$course";
                $dr = mysqli_query($con, $ds);
                $dv = mysqli_fetch_assoc($dr);

                $datatable = 'marks';
            ?>
            <div class="d-flex justify-content-center">
                <div class="list">
                    <div class="d-flex justify-content-end">
                        <a target="_blank" href="generatePDF.php?id=<?= $row['id'] ?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
                    </div>

                    <h3 style="text-align: center;">CT mark</h3>
                    <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode'] ?></h5>
                    <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>

                    <table class="table table-striped table-bordered" style="text-align: center;">
                        <tr>
                            <td>
                                <h5>Roll</h5>
                            </td>
                            <?php
                            for ($j = 1; $j <= 4; $j++) {

                                echo "<td ><h5>CT-$j </h5></td>";
                            }
                            ?>
                            <td>
                                <h5>best of three avg.</h5>
                            </td>
                        </tr>

                        <?php
                        for ($i = $rollStart; $i <= $rollEnd; $i++) {
                            echo "<tr>";
                            echo "<td>$i</td>";

                            $marksList = array(6);
                            for ($j = 0; $j <= 5; $j++) {
                                $marksList[$j] = 0;
                            }

                            for ($j = 1; $j <= 4; $j++) {
                                $ans = 0;
                                $s = "select * from $datatable where ctNo='$j' && cid='$course' && roll='$i' ORDER BY id DESC ";
                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);


                                if ($num == 0) {
                                    echo "<td></td>";
                                    continue;
                                } else {
                                    $var = mysqli_fetch_assoc($result);

                                    $ans = $var['marks'];
                                    $tcrName = $var['teacher'];
                                    echo "<td title='$tcrName'>$ans</td>";
                                    if ($ans == 'A') {
                                        $ans = 0;
                                    }
                                }

                                $marksList[$j] = $ans;
                            }


                            rsort($marksList);
                            $ans = $marksList[0] + $marksList[1] + $marksList[2];

                            $m = ceil($ans / 3);
                            echo "<td>$m</td>";
                            echo "</tr>";
                        }



                        $_SESSION['rollStart'] = $rollStart;
                        $_SESSION['rollEnd '] = $rollEnd;
                        $_SESSION['course'] = $course;
                        $_SESSION['pdf'] = 'tcr_ctmark.php';

                        ?>
                    </table>

                </div>
            </div><?php
            
        
    }



                
    //__________view all result___________
                
    if (isset($_POST["viewResult"])) 
    {
                    echo '<script type="text/javascript">myFunction();</script>';

                    global $id, $con;
                    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory' or courselist.type ='Lab' ";

                    $result = mysqli_query($con, $s);
                    $num = mysqli_num_rows($result);
                    if ($num != 0) {

                    ?>

                <div class="d-flex justify-content-center">
                    <div class="list">
                        <h3 style="text-align: center;"> view Result </h3>
                        <form method='post'>
                            <div>
                                <label>Course Code</label>
                                <select class="form-control" name="course" required>
                                    <?php
                                    global $id, $con;
                                    $s = "SELECT distinct(courselist.cid) , courselist.ccode , courselist.cname FROM courselist, course WHERE courselist.cid = course.cid and course.personID=$id and courselist.type ='Theory' or courselist.type ='Lab' ";

                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);

                                    while ($var = mysqli_fetch_assoc($result)) { ?><option value="<?php echo $var['cid'] ?>"><?php echo $var['ccode'] . '  [' . $var['cname'] . ']' ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Roll range</label>
                                <input type="text" name="rollStart" class="form-control" required>
                                <br>
                                <input type="text" name="rollEnd" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-end">

                                <button type="submit" class="btn btn-success" name="showResultSheet">NEXT</button>

                            </div>
                        </form>

                    </div>
                </div>
            <?php


                    } else {
            ?>

                <div class="d-flex justify-content-center">

                    <div class='list'>
                        <div class="minibox">
                            <h3>No Course are available</h3>

                        </div>
                        <div class="minibox">
                            <div class="form-group">
                                <form method='post'>
                                    <button type="submit" class="btn btn-success btn-block " name="addCourse">Add Course</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            <?php


                    }
    }

                
    if (isset($_POST["showResultSheet"])) 
    {
                    echo '<script type="text/javascript">myFunction();</script>';

                    $cid = $_POST['course'];
                    $ds = "SELECT * From courselist WHERE cid=$cid";
                    $dr = mysqli_query($con, $ds);
                    $dv = mysqli_fetch_assoc($dr);




                    if ($dv['type'] == 'Theory') {

                        $rollStart = $_POST['rollStart'];
                        $rollEnd = $_POST['rollEnd'];
                        $course = $_POST['course'];

                        $datatableMarks = 'marks';
                        $datatableAttendance = "attendance";

                        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday'];

                        $ds = "SELECT * From courselist WHERE cid=$course";
                        $dr = mysqli_query($con, $ds);
                        $dv = mysqli_fetch_assoc($dr);




            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <div class="d-flex justify-content-end">
                            <a target="_blank" href="generatePDF.php?id=<?= $row['id'] ?>" class="btn  btn-success"> <i class="fa fa-file-pdf-o"></i>Print</a>
                        </div>




                        <div class="container">
                            <h3 style="text-align: center;">
                                <p> <u> Result Sheet </u> </p>
                            </h3>

                            <div class="row">
                                <div class="col-sm-5">
                                    <h5 style="text-align: right;">
                                        <p> Course Code </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 style="text-align: left;">
                                        <p> <?php echo $dv['ccode'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5 style="text-align: right;">
                                        <p> Course Name </p>
                                    </h5>
                                </div>
                                <div class="col-sm-1">
                                    <h5>
                                        <p>:</p>
                                    </h5>
                                </div>
                                <div class="col-sm-6">
                                    <h5 style="text-align: left;">
                                        <p> <?php echo $dv['cname'] ?> </p>
                                    </h5>

                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered ">
                            <tr>
                                <td>
                                    <h5>Roll</h5>
                                </td>
                                <td>
                                    <h5>Percentage<br> of <br>Attendance</h5>
                                </td>
                                <td>
                                    <h5>Attendance<br> Marks</h5>
                                </td>
                                <td>
                                    <h5>CT<br> Marks</h5>
                                </td>
                                <td>
                                    <h5>Final<br> mark <br>[ Part-A ]</h5>
                                </td>
                                <td>
                                    <h5>Final<br> mark <br>[ Part-B ]</h5>
                                </td>
                                <td>
                                    <h5>Total <br>Marks</h5>
                                </td>
                                <td>
                                    <h5>Grade</h5>
                                </td>
                                <td>
                                    <h5>Grade<br> Point</h5>
                                </td>
                            </tr>

                            <?php
                            for ($i = $rollStart; $i <= $rollEnd; $i++) {
                                echo "<tr>";
                                echo "<td><h6>$i</h6></td>";

                                $total = 0;
                                $prsnt = 0;

                                for ($j = 1; $j <= 15; $j++) {
                                    foreach ($days as $k) {
                                        $s = "select * from $datatableAttendance where day='$k' && cycle='$j' && cid='$course' && roll='$i'  ORDER BY id DESC";
                                        $result = mysqli_query($con, $s);
                                        $num = mysqli_num_rows($result);
                                        $ans = 0;

                                        if ($num == 0) {
                                            continue;
                                        }
                                        $total++;

                                        $var = mysqli_fetch_assoc($result);
                                        $ans = $var['attendance'];

                                        if ($ans == 1) {
                                            $prsnt++;
                                        }
                                    }
                                }
                                if ($total == 0) {
                                    $percentage = 0;
                                } else {
                                    $percentage = round(($prsnt / $total) * 100, 2);
                                }

                                echo "<td>$percentage%</td>";

                                $Amark = 0;
                                if ($percentage >= 90) {
                                    $Amark = 8;
                                } else if ($percentage >= 85) {
                                    $Amark = 7;
                                } else if ($percentage >= 80) {
                                    $Amark = 6;
                                } else if ($percentage >= 70) {
                                    $Amark = 5;
                                } else if ($percentage >= 60) {
                                    $Amark = 4;
                                }
                                echo "<td> $Amark</td>";
                                //_________________CT MARKS_______________

                                $marksList = array(6);
                                for ($j = 0; $j <= 5; $j++) {
                                    $marksList[$j] = 0;
                                }

                                for ($j = 1; $j <= 5; $j++) {
                                    $ans = 0;
                                    $s = "select * from $datatableMarks where ctNo='$j' && cid='$course' && roll='$i' ORDER BY id DESC ";
                                    $result = mysqli_query($con, $s);
                                    $num = mysqli_num_rows($result);


                                    if ($num == 0) {
                                        continue;
                                    } else {
                                        $var = mysqli_fetch_assoc($result);

                                        $ans = $var['marks'];
                                        if ($ans == 'A') {
                                            $ans = 0;
                                        }
                                    }

                                    $marksList[$j] = $ans;
                                }


                                rsort($marksList);
                                $ans = $marksList[0] + $marksList[1] + $marksList[2];

                                $CTmarks = ceil($ans / 3);
                                echo "<td>$CTmarks</td>";

                                //________________final marks____________________


                                $finalmark = 0;


                                $s = "select * from $dtfinalmark  Where cid='$course' && roll='$i' ORDER BY id DESC ";
                                $result = mysqli_query($con, $s);
                                $nummm = mysqli_num_rows($result);


                                $partAmark = 0;
                                $partBmark = 0;
                                if ($nummm != 0) {
                                    $var = mysqli_fetch_assoc($result);
                                    $partAmark = (int)$var['partA'];
                                    $partBmark = (int)$var['partB'];
                                    $finalmark += $partAmark;
                                    $finalmark += $partBmark;
                                }


                                echo "<td>$partAmark</td>";
                                echo "<td>$partBmark</td>";


                                $totalmarks = $CTmarks + $Amark + $finalmark;
                                echo "<td>$totalmarks</td>";




                                if ($totalmarks >= 80) {
                                    $grade = 'A+';
                                    $gradePoint = '4.00';
                                } else if ($totalmarks >= 75) {
                                    $grade = 'A';
                                    $gradePoint = '3.75';
                                } else if ($totalmarks >= 70) {
                                    $grade = 'A-';
                                    $gradePoint = '3.50';
                                } else if ($totalmarks >= 65) {
                                    $grade = 'B+';
                                    $gradePoint = '3.25';
                                } else if ($totalmarks >= 60) {
                                    $grade = 'B';
                                    $gradePoint = '3.00';
                                } else if ($totalmarks >= 55) {
                                    $grade = 'B-';
                                    $gradePoint = '2.75';
                                } else if ($totalmarks >= 50) {
                                    $grade = 'C+';
                                    $gradePoint = '2.50';
                                } else if ($totalmarks >= 45) {
                                    $grade = 'C';
                                    $gradePoint = '2.25';
                                } else if ($totalmarks >= 40) {
                                    $grade = 'D';
                                    $gradePoint = '2.00';
                                } else {
                                    $grade = 'F';
                                    $gradePoint = '0';
                                }



                                echo "<td>$grade</td>";
                                echo "<td>$gradePoint</td>";





                                echo "</tr>";
                            }




                            $_SESSION['rollStart'] = $rollStart;
                            $_SESSION['rollEnd '] = $rollEnd;
                            $_SESSION['course'] = $course;
                            $_SESSION['pdf'] = 'tcr_Result.php';


                            ?>
                        </table>

                    </div>
                </div>
            <?php






                    }

                    if ($dv['type'] == 'Lab') {



                        $rollStart = $_POST['rollStart'];
                        $rollEnd = $_POST['rollEnd'];
                        $course = $_POST['course'];



                        $ds = "SELECT * From courselist WHERE cid=$course";
                        $dr = mysqli_query($con, $ds);
                        $dv = mysqli_fetch_assoc($dr);



            ?>
                <div class="d-flex justify-content-center">
                    <div class="list">
                        <div class="list">
                            <div class="container">
                                <h4>
                                    <p> <u> Lab mark </u> </p>
                                </h4>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <h5>
                                            <p> Course Code </p>
                                        </h5>
                                    </div>
                                    <div class="col-sm-1">
                                        <h5>
                                            <p>:</p>
                                        </h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5>
                                            <p> <?php echo $dv['ccode'] ?> </p>
                                        </h5>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h5>
                                            <p> Course Name </p>
                                        </h5>
                                    </div>
                                    <div class="col-sm-1">
                                        <h5>
                                            <p>:</p>
                                        </h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5>
                                            <p> <?php echo $dv['cname'] ?> </p>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                        </div>






                        <table class="table table-striped table-bordered" style="max-width: 500px;">
                            <tr>
                                <td>Roll</td>
                                <td>Attandance Mark</td>
                                <td>Quiz</td>
                                <td>Performance/Report</td>
                                <td>Viva</td>
                                <td>Total</td>
                                <td>Grade</td>
                                <td>Grade point</td>


                            </tr>

                            <?php
                            $datatable = 'lab';
                            for ($i = $rollStart; $i <= $rollEnd; $i++) {

                                $s = "select * from $datatable where  cid='$course' && roll='$i'";
                                $result = mysqli_query($con, $s);
                                $num = mysqli_num_rows($result);

                                $quiz;
                                $perform;
                                $viva;
                                if ($num == 0) {

                                    $quiz = '';
                                    $perform = '';
                                    $viva = '';
                                } else {
                                    $var = mysqli_fetch_assoc($result);

                                    $quiz = $var['quiz'];
                                    $perform = $var['perform'];
                                    $viva = $var['viva'];
                                }


                                $ls = "SELECT AVG(attendance.attendance)*100 as per FROM attendance WHERE attendance.roll='$i' and attendance.cid='$course';";
                                $lresult = mysqli_query($con, $ls);
                                $lvar = mysqli_fetch_assoc($lresult);

                                $Amark = 0;
                                $percentage = $lvar['per'];
                                if ($percentage >= 90) {
                                    $Amark = 8;
                                } else if ($percentage >= 85) {
                                    $Amark = 7;
                                } else if ($percentage >= 80) {
                                    $Amark = 6;
                                } else if ($percentage >= 70) {
                                    $Amark = 5;
                                } else if ($percentage >= 60) {
                                    $Amark = 4;
                                }
                                $total = 0;
                                $total = $Amark + $quiz +  $perform + $viva;

                            ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $Amark ?></td>
                                    <td><?php echo  $quiz ?></td>
                                    <td><?php echo   $perform ?></td>
                                    <td><?php echo  $viva ?></td>
                                    <td><?php echo   $total ?></td>

                                    <?php
                                    $totalmarks = $total;
                                    if ($totalmarks >= 80) {
                                        $grade = 'A+';
                                        $gradePoint = '4.00';
                                    } else if ($totalmarks >= 75) {
                                        $grade = 'A';
                                        $gradePoint = '3.75';
                                    } else if ($totalmarks >= 70) {
                                        $grade = 'A-';
                                        $gradePoint = '3.50';
                                    } else if ($totalmarks >= 65) {
                                        $grade = 'B+';
                                        $gradePoint = '3.25';
                                    } else if ($totalmarks >= 60) {
                                        $grade = 'B';
                                        $gradePoint = '3.00';
                                    } else if ($totalmarks >= 55) {
                                        $grade = 'B-';
                                        $gradePoint = '2.75';
                                    } else if ($totalmarks >= 50) {
                                        $grade = 'C+';
                                        $gradePoint = '2.50';
                                    } else if ($totalmarks >= 45) {
                                        $grade = 'C';
                                        $gradePoint = '2.25';
                                    } else if ($totalmarks >= 40) {
                                        $grade = 'D';
                                        $gradePoint = '2.00';
                                    } else {
                                        $grade = 'F';
                                        $gradePoint = '0';
                                    }



                                    echo "<td>$grade</td>";
                                    echo "<td>$gradePoint</td>";


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
    }


        ?>

</body>


</html>