--TEST--
Test stack traces (level2, text)
--INI--
xdebug.default_enable=1
xdebug.profiler_enable=0
xdebug.auto_trace=0
xdebug.trace_format=0
xdebug.dump_globals=0
xdebug.show_mem_delta=0
xdebug.collect_vars=0
xdebug.collect_params=2
xdebug.collect_returns=0
xdebug.show_local_vars=0
--FILE--
<?php
function foo( $a ) {
    for ($i = 1; $i < $a['foo']; $i++) {
		poo();
    }
}

$c = new stdClass;
$c->bar = 100;
$a = array(
    42 => false, 'foo' => 912124,
    $c, new stdClass, fopen( '/etc/passwd', 'r' )
);
foo( $a );
?>
--EXPECTF--
Fatal error: Call to undefined function poo() in /%s/stacktrace%s.php on line 4

Call Stack:
%w%f %w%d   1. {main}() /%s/stacktrace%s.php:0
%w%f %w%d   2. foo(array(5)) /%s/stacktrace%s.php:14
