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
