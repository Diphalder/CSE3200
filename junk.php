style="max-width:200px;word-wrap:break-word;"

                                    <?php 

                                    $s = "select * from $datatable where type='Teacher' && cid=$cid ";
                                    $r = mysqli_query($con, $s);
                                    ?> 
                                    <div>
                                    <label>Course</label>
                                    <select class="form-control" name="personID">
                                        <option  value=''> --none--</option>
                                                 <?php
                                                while ($v = mysqli_fetch_assoc($r)) {
                                                    $newid = $v['personID'];
                                                    $q = "select * from $datatablelogin WHERE id=$newid ";
                                                    $k = mysqli_query($con, $q);
                                                    $d = mysqli_fetch_assoc($k);
                                                    $tcrName = $d['name'];
                                                    ?> <option  value='<?php echo $newid ?>'> <?php echo $tcrName ?> </option> <?php
        
                                                }

                                                ?>
                                                </select> </div> <?php
                                    
                                    ?>







<p id="demo"></p>

function showtcr()
                                {
                                    document.getElementById("demo").innerHTML = "<?php ?><div>
                                    <label>Course</label>
                                            <select class="form-control" name="personID">
                                                <option  value=''> --none--</option>
    
                                                        </select> </div><?php ?>";
                                }