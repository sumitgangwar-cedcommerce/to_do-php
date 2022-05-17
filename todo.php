<?php 
    session_start();
    if(!isset($_SESSION['incomplete'])){
        $_SESSION['incomplete']['Pay Bills']="Pay Bills";
        $_SESSION['incomplete']['Go Shopping']="Go Shopping";
    }
    if(!isset($_SESSION['complete'])){
        $_SESSION['complete']['See the doctor']="See the doctor";
    }
?>



<?php
    if(isset($_GET['action'])){
        $X=$_GET['action'];
        $Y=$_GET['key'];
        if($_SESSION[$X][$Y]==""){
            foreach($_SESSION[$X] as $key=>$val){
                echo $val;
                if($Y==$val){
                    unset($_SESSION[$X][$key]);
                    break;
                }
            }
        }
        // print_r($_SESSION[$X]);
        unset($_SESSION[$X][$Y]);
        // print_r($_SESSION[$X]);
    }
?>
<?php
    if(isset($_GET['ADD']) && $_GET['task']!=""){
        echo "ADD";
        $_SESSION['incomplete'][$_GET['task']]=$_GET['task'];
    }
    if(isset($_GET['Update']) && $_GET['task']!=""){
        echo $key = $_GET['task'];
        $arr = $_SESSION['item'][1];
        $temp_arr = array($key=>$key);
        echo $count = $_SESSION['item'][2];
        // if(is_array($_SESSION[$arr]))  echo "TRUE";
        // else echo "FAlse";
        array_splice($_SESSION[$arr],$count,1,$temp_arr);
        print_r($_SESSION[$arr]);
        unset($_SESSION['item']);
    }
?>

<?php
    if(isset($_GET['act'])){
       $inp_val = $_GET['key'];
       $btn_val = "Update";
       $arr = $_GET['arr'];
       $count = 0;
       foreach($_SESSION[$arr] as $key=>$val){
           echo $val;
           if($inp_val==$val)   break;
           else $count++;
       }
    //    print_r($_SESSION[$arr]);
       echo $count."<br>";
    //    unset($_SESSION[$arr][$inp_val]);
       $_SESSION['item'] = array($inp_val,$arr,$count);
    }
?>
<?php
    if(isset($_GET['checkbox'])){
        echo $_GET['key']."jcvfoidsj";
    }
?>
<?php
if(isset($_GET['check'])){
    $_SESSION["comp"]+=1;
    $index=$_SESSION["comp"];
    $shift=$_GET['check'];
    $_SESSION["complete"][$index]=$_SESSION["incomplete"][$shift];
    unset($_SESSION["incomplete"][$shift]);

}
if(isset($_GET['check2'])){
    $_SESSION["inc"]+=1;
    $index=$_SESSION["inc"];
    $shift=$_GET['check2'];
    $_SESSION["incomplete"][$index]=$_SESSION["complete"][$shift];
    unset($_SESSION["complete"][$shift]);

}

?>




    <html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <script>
            function transfer(E){
                window.location.href="?check="+E;
                
            }
            function transfer2(E){
                window.location.href="?check2="+E;
                
            }
        </script>
       
       <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p>
               <form action="" method="get">
                    <input id="new-task" name='task' type="text" value="<?php if(isset($inp_val)) echo $inp_val;?>">
                    <input type='submit' value="<?php if(isset($btn_val)) echo $btn_val; else   echo "ADD"?>" name='<?php if(isset($btn_val)) echo $btn_val; else   echo "ADD"?>'></input>
                </form>
            </p>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
                <?php foreach($_SESSION['incomplete'] as $key=> $val){?>
                <li>
                    
                    <input type="checkbox" onclick="transfer(this.value)" value="<?php echo($key); ?>">
                    <label><?php echo $val;?></label>
                    <input type="text">
                    <a class="edit" href="?act=edit&key=<?php echo $val;?>&arr=incomplete">Edit</a>
                    <a class="delete"  href="?action=incomplete&key=<?php echo $val; ?>">Delete</a>
                </li>
                <?php } ?>
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
            <?php foreach($_SESSION['complete'] as $key=>$val){?>
                <li>
                <input type="checkbox" checked value="<?php echo($key); ?>" onclick="transfer2(this.value)">
                    <label><?php echo $val;?></label>
                    <input type="text">
                    <a class="edit" href="?act=edit&key=<?php echo $val;?>&arr=complete">Edit</a>
                    <a class="delete" href="?action=complete&key=<?php echo $val; ?>">Delete</a>
                </li>
                <?php } ?>
            </ul>
        </div>


               <?php //session_destroy(); ?>
    </body>
</html>