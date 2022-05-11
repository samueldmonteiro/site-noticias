<?php

namespace Src\Upload;

use Exception;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUpload{

	protected $alert;
    public $imageNameFile;

	public function __construct($imageInfo, $width, $heigth, $localUpload){
		$imageName = $imageInfo['name'];
		$imageType = $imageInfo['type'];
		$tempLocal = $imageInfo['tmp_name'];
		$imageSize = $imageInfo['size'];

		// maxSize = 8mb
		if(!$this->checkSize($imageSize, 8388608)){
            $this->setAlert("Erro: Arquivo Muito Grande!");
			return false;
		}

		if(!$this->checkImageExtension($imageName)){
			$this->setAlert("Erro: Apenas Imagens!");
			return false;
		}

		if(!$this->isImage($imageType)){
			$this->setAlert("Erro: Apenas Imagens!");
			return false;
		}

		$imageName = $this->saveImage($tempLocal, $width, $heigth, $localUpload);
		$this->imageNameFile = $imageName;

	}

	public function isImage($type){
		if(in_array($type, ['image/jpg', 'image/png', 'image/jpeg'])){
			return true;
		}else{
			return false;
		}
	}

	public function checkImageExtension($fileName){
		$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
		if(in_array($fileExtension, ['png', 'jpg','jpeg'])){
			return true;
		}else{
			return false;
		}
	}

	public function checkSize($fileSize, $maxSize){
		if($fileSize > $maxSize){
			return false;
		}else{
			return true;
		}
	}

	public function saveImage($file, $width, $heigth, $localUpload){
		$newImageName = md5(time().rand(0,999)) . ".jpg";
		$newImage = $this->resizeImage($file, $width, $heigth);

        if($newImage){
            $fullPath = $localUpload . $newImageName;
		    $newImage->save($fullPath, 100);
			return $newImageName;
        }else{
            $this->setAlert("Erro: Apenas Imagens!");
        }
	}

	public function resizeImage($file, $width, $heigth){
		try{
            $image = Image::make($file);
			$image->resize($width, $heigth);
            return $image;
        }catch(Exception $e){
            return false;
        }
	}

	public function getAlert(){
		return $this->alert;
	}

	public function setAlert($alert){
		$this->alert = $alert;
	}
}