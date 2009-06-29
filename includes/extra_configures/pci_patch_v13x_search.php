<?php
if (isset($_GET['keyword']) && $_GET['keyword'] != '')
{
  $count =  substr_count($_GET['keyword'], '"');
  if ($count == 1)
  {
    if(substr(stripslashes(trim($_GET['keyword'])), 0, 1) == '"')
    {
      $_GET['keyword'] .= '"';
    }
  }
  $_GET['keyword'] = stripslashes($_GET['keyword']);
}
