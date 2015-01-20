<?
//Name: Aditya Aggarwal
//File: PProfile2.php
//Purpose: Self sorting resume page. Page that outputs the resume and runs the sorting algorithm.
?>
<html>
<head>

<!--JAVASCRIPT FUNCTION HEADER-JAVASCRIPT BASIC FUNCTION TAKEN FROM OPEN SOURCE PLUG IN-->
    <script type="text/javascript">

    /***********************************************
         * Drop Down Date select script- by JavaScriptKit.com
         * This notice MUST stay intact for use
         * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
         ***********************************************/

        var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];

        function populatedropdown(dayfield, monthfield, yearfield){
            var today=new Date()
            var dayfield=document.getElementById(dayfield)
            var monthfield=document.getElementById(monthfield)
            var yearfield=document.getElementById(yearfield)
            for (var i=1; i<32; i++)
                dayfield.options[i-1]=new Option(i, i+1)
          //select today's day
            for (var m=0; m<12; m++)
                monthfield.options[m]=new Option(monthtext[m], m)
            monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], today.getMonth(), true, true) //select today's month
            var thisyear=today.getFullYear()-10
            for (var y=0; y<20; y++){
                yearfield.options[y]=new Option(thisyear, thisyear)
                thisyear-=1
            }
            yearfield.options[0]=new Option(today.getFullYear()-10, today.getFullYear()-10, true, true) //select today's year
        }

       function populategrade (grade) {
           var dropGrades=12;
           var grade=document.getElementById(grade)
           for (var i=0; i<12; i++) {
               grade.options[i]=new Option (dropGrades-i, dropGrades-i);
           }


       }

    </script>





<script type='text/javascript' src='fieldclone.js'></script> <!--OPEN SOURCE PLUGIN-->
    <link rel="stylesheet" href="ProfileDesign12">
</head>
<!--END OF IMPORT AND PLUGINS IN HEADER-->

























<!--PROGRAM START-->
<body>
 <div class="body">



 <!--Logout Functionality-->

    <?php
session_start();
if (isset($_SESSION['var']))
{
    session_destroy();
    header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile.php");
}
?>
<!--End of Logout-->






<?php

echo '<h1 align="center"> Profile Info </h1>';

 //connect to database********************************************************************



$hostname = "mysql7.000webhost.com";
$database = "a4691985_SmartS";
$username = "a4691985_SmartS";
$password = "ObaObaOba12";
$connector = new mysqli($hostname,$username,$password,$database);


if (mysqli_connect_errno())
    die (mysqli_connect_error());
$passwords=$_SESSION['passwords'];
$email=$_SESSION['email'];

$queried=$connector->query("CALL ConnectProfileInfo ('$email', '$passwords')");
$row = $queried->fetch_assoc();
 $Profiler=$row['ProfileID'];
 $Minor=$row['Minor'];
 $Major=$row['Major'];
//****************************************************************************************



//DELETE BUTTON FUNCTIONALITY*****************************************************************
 if (isset ($_POST['delete'])) {
     $deleter=$_POST['delete'];
     $connector52 = new mysqli($hostname,$username,$password,$database);
     $queried52=$connector52->query("DELETE FROM studentinterests WHERE PostInfoID='$deleter'");
     $connector53 = new mysqli($hostname,$username,$password,$database);
     $queried53=$connector53->query("DELETE FROM studentactivities WHERE PostInfoID='$deleter'");
     $connector54 = new mysqli($hostname,$username,$password,$database);
     $queried54=$connector54->query("DELETE FROM postinfo WHERE PostInfoID='$deleter'");
     unset($_POST['delete']);
 }
 //*****************************************************************************************






//Edit Card****************************************************************************************
 if (isset($_SESSION['edit'])){
        echo'<div class="card">';
        echo '<form action="PProfile2.php" method="post">';

//First Name Last Name
         echo 'First Name: <input name="ProfileFirstName" type="text" class="colortext"  value="'.$row['FirstName'].'" />
         &nbsp;&nbsp; Last Name: <input name="ProfileLastName" type="text" class="colortext"  value="'
         .$row['LastName'].'" /> <br>';


//Date of Birth
         echo 'Date Of Birth: &nbsp; <select name="daydropdown" id="daydropdown">
        </select>
        <select name="monthdropdown" id="monthdropdown">
        </select>
        <select name="yeardropdown" id="yeardropdown">
        </select> <br>';



        $dateOfBirth=strtotime($row['DOB']);
        $tsday=date('d',$dateOfBirth);
        $tsmonth=date('m',$dateOfBirth);
        $tsyear=date('Y',$dateOfBirth);

        $currentDate=getdate();
        $cuyear=$currentDate['year'];



//Gender
        echo 'Gender: <br>';
        if ($row['Gender']==0) {
         echo '<div style="margin-left: 40px;">
         <input type="radio" name="ProfileGender" value="0" checked>
          Male <br> <input type="radio" name="ProfileGender" value="1"> Female </div>';

         } elseif ($row['Gender']==1){
         echo '<div style="margin-left: 40px;">
         <input type="radio" name="ProfileGender" value="0">
          Male <br> <input type="radio" name="ProfileGender" value="1" checked> Female </div>';

        } else{
         echo '<div style="margin-left: 40px;">
         <input type="radio" name="ProfileGender" value="0">
         Male <br> <input type="radio" name="ProfileGender" value="1"> Female </div>';
        }




//School
         echo '<br>'.'School: '.'<input name="School" type="text" class="colortext" value="'.$row['School'].'"/> <br>';


//Grade
         echo 'Grade: &nbsp; <select name="ProfileGrade" id="grader">
         </select>';


//Major
         echo '<br>'.'Major: '.'<input name="MajorProfile" type="text" class="colortext" value="'.$Major.'"/>';

//Minor
         echo '<br>'.'Minor: '.'<input name="MinorProfile" type="text" class="colortext" value="'.$Minor.'"/>';




//Interests
         $connector2 = new mysqli($hostname,$username,$password,$database);
         $queried2=$connector2->query("CALL ShowAllMajorInterest ('$Profiler')");
         echo '<br>'.'Interests: '.'<br>';
         $la=0;
         $inter=1;
     echo '<div style="margin-left:40px;">';
         while ($row2 = $queried2->fetch_assoc()) {
             $Interests[$la]=$row2['InterestDesc'];
             echo' <input name="InterestProf'.$inter.'" type="text" value="'.$Interests[$la].'" class="colortext" /> <br>';

             $la++;
             $inter++;
         }


            for ($x=$inter; $x<20; $x++){
                echo ' <div id="enterer'.$x.'"> </div>';
                echo '<div id="demoer'.$x.'"> </div>';


            }
            echo '<br>';


//javascript for creating new fields in interest edit section
     echo ' <script type="text/javascript">
         var xer='.$inter.';
         var ser=xer+1;
         function createNeww(){
             document.getElementById("enterer"+xer).innerHTML="<br>";
             document.getElementById("demoer"+xer).innerHTML="<input name=InterestProf"+xer+" type=text />";
             xer++;
         }
         function removeFieldw(){
             xer--;
             document.getElementById("demoer"+xer).innerHTML="";
             document.getElementById("enterer"+xer).innerHTML="";
         }
         function removeAllFieldsw(){
             while (xer!='.$inter.') {
                 xer--;
                 document.getElementById("demoer"+xer).innerHTML="";
                 document.getElementById("enterer"+xer).innerHTML="";
             }
         }
 </script>';



//button to create and remove fields interest section
      echo '<input class="classname2" type="button" value="Create New Field" onclick="createNeww()">
            <input class="classname2" type="button" value="Remove Last Field" onclick="removeFieldw()">
            <input class="classname2" type="button" value="Remove All Fields" onclick="removeAllFieldsw()"> <br> <br>';
echo '</div>';







//Background Information and Last Edited
         echo 'Background Info: <br> <textarea name="info" id="back" rows="1"> '.$row['Background'].'</textarea>';
         echo '<div align="right" style="font-size:12px;" >'.'Last Edited: '.$row['LastEdited'].'<br> <br>  </div>';


//Save edits button
         echo'<div align="right"> <a href="PProfile4.php">
         <input class="classname2" type="submit" value="Save"> </a> </div> </form> </div>';




//Populate dropdowns with values call to javascript functions
     echo '        <script type="text/javascript">


        window.onload=function(){
        populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
        daydropdown.options['.($tsday-1).']=new Option('.$tsday.','.($tsday+1).', true, true)
        monthdropdown.options['.($tsmonth-1).']=new Option(monthtext['.($tsmonth-1).'], '.($tsmonth-1).', true, true)
        yeardropdown.options['.($cuyear-10-$tsyear).']=new Option('.$tsyear.','.$tsyear.', true, true)
        populategrade("grader")
        grader.options['.(12-$row['Grade']).']=new Option('.$row['Grade'].','.$row['Grade'].', true, true)
         }
        </script>';








//PHP Involved saving data in card
     if (isset($_POST['ProfileFirstName'])) {

//First Name
         $FirstNamePoster=$_POST['ProfileFirstName'];
         $connector28 = new mysqli($hostname,$username,$password,$database);
         $queried28=$connector28->query("UPDATE profile SET FirstName='$FirstNamePoster' WHERE ProfileID='$Profiler'");

//Last Name
         $LastNamePoster=$_POST['ProfileLastName'];
         $connector29 = new mysqli($hostname,$username,$password,$database);
         $queried29=$connector29->query("UPDATE profile SET LastName='$LastNamePoster' WHERE ProfileID='$Profiler'");

//Date of Birth
         $da=$_POST['daydropdown']-1;
         $mont=$_POST['monthdropdown']+1;
         $yea=$_POST['yeardropdown'];
         $ProfileDate=$yea.'-'.$mont.'-'.$da;
         $_SESSION['a']=$ProfileDate;
         $connector51 = new mysqli($hostname,$username,$password,$database);
         $queried51=$connector51->query("UPDATE profile SET DOB='$ProfileDate' WHERE ProfileID='$Profiler'");

//Gender
         $ProfileGender=$_POST['ProfileGender'];
         $connector30 = new mysqli($hostname,$username,$password,$database);
         $queried30=$connector30->query("UPDATE profile SET Gender='$ProfileGender' WHERE ProfileID='$Profiler'");

//Grade
         $ProfileGrade=$_POST['ProfileGrade'];
         $connector31 = new mysqli($hostname,$username,$password,$database);
         $queried31=$connector31->query("UPDATE profile SET Grade='$ProfileGrade' WHERE ProfileID='$Profiler'");







//Major
         $MajorProfile=$_POST['MajorProfile'];
         $connector37 = new mysqli($hostname,$username,$password,$database);
         $queried37=$connector37->query("UPDATE studentinterests SET MajorMinor=NULL WHERE MajorMinor='0' AND ProfileID='$Profiler'");

         $connector34 = new mysqli($hostname,$username,$password,$database);
         $queried34=$connector34->query("INSERT INTO listofinterests (InterestDesc, InterestCategoryID)
     VALUES ('$MajorProfile', NULL)");

         $connector38 = new mysqli($hostname,$username,$password,$database);
         $queried38=$connector38->query("Call FindInterestID('$MajorProfile')");
         $row38 = $queried38->fetch_assoc();
         $MajorID=$row38['InterestID'];

         $connector39 = new mysqli($hostname,$username,$password,$database);
         $queried39=$connector39->query("INSERT INTO studentinterests( ProfileID, InterestID, MajorMinor, PostInfoID)
         VALUES ('$Profiler','$MajorID','0', NULL)");




//Minor
         $MinorProfile=$_POST['MinorProfile'];
         $connector40 = new mysqli($hostname,$username,$password,$database);
         $queried40=$connector40->query("UPDATE studentinterests SET MajorMinor=NULL WHERE MajorMinor='1' AND ProfileID='$Profiler'");

         $connector42 = new mysqli($hostname,$username,$password,$database);
         $queried42=$connector42->query("INSERT INTO listofinterests (InterestDesc, InterestCategoryID)
     VALUES ('$MinorProfile', NULL)");

         $connector44 = new mysqli($hostname,$username,$password,$database);
         $queried44=$connector44->query("Call FindInterestID('$MinorProfile')");
         $row44 = $queried44->fetch_assoc();
         $MinorID=$row44['InterestID'];

         $connector45 = new mysqli($hostname,$username,$password,$database);
         $queried45=$connector45->query("INSERT INTO studentinterests( ProfileID, InterestID, MajorMinor, PostInfoID)
         VALUES ('$Profiler','$MinorID','1', NULL)");



//Interests
         $countersol=0;
         $is=1;

         $connector46 = new mysqli($hostname,$username,$password,$database);
         $queried46=$connector46->query("UPDATE studentinterests SET MajorMinor=NULL WHERE MajorMinor='2' AND ProfileID='$Profiler'");

         while(isset($_POST['InterestProf'.$is])) {
             $countersol+=1;
             $is++;
         }


         for ($ls=1;$ls<$is;$ls++) {
             $InterestProf=$_POST['InterestProf'.$ls];

         $connector47 = new mysqli($hostname,$username,$password,$database);
         $queried47=$connector47->query("INSERT INTO listofinterests ( InterestDesc, InterestCategoryID)
     VALUES ('$InterestProf', NULL)");

         $connector49 = new mysqli($hostname,$username,$password,$database);
         $queried49=$connector49->query("Call FindInterestID('$InterestProf')");
         $row49 = $queried49->fetch_assoc();
         $InterestProfID=$row49['InterestID'];

         $connector50 = new mysqli($hostname,$username,$password,$database);
         $queried50=$connector50->query("INSERT INTO studentinterests( ProfileID, InterestID, MajorMinor, PostInfoID)
         VALUES ('$Profiler','$InterestProfID','2', NULL)");
         }







//Profile Description
         $ProfileDescription=$_POST['info'];
         $connector32 = new mysqli($hostname,$username,$password,$database);
         $queried32=$connector32->query("UPDATE profile SET Background='$ProfileDescription' WHERE ProfileID='$Profiler'");


//Go to Document that ends session
         header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile4.php");
     }

 }
 //*****************************************************************************************************************





 //Printed Card*****************************************************************************************************
 else {
//Name, DOB, and Gender
     echo'<div class="card">';
     echo 'Name: '.$row ['FirstName'].' '
         .$row['LastName'].'<br> Date Of Birth:'.$row['DOB'].'<br>';
     if ($row['Gender']==0) {
         echo'Gender: Male';
     } elseif ($row['Gender']==1){
         echo'Gender: Female';
     } else{
         echo'Gender: Other';
     }

//School, Grade, Major, and Minor
     echo '<br>'.'School: '.$row['School'];
     echo '<br>'.'Grade: '.$row['Grade'];
     echo '<br>'.'Major: '.$row['Major'];
     echo '<br>'.'Minor: '.$row['Minor'];


//All Interests
     $connector2 = new mysqli($hostname,$username,$password,$database);
     $queried2=$connector2->query("CALL ShowAllMajorInterest ('$Profiler')");
     echo '<br>'.'Interests: '.'<br>';
     $la=0;
     while ($row2 = $queried2->fetch_assoc()) {
         echo'<div style="margin-left:40px;">'.$row2['InterestDesc'].'<br> </div>';
         $Interests[$la]=$row2['InterestDesc'];
         $la++;
     }

//Description and Last Edited
     echo 'Description: '.$row['Background'];
     echo '<div align="right" style="font-size:12px;" >'.'Last Edited: '.$row['LastEdited'].'<br> <br>  </div>';


 //Edit Button Goes to document that turns on edit session variable
     echo'<div align="right"> <a href="PProfile4.php">
     <input class="classname2" type="button" value="Edit"></a></div> </div>';

 }
//*******************************************************************************************************************
?>





<!--Input Area **************************************************************************************-->



 <!--HTML And FRONT END------------------------------------->
 <h1 align="center"> Posts </h1>
<br> <br> <br>
 <div class="postform">
    <form action="PProfile2.php" method="post">

    <!--Activity and Description Field-->
        Activity:
        <input name="Activity" type="text" id="Activity" class="colortext" />
        <a name="PostLink"> </a>
        <br>
        Description:
        <br>

    <!--Description Field-->
        <textarea name="Desc" id="de">
        </textarea>
        <script type="text/javascript">
            document.getElementById('de').defaultValue="";
        </script>
        <br>



    <!--Category Field-->
        Category:
        <select name="CategoryID">
           <option value="1"> Academics </option>
            <option value="2"> Extra-Curricular </option>
            <option value="3"> Sports </option>
            <option value="4"> Community Service</option>
        </select>

    <!--Interest Field-->
 <div align="right">
     <div style="margin-right: 300px">
       Interests:
         </div>
        <div  style="margin-right: 40px;">

            <br>

            <input name="Interest1" class="colortext" type="text"  />




           <!--Javascript Field Cloner Remove and Create Field Functionality-->
            <script type="text/javascript">
                var x=2;
                var s=x+1;
                function createNew(){
                    document.getElementById("enter"+x).innerHTML="<br>";
                    document.getElementById("demo"+x).innerHTML="<input  name='Interest"+x+"' type='text'/> ";
                   //  alert("<input  name='Interest"+x+"' type='text'/>");

                    x++;
                }
                function removeField(){
                    x--;
                    document.getElementById("demo"+x).innerHTML="";
                    document.getElementById("enter"+x).innerHTML="";
                }
                function removeAllFields(){
                    while (x!=2) {
                        x--;
                        document.getElementById("demo"+x).innerHTML="";
                        document.getElementById("enter"+x).innerHTML="";
                    }
                }
            </script>

            <!--Sections Developed for creating and removing fields-->
            <?php
            for ($x=2; $x<20; $x++){
                echo '</div> </div>
                <div id="enter'.$x.'"> </div>
                <div align="right">
                <div style="margin-right: 40px;">';

                echo '<div id="demo'.$x.'"> </div>';


            }
            echo '<br>';
            ?>

            <!--Create and Remove Buttons-->
            <input class="classname2" type="button" value="Create New Field" onclick='createNew()'>
            <input class="classname2" type="button" value="Remove Last Field" onclick='removeField()'>
            <input class="classname2" type="button" value="Remove All Fields" onclick='removeAllFields()'>
            </div>

 </div>

        <br>
        <hr>
            <input class="classname"  type="submit"/>

    </form>
    </div>
  <!------------------------------------------------------------------------------------>





<?php
//Storing Data after submit, PHP-------------------------------------------------------------------
if (isset($_POST['Desc']) && $_POST['Desc'] !='') {

//Basic Post Info

    $Activity=$_POST['Activity'];
    $Promo=0;
    $CategoryID=$_POST['CategoryID'];
    $PostDesc=$_POST['Desc'];

    $connector6 = new mysqli($hostname,$username,$password,$database);
    $queried6=$connector6->query("INSERT INTO PostInfo (PostDesc, CategoryID, ProfileID, ProfileLevelID, Promotions
    ) VALUES ('$PostDesc','$CategoryID','$Profiler','1','0')");


//Activities
    $connector7 = new mysqli($hostname,$username,$password,$database);
    $queried7=$connector7->query("INSERT INTO listofactivities ( ActivityDesc, ActivityCategoryID)
     VALUES ('$Activity','$CategoryID')");





    $connector8 = new mysqli($hostname,$username,$password,$database);
    $queried8=$connector8->query("Call ActivityInputer('$Activity')");
    $row8 = $queried8->fetch_assoc();
    $postInfoID=$row8['valsess'];
    $postInfoIDu=$postInfoID;
    $ActivityID=$row8['vals'];


echo $postInfoIDu;
    echo $ActivityID;
    $connector9 = new mysqli($hostname,$username,$password,$database);
    $queried9=$connector9->query("INSERT INTO studentactivities (PostInfoID, ActivityID) VALUES ('$postInfoIDu','$ActivityID')");










//Interests
$counter=0;
$i=1;
while(isset($_POST['Interest'.$i])) {
    $counter+=1;
    $i++;
}


for ($l=1;$l<$i;$l++) {
    $Interest=$_POST['Interest'.$l];

    $connector13 = new mysqli($hostname,$username,$password,$database);
    $queried13=$connector13->query("INSERT INTO listofinterests ( InterestDesc, InterestCategoryID)
     VALUES ('$Interest','$CategoryID')");


    $connector15 = new mysqli($hostname,$username,$password,$database);
    $queried15=$connector15->query("Call FindInterestID('$Interest')");
    $row15 = $queried15->fetch_assoc();

    $InterestID=$row15['InterestID'];

    $connector16 = new mysqli($hostname,$username,$password,$database);
    $queried16=$connector16->query("INSERT INTO studentinterests( ProfileID, InterestID, PostInfoID) values
    ('$Profiler','$InterestID','$postInfoIDu')");

}
    unset($_POST['Desc']);
    header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile2.php");
}
//---------------------------------------------------------------------------------------------------------
?>
<!--*******************************************************************************************************-->
















<?php
//*************************************************************************************************************
//category sort**********************************************************
/*Categorical Sort
Major Compare 25%
Minor Compare 15%
Interest Compare 20%
Achievement Amount Compare 15%
Promotion Amount Compare 2.5%
Time, Recency 20%
Rec Amount Compare 2.5%*/




//Declare value variables-----------------------------------------------------------------
$a[1]=0;
$a[2]=0;
$a[3]=0;
$a[4]=0;

$arrays[1]="Academics";
$arrays[2]="Extra Curricular";
$arrays[3]="Sports";
$arrays[4]="Community Service";
//---------------------------------------------------------------------------------------




//---------------------------------------------------------------------------------------
for ($c=1;$c<5;$c++)
{
$connector18=new mysqli($hostname,$username,$password,$database);

$queried18=$connector18->query("CALL FilterMajMinIntPostCat('$Major','$c','$Profiler')");
 $row18=$queried18->fetch_assoc();
    $MajorAmount[$c]=$row18['COUNT(*)'];
    $MajorAmountConstant[$c]=$row18['COUNT(*)'];



}

for ($counting2=1;$counting2<5; $counting2++) {
    $maxIndex=1;
    for ($counting=1;$counting<4;$counting++)
{
    if ($MajorAmount[$maxIndex]<$MajorAmount[$counting+1]){
        $maxIndex=$counting+1;

    }
}

$SortedMajor[$counting2]=$maxIndex;
    $MajorAmount[$maxIndex]=-1;
}



if ($MajorAmountConstant[1]==$MajorAmountConstant[2] && $MajorAmountConstant[3]==$MajorAmountConstant[4]
    && $MajorAmountConstant[2]==$MajorAmountConstant[3]) {
$abc=0;
} else {
    $a[$SortedMajor[1]]=$a[$SortedMajor[1]]+25;
    $a[$SortedMajor[2]]=$a[$SortedMajor[2]]+15;
    $a[$SortedMajor[3]]=$a[$SortedMajor[3]]+5;
}
//---------------------------------------------------------------------------------------



//---------------------------------------------------------------------------------------
for ($c=1;$c<5;$c++)
{
    $connector19=new mysqli($hostname,$username,$password,$database);
    $queried19=$connector19->query("CALL FilterMajMinIntPostCat('$Minor','$c','$Profiler')");
    $row19=$queried19->fetch_assoc();
    $MinorAmount[$c]=$row19['COUNT(*)'];
    $MinorAmountConstant[$c]=$row19['COUNT(*)'];
}


for ($counting2=1;$counting2<5; $counting2++) {
    $maxIndex=1;
    for ($counting=1;$counting<4;$counting++)
    {
        if ($MinorAmount[$maxIndex]<$MinorAmount[$counting+1]){
            $maxIndex=$counting+1;

        }
    }

    $SortedMinor[$counting2]=$maxIndex;
    $MinorAmount[$maxIndex]=-1;
}



if ($MinorAmountConstant[1]==$MinorAmountConstant[2] && $MinorAmountConstant[3]==$MinorAmountConstant[4]
    && $MinorAmountConstant[2]==$MinorAmountConstant[3]) {
    $abc=1;
}else {
$a[$SortedMinor[1]]=$a[$SortedMinor[1]]+15;
$a[$SortedMinor[2]]=$a[$SortedMinor[2]]+10;
$a[$SortedMinor[3]]=$a[$SortedMinor[3]]+5;
}
//---------------------------------------------------------------------------------------




//---------------------------------------------------------------------------------------
//Interest Compare

 $st=0;
   while ($st<$la) {
for ($c=1;$c<5;$c++)
{
    $connector20=new mysqli($hostname,$username,$password,$database);
    $queried20=$connector20->query("CALL FilterMajMinIntPostCat('$Interests[$st]','$c','$Profiler')");
    $row20=$queried20->fetch_assoc();
    $InterestAmount[$c]=$row20['COUNT(*)'];
    $InterestAmountConstant[$c]=$row20['COUNT(*)'];
}


for ($counting2=1;$counting2<5; $counting2++) {
    $maxIndex=1;
    for ($counting=1;$counting<4;$counting++)
    {
        if ($InterestAmount[$maxIndex]<$InterestAmount[$counting+1]){
            $maxIndex=$counting+1;

        }
    }

    $SortedInterest[$counting2]=$maxIndex;
    $InterestAmount[$maxIndex]=-1;
}


if ($InterestAmountConstant[1]==$InterestAmountConstant[2] &&
    $InterestAmountConstant[3]==$InterestAmountConstant[4]
    && $InterestAmountConstant[2]==$InterestAmountConstant[3]) {
    $abc=2;

}else {

    $a[$SortedInterest[1]]=$a[$SortedInterest[1]]+(20/$la);
    $a[$SortedInterest[2]]=$a[$SortedInterest[2]]+(13/$la);
    $a[$SortedInterest[3]]=$a[$SortedInterest[3]]+(6/$la);
}
    $st++;
}
//---------------------------------------------------------------------------------------







//---------------------------------------------------------------------------------------
//Achievement Amount compare

    for ($c=1;$c<5;$c++)
    {
        $connector21=new mysqli($hostname,$username,$password,$database);
        $queried21=$connector21->query("CALL FilterPostInfoCat('$Profiler','$c')");
        $row21=$queried21->fetch_assoc();
        $PostAmount[$c]=$row21['COUNT(*)'];
        $PostAmountConstant[$c]=$row21['COUNT(*)'];
    }

$maxIndex=1;
for ($outer=1; $outer<5; $outer++){
    for($inner=1; $inner<5; $inner++) {
        if($PostAmount[$maxIndex]<$PostAmount[$inner]) {
            $maxIndex=$inner;
        }
    }
    $SortedPost[$outer]=$maxIndex;
    $PostAmount[$maxIndex]=-1;
}



    if ($PostAmountConstant[1]==$PostAmountConstant[2] && $PostAmountConstant[3]==$PostAmountConstant[4]
        && $PostAmountConstant[2]==$PostAmountConstant[3]) {
        $abc=3;
    }else {

        $a[$SortedPost[1]]=$a[$SortedPost[1]]+15;
        $a[$SortedPost[2]]=$a[$SortedPost[2]]+10;
        $a[$SortedPost[3]]=$a[$SortedPost[3]]+5;
    }
//---------------------------------------------------------------------------------------






//---------------------------------------------------------------------------------------
//Promotion Amount Compare
//To be implemented with Social Networking Aspect
//Not Part of APCS Project
//---------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------
//Recommendation Amount Compare
//To be implemented with Social Networking Aspect
//Not Part of APCS Project
//---------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------
//Recency: Time and Date
for ($c=1;$c<5;$c++)
{
    $connector22=new mysqli($hostname,$username,$password,$database);
    $queried22=$connector22->query("CALL FilterPostDateInfoCat('$Profiler','$c')");
    $row22=$queried22->fetch_assoc();
    $time=$row22['timer']/1000000;
    $PostDate[$c]=$row22['sumID']+$time;
    $PostDateConstant[$c]=$row22['sumID']+$time;
}

$maxIndex=1;
for ($outer=1; $outer<5; $outer++){
    for($inner=1; $inner<5; $inner++) {
        if($PostDate[$maxIndex]<$PostDate[$inner]) {
            $maxIndex=$inner;
        }
    }
    $SortedDate[$outer]=$maxIndex;
    $PostDate[$maxIndex]=-1;
}



if ($PostDateConstant[1]==$PostDateConstant[2] && $PostDateConstant[3]==$PostDateConstant[4] &&
    $PostDateConstant[2]==$PostDateConstant[3]) {
    $abc=4;
}else {

    $a[$SortedDate[1]]=$a[$SortedDate[1]]+15;
    $a[$SortedDate[2]]=$a[$SortedDate[2]]+10;
    $a[$SortedDate[3]]=$a[$SortedDate[3]]+5;
}
//---------------------------------------------------------------------------------------






//Find and sort indexes of category with max value(most importance) to category with min value(least importance)--
$index[1]=1;
$index[2]=2;
$index[3]=3;
$index[4]=4;
for ($q=1; $q<5; $q++) {
for ($u=1; $u<5; $u++) {
 if ($a[$u]>$a[$index[$q]]) {
     $index[$q]=$u;
 }
}
    $a[$index[$q]]=-1;
}
//---------------------------------------------------------------------------------------------------------------
//**************************************************************************************************************
















//*************************************************************************************************************
/*Post Sort
Major Compare 25%
Minor Compare 15%
Interest Compare 25%
Promotion Amount Compare 5%
Time, Recency 25%
Rec Amount Compare 5%*/

foreach ($index as &$catIndex)
{
    echo '<h3>'. $arrays[$catIndex]. '</h3>';


//Define Array that stores via $array[postID]--------------------------------------------------------------------------
    $connector23=new mysqli($hostname,$username,$password,$database);
    $queried23=$connector23->query("CALL FilterPostInfoCatTable('$Profiler','$catIndex')");


    $innerInc=0;

    while ($row23 = $queried23->fetch_assoc()) {
    $InnerArr[$row23['PostInfoID']]=0;
    $arrayer[$innerInc]=$row23['PostInfoID'];
    $innerInc++;
    }
//---------------------------------------------------------------------------------------------------------------------





//Major Compare--------------------------------------------------------------------------------------------------------
    $connector24=new mysqli($hostname,$username,$password,$database);
    $queried24=$connector24->query("CALL FilterMajMinIntPostCatTable('$Major','$catIndex','$Profiler')");
    while ($row24=$queried24->fetch_assoc()) {
        $InnerArr[$row24['PostInfoID']]+=25;
    }
//---------------------------------------------------------------------------------------------------------------------



//Minor Compare--------------------------------------------------------------------------------------------------------
    $connector25=new mysqli($hostname,$username,$password,$database);
    $queried25=$connector25->query("CALL FilterMajMinIntPostCatTable('$Minor','$catIndex','$Profiler')");
    while ($row25=$queried25->fetch_assoc()) {
        $InnerArr[$row25['PostInfoID']]+=15;
    }
//---------------------------------------------------------------------------------------------------------------------





//Interest Compare-----------------------------------------------------------------------------------------------------
$st2=0;
    while ($st2<$la) {
        $connector26=new mysqli($hostname,$username,$password,$database);
        $queried26=$connector26->query("CALL FilterMajMinIntPostCatTable('$Interests[$st2]','$catIndex','$Profiler')");
        while ($row26=$queried26->fetch_assoc()) {
            $InnerArr[$row26['PostInfoID']]+=20/$la;
        }
        $st2++;
    }
//---------------------------------------------------------------------------------------------------------------------



//---------------------------------------------------------------------------------------
//Promotion Amount Compare
//To be implemented with Social Networking Aspect
//Not Part of APCS Project
//---------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------
//Recommendation Amount Compare
//To be implemented with Social Networking Aspect
//Not Part of APCS Project
//---------------------------------------------------------------------------------------

//Date Compare---------------------------------------------------------------------------------------------------------
  $dateAmount=0;
    if (isset($arrayer)) {
   foreach ($arrayer as &$InnerDateData)
   {
    $connector27=new mysqli($hostname,$username,$password,$database);
    $queried27=$connector27->query("CALL FilterPostDateInfoPost('$Profiler','$catIndex','$InnerDateData')");
    $row27=$queried27->fetch_assoc();
    $averageTime=$row27['PostInfoID']+$row27['TimeFrame']/1000000;
       $InnerDate[$InnerDateData]=$averageTime;
       $dateAmount++;
   }
    for ($dateRunner=0; $dateRunner<$dateAmount; $dateRunner++) {
    $maxDateValue=max($InnerDate);
    $maxDateIndex=array_keys($InnerDate, $maxDateValue);
    $maximumDateIndex=$maxDateIndex[0];
    $InnerArr[$maximumDateIndex]+=25-($dateRunner*(25/$dateAmount));
    $InnerDate[$maximumDateIndex]=-1;
}
    }
//---------------------------------------------------------------------------------------------------------------------


//Find Maximum Indexes for Post order----------------------------------------------------------------------------------
//Create new array sorted with index that contains highest values
    //to index that contains lowest values.

    for($running=0; $running<$innerInc; $running++) {
    $maxInnerValue= max($InnerArr);
    $maximumInnerArr=array_keys($InnerArr,$maxInnerValue);
    $maximumInnerIndex=$maximumInnerArr[0];
    $InnerIndex[$running]=$maximumInnerIndex;
    $InnerArr[$maximumInnerIndex]=-1;
    }
//---------------------------------------------------------------------------------------------------------------------
//**********************************************************************************************************************



//Print Statement--------------------------------------------------------------------------------------------
if (isset($InnerIndex)) {
 foreach($InnerIndex as &$InnerPostData) {


     $connector3 = new mysqli($hostname,$username,$password,$database);
     $queried3=$connector3->query("CALL BasicGetPostInfoInner('$Profiler','$catIndex','$InnerPostData')");
     $row3=$queried3->fetch_assoc();
    $post=$row3['PostInfoID'];
    $connector4 = new mysqli($hostname,$username,$password,$database);
    $queried4=$connector4->query("CALL BasicRecsNumber('$post')");
    $row4 = $queried4->fetch_assoc();
    $connector5= new mysqli($hostname,$username,$password,$database);
    $queried5=$connector5->query("Call BasicRecsInfo('$post')");
    $connector17=new mysqli($hostname,$username,$password,$database);
    $queried17=$connector17->query("Call ShowPostInterests('$Profiler','$post')");


     if (isset ($row3['PostDesc'])) {
    echo'<div class="post">
     <div style="float:right"> <form action="PProfile2.php" method="post">
     <button type="submit" name="delete" class="deleterStyle"  value="'.$post.'">x</button>  </form>  </div> <br> '.$row3['ActivityDesc'].':
    '.$row3['PostDesc'].'<br> <div style="font-size:12px;" >
    <br> <br> <br> <!--Promotions: '.$row3['Promotions'].' &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;
     Recs:'.$row4['RecsCount'].'-->  <div align="right">   LastEdited: '.$row3['LastEdited'];
    echo '<div align="left">Interests: ';
    while ($row17=$queried17->fetch_assoc()){
        echo $row17['InterestDesc'].' ';
    }

    echo'</div></div></div></div>';
 }

 }
} else {
    echo '<label for="Activity">
    <div class="post"> <h3 align="center" style="color: graytext;"> No Posts. Start Adding. </h3> </div>  </label>';
}
    echo '<br>'. '<br> <br>';

//---------------------------------------------------------------------------------------------------------------------

unset($arrayer);
unset($InnerArr);
unset($InnerIndex);
}
//*************************************************************************************************************
?>

<div class="footer">

<center> <a class="footer" href="PProfile3.php"> Logout </a> </center> </div>
</div>
</body>
</html>