<?php
namespace App\Classes;

use Intervention\Image\Facades\Image;

Class imageUrl{

    public $file;

    function __construct($file) {
        $this->file = $file;
    }

    public function upload($path, $small = 0) : string
    {
        $path .= uniqid() . '.' . $this->file->getClientOriginalExtension();
        $small == 0 ? $img = Image::make($this->file) : Image::make($this->file)->resize(40,40);
        $img->save(public_path($path));

        return 'public/'.$path;
    }

    public function pictureUpload() : string
    {
        return $this->upload('upload/');
    }

    public function smallPictureUpload() : string
    {
        return $this->upload('upload/kicsi/', 1);
    }

    public function getPictureName() : string
    {
        return "../" . $this->file;
    }

}
