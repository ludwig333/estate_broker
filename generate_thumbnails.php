<?php
$env = file(".env");
$DB_DATABASE=false;
$DB_USERNAME=false;
$DB_PASSWORD=false;
$DB_HOST=false;
foreach($env as $conf) {
  if (explode( "=", $conf)[0] == "DB_DATABASE") {
    $DB_DATABASE = trim(explode( "=", $conf)[1]);
  }
  if (explode( "=", $conf)[0] == "DB_USERNAME") {
    $DB_USERNAME = trim(explode( "=", $conf)[1]);
  }
  if (explode( "=", $conf)[0] == "DB_PASSWORD") {
    $DB_PASSWORD = trim(explode( "=", $conf)[1]);
  }
  if (explode( "=", $conf)[0] == "DB_HOST") {
    $DB_HOST = trim(explode( "=", $conf)[1]);
  }
}

$db = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);

$images= glob("public/uploads/media/*.jpg");
foreach ($images as $filename) {

   //resize the image
   $path_parts = pathinfo($filename);
   $imagePath = "$filename";
   $destPath = $path_parts['dirname']."/".$path_parts['filename']."_thumbnail.".$path_parts['extension'];
   $NewImageWidth = 200;
   $NewImageHeight = 200;
   $Quality = 50;
   if (file_exists($destPath) || strpos($imagePath,"_thumbnail.jpg")) {
     continue;
   }
   if(resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality)){
     $sql = "UPDATE property SET image_thumbnail='".$path_parts['filename']."_thumbnail.".$path_parts['extension']."' WHERE image='".$path_parts['basename']."'";
     mysqli_query($db, $sql);
     echo $filename.' resize Success!<br />';
   }
   // echo "$filename\n";die();
}

function resizeImage($SrcImage,$DestImage, $MaxWidth,$MaxHeight,$Quality)
{
    list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);

    //if you dont want to rescale image

    $NewWidth=$MaxWidth;
    $NewHeight=$MaxHeight;
    $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);
    $image = imagecreatefromjpeg($SrcImage);
    // Resize Image
    if(imagecopyresampled($NewCanves, $image,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
     {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}
