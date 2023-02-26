<?php

require 'connect_DB.php';

session_start();
$id =    $_SESSION['id'];
$dtlogin='login';
$s = "select * from $dtlogin where id=$id   ";
$r = mysqli_query($con,$s);
$v = mysqli_fetch_assoc($r);
$name=$v['name'];
$email= $v['email'];
$pass= $v['password'];
$type=$v['type'];
$datatablelogin='login';


if($type!="Admin"){

    header('location:main.php');

}


?>





<html>
<head>
<title> login and registration </title>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="sstyle.css">

<style>
       .largerCheckbox {
            width: 35px;
            height: 35px;
        }
    </style>

</head>
<body>





<div class="topnav">

  <form  method='post'>
            <button type="submit" class="btn btn-primary " name="viewprofile" >Home</button>
        </form>
 
    <a class="split" href="logout.php"><button class="btn btn-danger ">logout</button> </a>    
</div>


<div class="list" >
    <div class="d-flex justify-content-center">

    <div   class="btn-group">
        <form   method='post'>
            <button type="submit"  class="btn btn-primary"   name="viewdept" >view Department list</button>
        </form>
    </div>
    <div   class="btn-group">
        <form   method='post'>
            <button type="submit"  class="btn btn-primary"   name="adddept" >Add Department</button>
        </form>
    </div>

    <div  onclick="myFunction()" class="btn-group">
        <form  method='post'>
            <button type="submit"  class="btn btn-primary"  name="viewcourse" >View Course list</button>
        </form>
    </div>

    <div  onclick="myFunction()" class="btn-group">
        <form  method='post'>
            <button type="submit"  class="btn btn-primary"  name="addcourse" >Add Course</button>
        </form>
    </div>

</div>

</div>




<?php


// view department name
if(isset($_POST["viewdept"]))
{
    viewdept();
    
}

function viewdept()
{global $id,$con,$datatablelogin;
    $datatable ="dept";
    $s = "select deptcode as code , deptname from $datatable ";
    $result = mysqli_query($con,$s);
    $num = mysqli_num_rows($result);

    if($num!=0)
    {
        ?>
        <div class="d-flex justify-content-center">
        <div class="list" >
        <table class="table table-striped table-bordered">
            <tr>
                <td><h5>Department code</h5></td>
                <td><h5>Department name </h5></td>
            </tr>
        <?php

        while( $var = mysqli_fetch_assoc($result))
        {
            ?>
            <tr>
                <td ><?php echo $var['code']?></td>  
                <td ><?php echo $var['deptname']?></td>  
            <?php

         ?>
         </tr>
         <?php
        }

        ?>
          </table>
          
          <div class="form-group"> 
                    <form  method='post'>
                        <button type="submit" class="btn btn-danger btn-block " name="deletedept" >Delete Dept.</button>
                    </form>
                </div>
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
              <h3>No Department are available</h3>

          </div>
          <div class="minibox">
              <div class="form-group"> 
                  <form  method='post'>
                      <button type="submit" class="btn btn-success btn-block " name="adddept" >Add Department</button>
                  </form>
              </div>
          </div>
      </div>
         
      </div>

        <?php

    }



  
}



// add  department name

if(isset($_POST["adddept"]))
  {
      ?>
      <div class="d-flex justify-content-center">
      <div class="list" >
     
      <div class="form-group" ">
      <form  method='post'>
      <h3>Enter Departments</h3>
          <table class="table table-striped ">
          <tr>
                <td><h5>Department Code</h5></td>
                <td><h5>Department name</h5></td>
            </tr>

          <?php 
          
          for($i=0;$i<5;$i++) 
          {
              $ii=$i+1; ?>
              <tr>
                <td>  
                     <div class="form-group">
              
                     <input type="text"  name="dcode<?php echo $i?>" class="form-control" value="">
              
                    </div>
            </td>
                <td>   
                    <div class="form-group">
              
                    <input type="text"  name="dname<?php echo $i?>" class="form-control" value="">
              
                </div>
            </td>

       
              <tr>
              <?php 
          }?>
          </table>

          <button type="submit" class="btn btn-success btn-block" name="savedept" >Save</button>
      </form>
      </div>
      </div>
      </div>
      
      <?php
  }



  if(isset($_POST["savedept"]))
  { 
      global $id,$con;

      $datatable ="dept";
    


      for($i=0;$i<5;$i++)
      {
          $x="dcode".$i;
          $y="dname".$i;
          $newdcode=$_POST[$x];
          $newdname=$_POST[$y];
          if($newdcode!=""||$newdname!="")
          {
              $s = "INSERT INTO $datatable VALUES('','$newdcode','$newdname')";
              mysqli_query($con,$s);

          }

      }
      viewdept();
   
     
   

  }




  // delete dept 

  if(isset($_POST["deletedept"]))
  {
      echo '<script type="text/javascript">myFunction();</script>';
  
  
      global $id,$con,$datatablelogin;
      $datatable ="dept";
      $s = "select * from $datatable ";
      $result = mysqli_query($con,$s);
      $num = mysqli_num_rows($result);
  
  
      if($num!=0)
      {
          ?>
              <div class="d-flex justify-content-center">
              <div class="list">
              <form method='post'>
  
                  <table class="table table-striped table-bordered ">
                      <tr>
                          <td><h5>Dept. code</h5></td>
                          <td><h5>Dept. Name</h5></td>
                          <td><h5>select for Delete</h5></td>
                      </tr>
              
              <?php
              while( $var = mysqli_fetch_assoc($result))
              {

                  $dcode= $var['deptcode'];
                  $dname= $var['deptname'];
                  $did=$var['deptid'];;
                  ?>
      
                      <tr>
                          <td><?php echo  $dcode?></td>
                          <td><?php echo  $dname?></td>
                          <div class="checkbox" ><td style="text-align: center;"><input type="checkbox" class='largerCheckbox' value="<?php echo $did?>" name="deptids[]"></td></div>
                      </tr>
                         
                  <?php
      
              }
      
              ?>
              </table>
              <button type="submit" class="btn btn-danger btn-block" name="deptDeleteDone" >Delete</button>
  
      
              </form>
              </div>
              </div>
              
              <?php
  
      }
      else
      {
          ?>
          <div class="d-flex justify-content-center">
              <div class="list">
                  <h3>No Dept. are available</h3>
              </div>
          </div>
          <?php
      }
  
  
  }
  
  if(isset($_POST["deptDeleteDone"]))
  {
      
  
          $deptids=$_POST['deptids'];
  
          global $id,$con;
          $datatable ="dept";
       
          foreach ($deptids as $c)
          {
              $s = "DELETE FROM $datatable where deptid='$c' ";
              mysqli_query($con,$s);
          }
      
          ?>
      
          <div class="d-flex justify-content-center">
              <div class="list">
                  <h3>Delete successfully</h3>
              </div>
          </div>
            
            
            <?php
  
  viewdept();
  
  
  }




// view courses

if(isset($_POST["viewcourse"]))
{
    global $id,$con;
        $datatable ="dept";
        $s = "select * from $datatable  ";
        $result = mysqli_query($con,$s);
        $num = mysqli_num_rows($result);
        if($num!=0)
        {
            ?>
            <div class="d-flex justify-content-center">
            <div class="list" >
        <form method='post'>
            <div>
            <label>Department Code</label>
                <select class="form-control" name="deptid" required>
                    <?php  
                     global $id,$con;
                     $datatable ="dept";
                     $s = "select * from $datatable ";
                     $result = mysqli_query($con,$s);
                     $num = mysqli_num_rows($result);        
                     
                    while( $var = mysqli_fetch_assoc($result))
                        { ?><option value="<?php echo $var['deptid']?>" ><?php echo $var['deptcode']?></option>
                            <?php
                        }
                
                        ?>
                </select>
    
            </div>
            
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
            <button type="submit" class="btn btn-success" name="showcourselist" >NEXT</button>

            </div>
        </form> 
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
                    <h3>No dept. are available</h3>
    
                </div>
                <div class="minibox">
                    <div class="form-group"> 
                        <form  method='post'>
                            <button type="submit" class="btn btn-success btn-block " name="adddept" >Add Dept.</button>
                        </form>
                    </div>
                </div>
            </div>
               
            </div>
      
              <?php
    
        }






}

if(isset($_POST["showcourselist"]))
{
    $deptid = $_POST['deptid'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    global $id,$con,$datatablelogin;
    $datatable ="courselist";
    $s = "select * from $datatable where deptid='$deptid' and year='$year' and semester='$sem' ";
    $result = mysqli_query($con,$s);
    $num = mysqli_num_rows($result);

    if($num!=0)
    {
        ?>
        <div class="d-flex justify-content-center">
        <div class="list" >
        <table class="table table-striped table-bordered">
            <tr>
                <td><h5>Course Code</h5></td>
                <td><h5>Course Name </h5></td>
            </tr>
        <?php

        while( $var = mysqli_fetch_assoc($result))
        {
            ?>
            <tr>
                <td ><?php echo $var['ccode']?></td>  
                <td ><?php echo $var['cname']?></td>  
            <?php

         ?>
         </tr>
         <?php
        }

        ?>
          </table>
          
          <div class="form-group"> 
                    <form  method='post'>
                <input type="hidden" name="deptid" value="<?php echo $deptid?>">
                <input type="hidden" name="year" value="<?php echo $year?>">
                <input type="hidden" name="sem" value="<?php echo  $sem?>">
                        <button type="submit" class="btn btn-danger btn-block " name="deletecourse" >Delete Course</button>
                    </form>
                </div>
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
          <div class="minibox">
              <div class="form-group"> 
                  <form  method='post'>
                      <button type="submit" class="btn btn-success btn-block " name="addcourse" >Add Course</button>
                  </form>
              </div>
          </div>
      </div>
         
      </div>

        <?php

    }

}


// delete courese

if(isset($_POST["deletecourse"]))
{
    $deptid = $_POST['deptid'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];

    global $id,$con;
    $datatable ="courselist";
    $s = "select * from $datatable where deptid='$deptid' and year='$year' and semester='$sem' ";
    $result = mysqli_query($con,$s);
    $num = mysqli_num_rows($result);


    if($num!=0)
    {
        ?>
            <div class="d-flex justify-content-center">
            <div class="list">
            <form method='post'>

                <table class="table table-striped table-bordered" ">
                    <tr>
                        <td>Course code</td>
                        <td>Course Name</td>
                        <td>select for Delete</td>
                    </tr>
            
            <?php
            while( $var = mysqli_fetch_assoc($result))
            {

                $dcode= $var['ccode'];
                $dname= $var['cname'];
                $cid=$var['cid'];;
                ?>
    
                    <tr>
                        <td><?php echo  $dcode?></td>
                        <td><?php echo  $dname?></td>
                        <div class="checkbox" ><td style="text-align: center;"><input type="checkbox"  value="<?php echo $cid?>" name="cids[]"></td></div>
                    </tr>
                       
                <?php
    
            }
    
            ?>
            </table>
            <button type="submit" class="btn btn-danger btn-block" name="courseDeleteDone" >Delete</button>

    
            </form>
            </div>
            </div>
            
            <?php

    }
    else
    {
        ?>
        <div class="d-flex justify-content-center">
            <div class="list">
                <h3>No Dept. are available</h3>
            </div>
        </div>
        <?php
    }





}

if(isset($_POST["courseDeleteDone"]))
  {
      
  
          $cids=$_POST['cids'];
  
          global $id,$con;
          $datatable ="courselist";
       
          foreach ($cids as $c)
          {
              $s = "DELETE FROM $datatable where cid='$c' ";
              mysqli_query($con,$s);
          }
      
          ?>
      
          <div class="d-flex justify-content-center">
              <div class="list">
                  <h3>Delete successfully</h3>
              </div>
          </div>
            
            
            <?php
  

  
  
  }




// add course 


if(isset($_POST["addcourse"]))
{


    global $id,$con;
    $datatable ="dept";
    $s = "select * from $datatable  ";
    $result = mysqli_query($con,$s);
    $num = mysqli_num_rows($result);
    if($num!=0)
    {

        ?>
    <div class="d-flex justify-content-center">
    <div class="list" >
   
    <div class="form-group" ">
    <form  method='post'>
    <h3>Enter Courses</h3>
        <table class="table table-striped ">
        <tr>
              <td><h5>Course Code</h5></td>
              <td><h5>Course name</h5></td>
              <td><h5>Credit</h5></td>
              <td><h5>Type</h5></td>
              <td><h5>department</h5></td>
              <td><h5>Year</h5></td>
              <td><h5>Semester</h5></td>
          </tr>

        <?php 
        
        for($i=0;$i<5;$i++) 
        {
            $ii=$i+1; ?>
            <tr>
              <td>  
                   <div class="form-group">
            
                   <input type="text"  name="ccode<?php echo $i?>" class="form-control" value="">
            
                  </div>
          </td>
              <td>   
                  <div class="form-group">
            
                  <input type="text"  name="cname<?php echo $i?>" class="form-control" value="">
            
              </div>
          </td>

          </td>
              <td>   
                  <div class="form-group">
            
                  <input type="text"  name="credit<?php echo $i?>" class="form-control" value='0'>
            
              </div>
          </td>


          <td> 
          <div class="form-group">
          <select class="form-control" name="type<?php echo $i?>">
                    <option value='Theory' >  Theory</option>
                    <option value='Lab' >  Lab </option>
                    <option value='Project/Thesis' >Project/Thesis</option>
                </select>
           
          </div>

          </td>
         
              
          <td>   
                  <div class="form-group">
            
                  <select class="form-control" name="deptid<?php echo $i?>" required>
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
          </td>
          <td> 
          <div class="form-group">
          <select class="form-control" name="year<?php echo $i?>">
                    <option value='1st' >  1st year </option>
                    <option value='2nd' >  2nd year </option>
                    <option value='3rd' >  3rd year </option>
                    <option value='4th' >  4th year </option>
                </select>
           
          </div>

          </td>
          <td>
          
          <div class="form-group">

          <select class="form-control" name="sem<?php echo $i?>">
                    <option value='odd' >  Odd </option>
                    <option value='even' >  Even </option>
                </select>   
        </div>     
          </td>
     
            <tr>
            <?php 
        }?>
        </table>

        <button type="submit" class="btn btn-success btn-block" name="saveCourse" >Save</button>
    </form>
    </div>
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
                <h3>No dept. are available</h3>
  
            </div>
            <div class="minibox">
                <div class="form-group"> 
                    <form  method='post'>
                        <button type="submit" class="btn btn-success btn-block " name="adddept" >Add Dept.</button>
                    </form>
                </div>
            </div>
        </div>
           
        </div>
  
          <?php
  
    }



    

}

if(isset($_POST["saveCourse"]))
  { 
   
    global $id,$con;
  
      $datatable ="courselist";
    
  
  
      for($i=0;$i<5;$i++)
      {
          $ccode=$_POST["ccode".$i];
          $cname=$_POST["cname".$i];
          $deptid=$_POST["deptid".$i];
          $year=$_POST["year".$i];
          $sem=$_POST["sem".$i];
          $_type=$_POST["type".$i];
          $credit=$_POST["credit".$i];
          if($ccode!=""&&$cname!="")
          {
              $s = "INSERT INTO $datatable VALUES('','$ccode','$cname','$deptid','$year','$sem',$credit,'$_type')";
              mysqli_query($con,$s);
  
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
  















?>
</body>
</html>