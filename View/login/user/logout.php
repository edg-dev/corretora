<?php
session_start();
session_destroy();
header('Location:corretora\index.php');
exit();