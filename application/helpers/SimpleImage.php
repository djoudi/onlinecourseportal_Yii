<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SimpleImage {

	public $image;
	public $image_type;

	public function __construct($filename) {
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		switch($this->image_type) {
			case IMAGETYPE_JPEG:
				$this->image = imagecreatefromjpeg($filename);
				break;
			case IMAGETYPE_GIF:
				$this->image = imagecreatefromgif($filename);
				break;
			case IMAGETYPE_PNG:
				$this->image = imagecreatefrompng($filename);
				break;
		}
	}

	public function save($filename, $compression = 75, $permissions = null) {
		switch($this->image_type) {
			case IMAGETYPE_JPEG:
				imagejpeg($this->image, $filename, $compression);
				break;
			case IMAGETYPE_GIF:
				imagegif($this->image, $filename);
				break;
			case IMAGETYPE_PNG:
				imagepng($this->image, $filename);
				break;
			default:
				return false;
		}
		if( $permissions != null)
			return chmod($filename, $permissions);
		return true;
	}

	public function output() {
		switch($this->image_type) {
			case IMAGETYPE_JPEG:
				return imagejpeg($this->image);
			case IMAGETYPE_GIF:
				return imagegif($this->image);
			case IMAGETYPE_PNG:
				return imagepng($this->image);
		}
	}

	public function getWidth() {
		return imagesx($this->image);
	}

	public function getHeight() {
		return imagesy($this->image);
	}

	public function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width, $height);
	}

	public function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width, $height);
	}

	public function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resize($width, $height);
	}

	public function resize($width, $height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}

	public function destroy() {
		$result = imagedestroy($this->image);
		$this->image = null;
		$this->image_type = null;
		return $result;
	}
	
}
?>