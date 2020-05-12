<?php
//this file contains all meta function that can be caried out in multiple
//pages that do not need to be instantiated.

//clear all <> tags from entry
//security protocal
function encodeToHTML($str_val){
  $val = htmlentities($str_val);
  return $val;
}
//decode
function decodehtml($str_val){
  $val = html_entity_decode($str_val);
  return $val;
}
//redirect to sign up page when not logged in
//security protocol
function not_enrolled_redirect(){
  if (!isset($_SESSION['CURRENT_USER'])) {
    header('Location:'.ROOT.'/Signup');
  }
}

//redirect to sign up page when not logged in
//security protocol
function enrolled_redirect(){
  if (isset($_SESSION['CURRENT_USER'])) {
    header('Location:'.ROOT.'/account');
  }
}

function redirect_to_root($root){
    header('Location:'.ROOT.'');
}

function variations($array)
{

  if (empty($array)) return [];

  function traverse($array, $parent_ind)
  {
    $r = [];
    $pr = '';
    if (!is_numeric($parent_ind))
      $pr = $parent_ind . '-';
    foreach ($array as $ind => $el) {
      if (is_array($el)) {
        $r = array_merge($r, traverse($el, $pr . (is_numeric($ind) ? '' : $ind)));
      } else
                if (is_numeric($ind))
        $r[] = $pr . $el;
      else
        $r[] = $pr . $ind . '-' . $el;
    }
    return $r;
  }

  //1. Go through entire array and transform elements that are arrays into elements, collect keys
  $keys = [];
  $size = 1;
  foreach ($array as $key => $elems) {
    if (is_array($elems)) {
      $rr = [];
      foreach ($elems as $ind => $elem) {
        if (is_array($elem))
          $rr = array_merge($rr, traverse($elem, $ind));
        else $rr[] = $elem;
      }
      $array[$key] = $rr;
      $size *= count($rr);
    }
    $keys[] = $key;
  }

  //2. Go through all new elems and make variations
  $rez = [];
  for ($i = 0; $i < $size; $i++) {
    $rez[$i] = array();
    foreach ($array as $key => $value) {
      $current = current($array[$key]);
      $rez[$i][$key] = $current;
    }
    foreach ($keys as $key)
      if (!next($array[$key])) reset($array[$key]);
      else break;
  }

  return $rez;
}


// die(var_dump(variations($data)));


/**
 * generates the file name using 
 * UUID
 * @param ext The file extantion
 * @param targetdirectory The in reference to where it is to be called
 */
function genname($ext, $targetDirectory)
{
  $resp = array();
  $newname = $GLOBALS['moderator']->generateUUID();
  array_push($resp, $newname);
  $newname = $newname . "." . $ext;
  array_push($resp, $newname);
  $fullFileName = $targetDirectory . $newname;

  if (file_exists($fullFileName)) {
    genname($ext, $targetDirectory);
  } else {
    clearstatcache();

    return $resp;
  }
}