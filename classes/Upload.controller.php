<?php

class UploadController {

//Om användaren klickar på "Lägg upp annons" skickas användaren till annonsformuläret
    public static function upload() {
        require_once('Upload.model.php');
        require_once('User.model.php');
        $data['states'] = UserModel::getStates();
        $data['categories'] = UploadModel::getCategories();
        $data['subcategories'] = UploadModel::getSubCategories();
        $data['user'] = UserModel::getPersonalData();
        $data['template'] = 'upload.html';
        return $data;
      }


//Skickar produktinformationen från annonsformuläret till upload
    public function completeUpload() {
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
          $data['redirect'] = '?/Product/myProducts';
        }catch (Exception $e) {
          $data['template'] = 'error.html';
          $data['error'] = $e->getMessage();
        }
        return $data;
    } else {
      $data['template'] = 'error.html';
      return $data;
      }
    
    }

}