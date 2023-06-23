<?php
require_once('./support/int.php');
session_destroy();
header('Location: ./admin-login.php');
