<?php
function custom_error_handler($errno, $errstr, $errfile, $errline){
	show($errline,$errfile,$errstr);
}

function fatal_handler() {
    $err = error_get_last();
    $str = $err['message'];
    $line = $err['line'];
    $file = $err['file'];  
    show($line,$file,$str);
}

function show($line,$file,$str){
	$eline = $line;
	$efile = $file;
	$estr = $str;
	if($efile != ''){
		$x = file($efile);
		$line = $eline;
		$start = ($line > 1)? $line-2 : 0;
		$end = $line;
		echo "<hr>";
		echo "<div style='float:left;width:100%;'>";
		echo "<h2>Error : ".$estr."</h2>";
		echo "<h2>File : ".$efile."</h2>";
		echo "<div style='width:100%;font-size:28px;background-color:#2e2a2a;color:#fff;padding:15px;border:1px solid #fff; box-shadow:2px 3px 10px #fff;'>";
		
			for($i = $start; $i<$end ; $i++){
				if($i==$line-1){
					echo "<p style='padding:5px;box-shadow:0px 0px 30px #be7b7b;background-color:#c87575;color:#fff; font-weight:bold;'>".($i+1).".".(string)$x[$i]."</p>";
				}else{
					echo "<p>".($i+1).".".(string)$x[$i]."</p>";
				}
		}
		echo "</div>";
		echo "</div>";
 }
}

set_error_handler('custom_error_handler');
register_shutdown_function("fatal_handler");
error_reporting(0);
?>