<!--
    Copyright (C) 2013 OHRI 

    This file is part of PortraitCaption.

    PortraitCaption is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    PortraitCaption is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with PortraitCaption.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
<head>
    <title>PortraitCaption</title>
    <style type="text/css">
    span.bottomtext{
        font-size:0.7em;
        text-align:center;
        display:block;
    }
    .exampleimg{
        height:50%;
        width:auto;
        display: block;
    }
    </style>
</head>
<body>
<h1>PortraitCaption Web Interface</h1>
This application will create an image that looks like this:<br><br>
<img src="images/JohnBrooks.png" class="exampleimg"><br><br>
<form action="genimage.php" enctype="multipart/form-data" method="post">
<b>Image: </b><input type="file" name="image"><br><br>
<b>Name: </b><input type="text" name="name" value="John Brooks"><br><br>
<b>Caption/Job title: <input type="text" name="title" value="Research Assistant"></b><br>
<br>
<input type="submit" name="pdf" value="Generate PDF">
<input type="submit" name="png" value="Generate PNG">
<br>
<b>Warning: Colors may not display correctly in Adobe Reader.</b>
<br><br>

<span class="bottomtext"><a href="https://github.com/Frogging101/PortraitCaption">PortraitCaption on GitHub</a><br>
&#169; 2013 OHRI | Created by John Brooks<br><br>

<a href=http://www.gnu.org/licenses/gpl.html><img src="images/gplv3-88x31.png" alt="Licensed under GPLv3"></a>
</form>
</body>
</html>
