<?php

require_once 'task.php';

$data = include 'in.php';

file_put_contents(
    'out.txt',
    var_export(testHierarchy($data), true)
);
