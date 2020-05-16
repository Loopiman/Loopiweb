<?php
if(file_exists('./admin/lib/php/dbConnect.php')){
    require './admin/lib/php/dbConnect.php';
    require './admin/lib/php/autoload.php';  
}
else if(file_exists('./lib/php/dbConnect.php')){
    require './lib/php/dbConnect.php';
    require './lib/php/autoload.php';  
}
