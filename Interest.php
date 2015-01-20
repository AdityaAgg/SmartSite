<input type="button" value="Creat New Field" onclick='creatNew()'>
    <input type="button" value="Remove Last Field" onclick='removeField()'>
            <input type="button" value="Remove All Fields" onclick='removeAllFields()'>
    <script type="text/javascript">
        var x=2;
        var s=x+1;
function creatNew(){
//document.write("<input name=&quot;interest&qout; type=&quot;text&quot name=&quot;Interest"+x+"&quot;/> <br/>");
document.getElementById("demo"+x).innerHTML="<input type=&quot;text&quot name=&quot;Interest"+x+"&quot;/> <br/> <br/>";
x++;
}
function removeField(){
x--;
document.getElementById("demo"+x).innerHTML="";
}
function removeAllFields(){
while (x!=2) {
 x--;
 document.getElementById("demo"+x).innerHTML="";
}
}
    </script>

    <?php
    for ($x=2; $x<20; $x++){
echo '<div id="demo'.$x.'">

</div>';
    }
    ?>