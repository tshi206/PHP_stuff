<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload files demo</title>
</head>
<body>
<!-- enctype specifies how the form data should be encoded -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">Upload</button>
</form>
</body>
</html>