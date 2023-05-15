<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
  <?
  if (empty($_POST)) {
  ?>

  <div>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="">Загрузить image</label>
      <input type="file" name="img_file"><br>
      <label for="">Загрузить watermark</label>
      <input type="file" name="watermark_file"><br>
      <input type="submit" name="upload" value="Отправить">
      <input type="reset" value="Очистить">
      <!-- <input type="submit" name="reboot" value="reboot"> -->
    </form>
  </div>

  <?
  } else {

    if (isset($_POST["resize_send"])) {
      if (!empty($_POST["new_width"]) && !empty($_POST["new_height"])) {

        require_once("Watermark.php");

        $image = "img/upload/image.jpg";
        $watermark = "img/upload/watermark.png";
        $image_wt = new Watermark($image, $watermark, [400, 250]);

        $width = $_POST["new_width"];
        $height = $_POST["new_height"];

        $image_wt->setSizeImage($width, $height);
        $image_wt->showResizeImage();

        ?>

      <div>
        <form action="" method="POST" enctype="multipart/form-data">
          <label for="">Добавить еще одну watermark на новую image</label>
          <input type="submit" name="reboot" value="Добавить watermark еще на одну image">
        </form>
      </div>

      <?
      } else {
        ?>
          <div>
            <input type="button" value="Назад" onclick="window.history.back()" />
          </div>
        <?
      }
    } elseif ($_FILES && $_FILES["img_file"]["error"] == UPLOAD_ERR_OK && 
    $_FILES["watermark_file"]["error"] == UPLOAD_ERR_OK) {

      $target_image = "img/upload/image.jpg";
      move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_image);

      $target_watermark = "img/upload/watermark.png";
      move_uploaded_file($_FILES["watermark_file"]["tmp_name"], $target_watermark);

      require_once("Watermark.php");

      $image = "img/upload/image.jpg";
      $watermark = "img/upload/watermark.png";
      $image_wt = new Watermark($image, $watermark, [400, 250]);

      echo "<div>Ширина " . $image_wt->image_width . "px Высота: " . $image_wt->image_height . "px</div>";

      require_once("resize_form.html");

    } else { 
      ?>

      <div>
        <form action="" method="POST" enctype="multipart/form-data">
          <label for="">Вы не добавили image или watermark</label>
          <input type="submit" name="reboot" value="Добавить">
        </form>
      </div>

  <?
   }
  }

  if (isset($_POST["reboot"])) {
    header("Location: index.php");
  } 
  ?>

</body>
</html>



