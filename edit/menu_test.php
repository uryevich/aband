<?php
// check call from index, not self
  if(!defined("IS_ADMIN")) die;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="./admin.css" type="text/css"/>
</head>
<body>
<?php
// Menu items
$menu_items = array (
"Main" => "start",
"Gallery" => "gal",
"Files" => "file",
"Links" => "link",
"News" => "news",
"Base" => "base"
);
echo '<ul class="menu">';
foreach ($menu_items as $link_name => $link_act) {
	echo '
<li class="menu">
<a href="index.php?go='.$link_act.'">'.$link_name.'</a></li>';
}
echo '
<li class="menu">
<a href="index.php?go=logout">Logout</a></li>
</ul>
<br/>
<br/>
<div>
<a href="self">A usual link here</a> And text.</div>
<p>
<a href="self">A usual link here</a> And text.</p>
';
?>
</body>
</html>