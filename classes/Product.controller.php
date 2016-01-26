<?php

class Product{

//Om användaren klickar på en produktbild visas hela produktannonsen
  	public static function singleProduct($url_parts) {
  		require_once('Product.model.php');
      require_once('User.model.php');
      require_once('Upload.model.php');
  		
  		if (count($url_parts) > 0) {
  			$id = $url_parts[0];

  			$result = ProductModel::getProductData($id);
  			if($result) {
          
            $data['template'] = 'singleProduct.html';
            $data['product'] = $result;
            $data['states'] = UserModel::getStates();
            $data['categories'] = UploadModel::getCategories();
          } else {
  				  $data['template'] = 'error.html';
            $data['states'] = UserModel::getStates();
            $data['categories'] = UploadModel::getCategories();
  			}

  		} else {
  			$data['redirect'] = '?/User/home';
  		}
  		return $data;
  	}

//Om användaren klickar på en kategori i annonsen visas alla produkter i den kategorin
  	public static function productCategory($url_parts){
  		require_once('Product.model.php');
      require_once('User.model.php');
      require_once('Upload.model.php');

  		if (count($url_parts) > 0) {
  			$category_id=$url_parts[0];

  			$result=ProductModel::getProductsCategory($category_id);
  			if ($result) {
  				$data['template'] = 'index.html';
          $data['states'] = UserModel::getStates();
          $data['categories'] = UploadModel::getCategories();
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['category_name'];
            $data['rubrik'] = 'Kategori:';
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på en underkategori i annonsen visas alla produkter i den underkategorin
  	public static function productSubcategory($url_parts){
  		require_once('Product.model.php');
      require_once('User.model.php');
      require_once('Upload.model.php');

  		if (count($url_parts) > 0) {
  			$subcategory_id=$url_parts[0];

  			$result=ProductModel::getProductsSubcategory($subcategory_id);
  			if ($result) {
  				$data['template'] = 'index.html';
          $data['states'] = UserModel::getStates();
          $data['categories'] = UploadModel::getCategories();
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['subcategory_name'];
            $data['rubrik'] = 'Underkategori:';
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på ett län i annonsen visas alla produkter i det länet
  	public static function productState($url_parts){
  		require_once('Product.model.php');
      require_once('User.model.php');
      require_once('Upload.model.php');

  		if (count($url_parts) > 0) {
  			$state_id=$url_parts[0];

  			$result=ProductModel::getProductsState($state_id);
  			if ($result) {
  				$data['template'] = 'index.html';
          $data['states'] = UserModel::getStates();
          $data['categories'] = UploadModel::getCategories();
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['state_name'];
            $data['rubrik'] = 'Län:';
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på säljarnamnet i annonsen visas alla produkter från den säljaren
  	public static function productUser($url_parts){
  		require_once('Product.model.php');
      require_once('User.model.php');
      require_once('Upload.model.php');
      $data=array();

  		if (count($url_parts) > 0) {
  			$user_id=$url_parts[0];

  			$result=ProductModel::getProductsUser($user_id);
  			if ($result) {
  				$data['template'] = 'userProfile.html';
          $data['states'] = UserModel::getStates();
          $data['categories'] = UploadModel::getCategories();
          $data['user_id']=$user_id;
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['name'];
  				}
  			}
  		}return $data;
  	}

//Visar Mina produkter på första sidan om man är inloggad
    public static function myProducts() {
      require_once('Product.model.php');
      require_once('User.model.php');

      $data=array();

      try{
        $result=ProductModel::getMyProducts();
        if ($result) {
          $data['template'] = 'myProfile.html';
          $data['products'] = $result;
        } 
      }
      catch(Exception $e){
        $data['error']= $e->getMessage();
        $data['template']='error.html';
      }
     
      return $data;
    }

//Uppdatera annons
    public static function personalProduct($url_parts){
      require_once('User.model.php');
      require_once('Upload.model.php');
      require_once('Product.model.php');
      $data=array();
      
        if (count($url_parts) > 0) {
          $id=$url_parts[0];
            if(isset($_SESSION['user'])){ 
              $user_id=$_SESSION['user']['user_id'];
              $result=ProductModel::getPersonalProduct($id, $user_id);
              if ($result) {
                $data['states'] = UserModel::getStates();
                $data['categories'] = UploadModel::getCategories();
                $data['subcategories'] = UploadModel::getSubcategories();
                $data['user'] = UserModel::getPersonalData();
                $data['product'] = $result;
                $data['template']='personalProduct.html';
              }
            }else
            $data['redirect']='?/User/home';
        }
        return $data;
    }

//Uppdatera annons
      public static function completePersonalProductUpdate(){
      require_once('Product.model.php');
      $data=array();
        if(isset($_POST['updateProduct'])){
          $title = $_POST['title'];
          $state = $_POST['state'];
          $price = $_POST['price'];
          $text = $_POST['text'];
          $category = $_POST['category'];
          $subcategory = $_POST['subcategory'];
          $id = $_POST['product_id'];
        
          try{
            $result=ProductModel::updatePersonalProduct($title,$text,$price,$category,$subcategory,$state,$id);
            $data['redirect'] = '?/Product/myProducts';
          }
          catch(Exception $e){
            $data['error']= $e->getMessage();
            $data['template']='error.html';
          }
        }
        else {
          $data['redirect'] = '?/User/personalProduct';
        }
      return $data;
    }

    public static function completeDeleteProduct() {
      require_once('Product.model.php');
      $data=array();

      if (isset($_POST['deleteProduct'])) {
        $id = $_POST['product_id'];

        try{
          $result=ProductModel::deleteProduct($id);
          $data['products']=ProductModel::getMyProducts();
          $data['redirect'] = '?/Product/myProducts';
        }
        catch(Exception $e){
          $data['error']= $e->getMessage();
          $data['template']='error.html';
        }
      }
      
      else {
        $data['redirect'] = '?/User/home';
      }
      return $data;
    }
}
