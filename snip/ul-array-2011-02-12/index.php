<?php //UL testsinclude "ul_tests.php";//Class main fileinclude "class_ul.php";//Test 1$xml = new ul($ul_str);$tree = $xml->levels();print_r($tree);//Test 2$xml = new ul($ul_str2);$tree = $xml->levels();print_r($tree);//Test 3$xml = new ul($ul_str3);$tree = $xml->levels();print_r($tree);?>