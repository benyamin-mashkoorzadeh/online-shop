<?php

namespace App\Http\Services\Image;


use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;


class ImageService extends ImageToolsService
{

    public function save($image)
    {
        // Set image
        $this->setImage($image);

        // Execute provider
        $this->provider();

        // Save
        $result = Image::read($image->getRealPath())->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

        return $result ? $this->getImageAddress() : false;
    }

    public function fitAndSave($image, $width, $height)
    {
        // Set image
        $this->setImage($image);

        // Execute provider
        $this->provider();

        // Save
        $result = Image::read($image->getRealPath())->resize($width, $height)->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

        return $result ? $this->getImageAddress() : false;

    }

    public function createIndexAndSave($image)
    {
        // Get data from config
        $imageSizes = Config::get('image.index-image-sizes');

        // Set image
        $this->setImage($image);

        // Set Directory
        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());

        // Set Name
        $this->getImageName() ?? $this->setImageName(time());
        $imageName = $this->getImageName();

        $indexArray = [];

        foreach ($imageSizes as $sizeAlias => $imageSize) {

            // Create and Set this size name
            $currentImageName = $imageName . '_' . $sizeAlias;
            $this->setImageName($currentImageName);

            // Execute provider
            $this->provider();

            // Save
            $result = Image::read($image->getRealPath())->resize($imageSize['width'], $imageSize['height'])->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

            if ($result)
                $indexArray[$sizeAlias] = $this->getImageAddress();
            else
                return false;
        }

        $images['indexArray'] = $indexArray;
        $images['directory'] = $this->finalImageDirectory;
        $images['currentImage'] = Config::get('image.default-current-index-image');

        return $images;
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath))
            unlink($imagePath);
    }

    public function deleteIndex($images)
    {
        $directory = public_path($images['directory']);

        $this->deleteDirectoryAndFiles($directory);
    }

    public function deleteDirectoryAndFiles($directory)
    {
        if (!is_dir($directory))
            return false;
        $files = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file))
                $this->deleteDirectoryAndFiles($file);
            else
                unlink($file);
        }
        $result = rmdir($directory);
        return $result;
    }

}
