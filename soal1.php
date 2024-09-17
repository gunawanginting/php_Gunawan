<?php

$jml = $_GET['jml'];
echo "<table border=1>\n";
for ($a = $jml; $a > 0; $a--)
{

  $total = 0;
  for ($b = $a; $b > 0; $b--) 
  {
    $total += $b;
  }
  echo "<tr>";
  echo "<td colspan=\"$a\" style='text-align: center;'>Total: $total</td>";
  echo "</tr>";
  
  
  echo "<tr>\n";
  for ($b = $a; $b > 0; $b--)
  {
    echo "<td>$b</td>";
  }
  echo "</tr>\n";
}
echo "</table>";


?>
