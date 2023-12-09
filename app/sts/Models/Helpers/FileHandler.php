<?php

namespace Sts\Models\Helpers;

use Exception;

class FileHandler
{
    private string $targetDir = IMG_FLSYSTEM;
    private string $targetFile;
    private string $fileType;
    private string $finalPath;
    private string $tmp_path;
    private bool $uploadOk = false;

    public function __construct(string $fileName, string $fileType, string $originalFileName, string $tmp_path)
    {
        $this->targetFile = $this->targetDir . $fileName . "." . $fileType;
        $this->fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        $this->tmp_path = $tmp_path;
    }

    private function checkFileType()
    {
        if (in_array($this->fileType, ["jpg", "jpeg", "png"])) {
            return true;
        }
        throw new Exception("Tipo de arquivo não suportado", 1);
    }

    private function checkIfFileExists()
    {
        if (file_exists($this->targetFile)) {
            throw new Exception("Arquivo já cadastrado no sistema", 2);
        }
        return true;
    }

    private function checkFilePersistence()
    {
        if (move_uploaded_file($this->tmp_path, $this->targetFile)) {
            return true;
        }
        throw new Exception("Não foi possível cadastrar o arquivo no sistema", 3);
    }

    private function errorHandler()
    {
        try {
            $this->checkFileType();
            $this->checkIfFileExists();
            $this->checkFilePersistence();

            $this->uploadOk = true;
        } catch (Exception $err) {
            return $err->getMessage();
        }
    }

    public function fileUpload()
    {
        $this->errorHandler();
        if ($this->uploadOk) {
            return "success";
        }
        return $this->errorHandler();
    }

}
