<?php
    session_start(); 
    session_destroy(); 
   
   echo '<h4>You have cleaned session</h4>';
   header('Refresh: 2; URL = ../index.html	');
?>