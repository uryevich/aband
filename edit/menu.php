<?php
// check call from index, not self
  if(!defined("IS_ADMIN")) die;
// Menu items
$menu_items = array (
"Main" => "start",
"Galleries" => "gal",
"Files" => "file",
"Links" => "link",
"News" => "news",
// "Base" => "base"
);
echo '<ul class="menu">';
foreach ($menu_items as $link_name => $link_act) {
	echo '
<li class="menu">
<a class="menu" href="index.php?do='.$link_act.'">'.$link_name.'</a></li>';
}
echo '
<li class="menu">
<a class="menu" href="index.php?do=logout">Logout</a></li>
</ul>
';
?>
