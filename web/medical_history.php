<?php

    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
    }

    require_once('conf.php');
    $user_id = $_SESSION['user_id'];
    $patient_id;

    $sql = "SELECT * FROM PatientsMedProfile WHERE patient_id=?";
    if($user_id[0] == 'D'){
        if(isset($_GET['patient_id'])){
            $patient_id = $_GET['patient_id'];
        } else {
            echo "Invalid ID !";
            exit();
        }
    } else {
        $patient_id = $user_id;
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$patient_id]);
    $row = $stmt->fetch();
    
?>
<!DOCTYPE html>
<html>
<head>
	<head>
        <title>Questions</title>
	    <link rel="stylesheet" href="stylesheets/patient_profile.css"/>
        <style>
            body {
                margin: 0;
                height: 100%; 
                <?php
                if(!isset($_GET['scroll'])) 
                    echo 'overflow: hidden';
                ?>
            }
        </style>
    </head>
</head>
<body style="background: #eee">
    <div>
        <div class="wrapper" style="box-shadow: none;">
        <form action="med_his.php" method="post" id="parent">
                <div class="heading">
                    <div class="title">Medical Information</div>
                </div>             
                <br>
                <hr>
                <section class="sect">
                    <div class="sect_heading">
                        <h4>
                            Basic Medical Information
                        </h4>
                    </div>  
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>Blood Group:</label>
                        <br>
                        <div class="custom_select">
                            <select name="bld_grp">
                            <option value="<?php echo ($row)?$row['bld_grp']:'' ?>"><?php echo ($row)?$row['bld_grp']:'--Select--' ?></option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <br>
                        <label>Allergies:</label>
                        <br>
                        <input type="text" name="allergies" placeholder="Penicillin, Sulpha Drugs, etc" class="input" value="<?php echo ($row)?$row['allergies']:'' ?>">
                        <br><br>
                    </div>
                </section>
                <hr>
                <br>

                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Heart
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had chest pain, a heart attack or congestive heart failure?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="heart" <?php echo ($row)?($row['heart']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="heart" <?php echo ($row)?($row['heart']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Heart Rhythm
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had an abnormal heart rhythm? Please enter 'yes' even if it is controlled by medication, was fixed by a procedure or got better on its own.
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="heart_rhyt" <?php echo ($row)?($row['heart_rhyt']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="heart_rhyt" <?php echo ($row)?($row['heart_rhyt']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Heart Valves &amp; Heart Defects
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had a heart murmur, problems with your heart valves or were you born with a heart defect-even if it has gone away or been fixed?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="heart_valve" <?php echo ($row)?($row['heart_valve']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="heart_valve" <?php echo ($row)?($row['heart_valve']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Circulation
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had any problems with low or high blood pressure, high cholesterol, blood clots,or narrowed/blocked arteries?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="circ" <?php echo ($row)?($row['circ']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="circ" <?php echo ($row)?($row['circ']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Lungs
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had any lung problems? This includes a history of asthma, COPD, TB or pneumonia?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="lungs" <?php echo ($row)?($row['lungs']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="lungs" <?php echo ($row)?($row['lungs']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Sleep Apnea
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever been diagnosed with sleep apnea?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="sleep_apnea" <?php echo ($row)?($row['sleep_apnea']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="sleep_apnea" <?php echo ($row)?($row['sleep_apnea']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Kidney Conditions
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had a kidney failure, kidney stones, incontinence or other kidney/urinary problems?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="kidney" <?php echo ($row)?($row['kidney']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="kidney" <?php echo ($row)?($row['kidney']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Liver &amp; Pancreas
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had a liver failure,  hepatitis, cirrhosis or pancreatitis?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="liver_pancreas" <?php echo ($row)?($row['liver_pancreas']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="liver_pancreas" <?php echo ($row)?($row['liver_pancreas']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            GI
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had any problems with ulcers, inflammatory bowel disease, a hiatal hernia or other problems of the esophagus, stomach or bowels?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="gi" <?php echo ($row)?($row['gi']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="gi" <?php echo ($row)?($row['gi']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Diabetes, Thyroid Disease &amp; Other Endocrine Problems
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had diabetes, thyroid disease &amp; other endocrine problem, even if it has been treated or you no longer have it?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="diabetes" <?php echo ($row)?($row['diabetes']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="diabetes" <?php echo ($row)?($row['diabetes']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Neurological
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had a seizure, a stroke (including a mini-stroke or TIA), a severe migraine headache or other neurologic problems?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="neurological" <?php echo ($row)?($row['neurologcal']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="neurological" <?php echo ($row)?($row['neurologcal']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Cancer
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Have you ever had any type of cancer, even if it has been treated and you no longer have cancer?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="cancer" <?php echo ($row)?($row['cancer']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="cancer" <?php echo ($row)?($row['cancer']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Bones &amp; Muscles
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Do you have a problem with arthritis, low back pain, or a chronic disorder of your joints or muscles?
                        </label>
                        <br/><br/>
                            <input type="radio" value="yes" name="bones" <?php echo ($row)?($row['bones']=='Yes')?'checked':'' :'' ?>>
                            </input>
                            <label>Yes</label>
                            
                            <input type="radio" value="no" name="bones" <?php echo ($row)?($row['bones']=='No')?'checked':'' :'checked' ?>>
                            </input>
                            <label>No</label>
                    </div>
                </div>
                <br/>
                <hr/>
                <div class="sect">
                    <div class="sect_heading">
                        <h4>
                            Infections &amp; Immune System Disorders
                        </h4>
                    </div>	
                    <div class="sect_info" style="width:100%; align-self: center;">
                        <label>
                            Do you have a problem with chronic infections or an immune system disorder such as HIV or AIDs?
                        </label>
                        <br><br>
                        <input type="radio" value="yes" name="infections" <?php echo ($row)?($row['infections']=='Yes')?'checked':'' :'' ?>>
                        </input>
                        <label>Yes</label>
                        
                        <input type="radio" value="no" name="infections" <?php echo ($row)?($row['infections']=='No')?'checked':'' :'checked' ?>>
                        </input>
                        <label>No</label>
                    </div>
                </div>
                <br>
                <hr>
            <a href="Useless/patient_dashboard.html" style="visibility: <?php echo ($user == 1)?hidden:visible ?>;">BACK</a>
            <input type="submit" value="SAVE" class="btn" style="visibility: <?php echo ($user == 1)?hidden:visible ?>;">
            <br><br>

            </form>
        </div>
    </div>
</body>
</html>