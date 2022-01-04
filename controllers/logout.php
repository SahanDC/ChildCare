<?php
session_start();
session_destroy();

header("Location: http://localhost/child-care/index.php");
