<<<<<<< HEAD
<script language="javascript" type="text/javascript">
/*<![CDATA[*/
if(typeof(console)=='object')
{
	console.group("Profilešanas izsaukumu steka atskaite");
<?php
foreach($data as $index=>$entry)
{
	list($proc,$time,$level)=$entry;
	$proc=CJavaScript::quote($proc);
	$time=sprintf('%0.5f',$time);
	$spaces=str_repeat(' ',$level*8);
	echo "\tconsole.log(\"[$time]{$spaces}{$proc}\");\n";
}
?>
	console.groupEnd();
}
/*]]>*/
=======
<script language="javascript" type="text/javascript">
/*<![CDATA[*/
if(typeof(console)=='object')
{
	console.group("Profilešanas izsaukumu steka atskaite");
<?php
foreach($data as $index=>$entry)
{
	list($proc,$time,$level)=$entry;
	$proc=CJavaScript::quote($proc);
	$time=sprintf('%0.5f',$time);
	$spaces=str_repeat(' ',$level*8);
	echo "\tconsole.log(\"[$time]{$spaces}{$proc}\");\n";
}
?>
	console.groupEnd();
}
/*]]>*/
>>>>>>> refs/remotes/origin/master
</script>
