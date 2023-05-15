<?php 

require 'vendor/autoload.php';

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Imagine;

class Watermark 
{
    const SAVE_DIRECTORY = "img/upload"; // директория для сохранения image и watermark

    public $image; // image для изменения
    public $watermark; // водяной знак

    public $image_width; // новая ширина image
    public $image_height; // новая ширина image

    public $uploaded_image; // сохраненное image
    public $resized_image; // измененный размер image

    // $new_image_size = [width, height];
    public function __construct($image, $watermark, array $new_image_size)
    {
        $imagine = new Imagine();

        $this->image = $imagine->open($image);
        $this->watermark = $imagine->open($watermark);

        $this->image_width = $new_image_size[0];
        $this->image_height = $new_image_size[1];
        
        $this->applicationWatermark();
        $this->image->resize(new Box($this->image_width, $this->image_height));
        $this->saveImage();
        $this->showImage();
    }

    // нанесение watermark
    private function applicationWatermark()
    {
        // $image_size = $this->image->getSize();
        $watermark_size = $this->watermark->getSize();

        $this->watermark->resize(new Box($watermark_size->getWidth() / 2, $watermark_size->getHeight() / 2));

        // $bottomRight = new Point(
        //     $image_size->getWidth() - $watermark_size->getWidth(), 
        //     $image_size->getHeight() - $watermark_size->getHeight()
        // );

        $bottomRight = new Point(780, 600);

        $this->image->paste($this->watermark, $bottomRight);
    }

    // изменение размера image
    public function setSizeImage($width, $height)
    {
        $this->image->resize(new Box($width, $height));
        $this->saveResizeImage();
    }

    // сохранение image
    private function saveResizeImage()
    {
        $new_image_name = "resized_image_" . date("H_i_s_d_m_Y") . '.png';
        $save_path = __DIR__ . "/" . self::SAVE_DIRECTORY . "/$new_image_name";
        
        $this->image->save($save_path);
        $this->resized_image = self::SAVE_DIRECTORY . "/$new_image_name";
    }

    // вывод image на страницу
    public function showResizeImage()
    {
        echo "<img src='$this->resized_image'>";
    }

    // сохранение image
    private function saveImage()
    {
        $new_image_name = "uploaded_image_" . date("H_i_s_d_m_Y") . '.png';
        $save_path = __DIR__ . "/" . self::SAVE_DIRECTORY . "/$new_image_name";
        
        $this->image->save($save_path);
        $this->uploaded_image = self::SAVE_DIRECTORY . "/$new_image_name";
    }

    // вывод image на страницу
    private function showImage()
    {
        echo "<img src='$this->uploaded_image'>";
    }
}





