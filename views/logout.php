<?php
setcookie("jwt", null, -1);
die(header("Location: /"));
