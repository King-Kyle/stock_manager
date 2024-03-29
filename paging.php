<?php
echo "<ul class='pagination'>";

// jump to first page
if ($page > 1) {
  echo "<li><a href='{$page_url}' title='Go to the first page.'>";
  echo "First";
  echo "</a></li>";
}
// calculate total pages
$total_pages = ceil($total_rows / $records_per_page);
// number of links to show
$range = 2;
// display links around current page
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;

for ($x = $initial_num; $x < $condition_limit_num; $x++) {
  // be sure x is greater than 0 and less than or equal to $total_pages
  if (($x > 0) && ($x <= $total_pages)) {
    // current page
    if ($x == $page) {
      echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
    } else {
      echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
    }
  }
}

// jump to last page
if ($page < $total_pages) {
  echo "<li><a href='" . $page_url . "page={$total_pages}' title='Last page is {$total_pages}.'>";
  echo "Last";
  echo "</a></li>";
}

echo "</ul>";
