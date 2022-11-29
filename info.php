
<?php

class x { 
        var $a = 123;
        var $b = "BBB";
        function C () {print "C\n";}
        function D () {print "D\n";}
}

var_dump(get_class_methods("x"));
var_dump(get_class_vars("x"));