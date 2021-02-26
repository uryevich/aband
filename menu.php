<table align="center" border="0" width="100%" cellpadding="1" cellspacing="0">
<tr>
<td align="center"><a class="text" href="/." title="Go to Main page"><u>Abandoned</u></a></td>
<?php
if (isset($_ENV["REQUEST_URI"])) { $now_file = substr($_ENV["REQUEST_URI"], 1); }
else { $now_file = substr($_SERVER["SCRIPT_NAME"], 1); }
$menu_items=array (
"about.php","Who?","- About -",
"news.php","What's up?","- News -",
"trips.php","Trips photos","- Trips -",
"texts.php","Some text to read","- Texts -",
"linx.php","Other Industrial Related Sites","- Links -",
"thanx.php","Thanks to peoples","- Thanks -",
// "gbook.php","Have some words?","- G book -",
// "forum.php","Discus the theme!","- Forum -"
);

// menu container without border and link begin
$a1='
<td>
   <table align="center" border="0" bgcolor="#747687"  cellpadding="2" cellspacing="0" width="100%">
        <tr>
        <td>
        <table align="center" border="0" bgcolor="#000017" cellpadding="2" cellspacing="0" width="100%">
                <tr>
                <td align="center" class="link">
';
// menu container without border and link end
$a2='
                </td>
                </tr>
        </table>
        </td>
        </tr>
   </table>
</td>
';
// menu container with border start
$b1='
<td>
   <table align="center" border="0" bgcolor="#747687"  cellpadding="2" cellspacing="0" width="100%">
        <tr>
        <td align="center" class="link">
        <font color="#dfdfdf">';
// menu container with border end
$b2='   </font>
        </td>
        </tr>
   </table>
</td>
';
$q=count ($menu_items);
   for ($n=0; $n<=($q/3)-1; $n++) {
      if ($now_file!=$menu_items[$n*3]) {
      echo $a1.'
<a href="'.$menu_items[$n*3].'" title="'.$menu_items[$n*3+1].'">'.$menu_items[$n*3+2].'</a>
'.$a2;
      }
      else {
      echo $b1.$menu_items[$n*3+2].$b2;
      }
   }
?>
</tr>
</table>