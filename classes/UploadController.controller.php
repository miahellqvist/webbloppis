<?php

class UploadController {

public static function upload() {
		require_once('Upload.model.php');
		$data['states'] = UploadModel::getStates();
		$data['categories'] = UploadModel::getCategories();
		$data['subcategories'] = UploadModel::getSubCategories();
		$data['template'] = 'upload.html';
		return $data;
	}

	  	public static function completeUpload() {
  		require_once('Upload.model.php');
  		$data = array();
  		if(isset($_POST['createProduct'])) {
  			$title = $_POST['title'];
  			$text = $_POST['text'];
  			$price = $_POST['price'];
  			$file = $_FILES['file'];
  			$category = $_POST['category'];
  			$subcategory = $_POST['subcategory'];
  			$state = $_POST['state'];
  			try{
  				$result = UploadModel::upload($title,$text,$price,$file,$category,$subcategory,$state);
  				$data['redirect'] = '?/User/home';
  			}catch (Exception $e) {
  				$data['error'] = $e->getMessage();
  				$data['template'] = 'uploadError.html';
  			}
  			
		} else {
			$data['redirect'] = 'uploadError.html';
			}
		return $data;
	  }
}