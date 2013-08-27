<?php
/*
 * Copyright (C) 2013 OHRI 
 * This file is part of PortraitCaption.
 * 
 * PortraitCaption is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * PortraitCaption is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with PortraitCaption.  If not, see <http://www.gnu.org/licenses/>.
*/

$name = $_POST["name"];
$title = $_POST["title"];
$error = False;

if(isset($_POST["pdf"]))
    $filearg = "--pdf";
else if(isset($_POST["png"]))
    $filearg = "--png";
else{
    echo "For some reason neither PDF or PNG was specified; this shouldn't happen. Using PDF.<br>";
    $filearg = "--pdf";
}
$outfilename = str_replace(" ","",$name).".".str_replace("-","",$filearg);

if($_FILES['image']['error'] != 0){
    echo "You must select a file.<br>";
    $error = True;
}else{
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fi,$_FILES['image']['tmp_name']);
    if(split('/',$mime)[0] != "image"){
        echo "The file must be an image.<br>";
        $error = True;
    }
}
if($name == null){
    echo "Name cannot be blank.<br>";
    $error = True;
}
if($title == null){
    echo "Caption/Title cannot be blank.<br>";
    $error = True;
}

if($error == False){
    $wd = getcwd();
    chdir("/tmp");
    exec("python ".$wd."genimage.py \"".$_FILES['image']['tmp_name']."\" \"".$name."\" \"".$title."\" ".$filearg);
    chdir($wd);
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fi,"/tmp/".$outfilename);
    header('Content-Type: '.$mime);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"".$outfilename."\"");
    readfile("/tmp/".$outfilename);
}

?>
<html>
<body>
<a href="/PortraitCaption">Go back</a>
</body>
</html>
