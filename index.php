<!--
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
</head>
<body>
<h1>PortraitCaption Web Interface</h1>
This application will create an image that looks like this:<br><br>
<img src="JohnBrooks.png" width=25%><br><br><br>
<form action="genimage.php" enctype="multipart/form-data" method="post">
<b>Image: </b><input type="file" name="image"><br><br>
<b>Name: </b><input type="text" name="name" value="John Brooks"><br><br>
<b>Caption/Job title: <input type="text" name="title" value="Research Assistant"></b><br>
<br>
<input type="submit" name="pdf" value="Generate PDF">
<input type="submit" name="png" value="Generate PNG">
</form>
</body>
</html>
