<?php

require_once('index.view.php');

//EXCLUIR
if(isset($_GET['id']))
{
    $id = addslashes($_GET['id']);
    $pessoa->excluir($id);
    header("location: index.php");
} 





        
        

