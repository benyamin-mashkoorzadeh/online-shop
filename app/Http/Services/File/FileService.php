<?php

namespace App\Http\Services\File;

class FileService extends FileToolsService
{


    public function moveToPublic($file)
    {
        // St file
        $this->setFile($file);

        // Execute provider
        $this->provider();

        // Save file
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());

        return $result ? $this->getFileAddress() : false;
    }

    public function moveToStorage($file)
    {
        // St file
        $this->setFile($file);

        // Execute provider
        $this->provider();

        // Save file
        $result = $file->move(storage_path($this->getFinalFileDirectory()), $this->getFinalFileName());

        return $result ? $this->getFileAddress() : false;
    }


    public function deleteFile($filePath, $storage = false)
    {
        if ($storage) {
            unlink(storage_path($filePath));
            return true;
        }

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        else {
            return false;
        }
    }

}
