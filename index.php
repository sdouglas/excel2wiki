<!--
Copyright (c) 2010 Shawn M. Douglas (shawndouglas.com)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
-->

<?php
echo "<html>
<head><title>excel2wiki.net | Excel xls to wiki copy and paste converter for wikipedia and mediawiki</title></head>
<body><h1>Copy & Paste Excel-to-Wiki Converter</h1>
<form action='index.php' method='post'><textarea name='data' rows='10' cols='50'></textarea><br><input type='submit' /><input type='checkbox' name='header' checked='checked'><small>format header</small></form>";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
echo "<small><b>Instructions:</b><br><br>
1. Copy & paste cells from Excel and click submit. Paste results into wikipedia or similar wiki.<br><br>
2. Output assumes {{table}} template exists, e.g.:<br> &nbsp;&nbsp;&nbsp;<i>border=\"1\" cellpadding=\"4\" cellspacing=\"0\" style=\"border:\#c9c9c9 1px solid; margin: 1em 1em 1em 0; border-collapse: collapse;\"</i><br><br>
3. Here is an example <a style='text-decoration:none; color:blue;' href=\"http://openwetware.org/wiki/User:ShawnDouglas\">table</a> and <a style='text-decoration:none; color:blue;' href=\"http://openwetware.org/wiki/Template:Table\">template</a>.<br><br>
You can also download the <a style='text-decoration:none; color:blue;' href=\"https://github.com/sdouglas/excel2wiki\">source code</a> or contact <a style='text-decoration:none; color:blue;' href='http://shawndouglas.com/'>me</a> via my gmail account: shawn.douglas)</small>";
} else {
echo "<h2>result</h2>\n<pre>\n{| {{table}}\n";
$lines = preg_split("/\n/", $_POST['data']);
$n = sizeof($lines);
foreach ($lines as $index => $value) {
 $line = preg_split("/\t/", $value);
 if ($index == 0 && isset($_POST['header'])) {
  foreach ($line as $val) {
   $val2 = rtrim($val);
   echo '| align="center" style="background:#f0f0f0;"|\'\'\'' . $val2 . '\'\'\'' . "\n";
  }
  echo "|-\n";
 } else {
  $data = implode("||", $line);
  echo '| ' . $data;
  if ($index < $n - 1) {
    if ($index % 2 == 0) {
      echo "|-\n";
    } else {
      echo "|- style=\"background:#f0f0f0;\"\n";
    }
  }
 }
}
echo "\n|}</pre>";
}

echo "</body></html>";

?>
