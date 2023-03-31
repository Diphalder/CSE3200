style="max-width:200px;word-wrap:break-word;"










<p id="demo"></p>

function showtcr()
{
document.getElementById("demo").innerHTML = "<?php ?><div>
    <label>Course</label>
    <select class="form-control" name="personID">
        <option value=''> --none--</option>

    </select>
</div><?php ?>";
}

<textarea  rows="3" style="width: 600px;"  name="" class="form-control input-lg" ></textarea>



<div class="btn-group">
                <form method='post'>
                    <button type="submit" class="btn btn-primary" name="inputco">Input CO marks</button>
                </form>
            </div>


            
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


 