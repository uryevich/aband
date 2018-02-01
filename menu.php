<table align="center" border="0" width="100%" cellpadding="1" cellspacing="0">
<tr>
<td align="center"><a class="text" href="/." title="Go to Main page"><u>Abandoned</u></a></td>
<?php
if (isset($_ENV["REQUEST_URI"])) { $now_file = substr($_ENV["REQUEST_URI"], 1); }
else { $now_file = substr($_SERVER["SCRIPT_NAME"], 1); }
$tip=array (
"about.php","Who?","- About -",
"news.php","What's up?","- News -",
"trips.php","Trips photos","- Trips -",
"texts.php","Recomended Litrature","- Texts -",
"linx.php","Other Industrial Related Sites","- Links -",
"thanx.php","Thanks to peoples","- Thanks -",
// "gbook.php","Have some words?","- G book -",
// "forum.php","Discus the theme!","- Forum -"
);
$a1='
<td>
   <table align="center" border="0" bgcolor="#747687"  cellpadding="2" cellspacing="0" width="100%">
        <tr>
        <td>
        <table align="center" border="0" bgcolor="#000017" cellpadding="2" cellspacing="0" width="100%">
                <tr>
                <td align="center" class="link">
';
$a2='
                </td>
                </tr>
        </table>
        </td>
        </tr>
   </table>
</td>
';
$b1='
<td>
   <table align="center" border="0" bgcolor="#747687"  cellpadding="2" cellspacing="0" width="100%">
        <tr>
        <td align="center" class="link">
        <font color="#dfdfdf">';
$b2='   </font>
        </td>
        </tr>
   </table>
</td>
';
$q=count ($tip);
   for ($n=0; $n<=($q/3)-1; $n++) {
      if ($now_file!=$tip[$n*3]) {
      echo $a1.'
<A href="'.$tip[$n*3].'" title="'.$tip[$n*3+1].'">'.$tip[$n*3+2].'</A>
'.$a2;
      }
      else {
      echo $b1.$tip[$n*3+2].$b2;
      }
   }
?>
</tr>
</table>