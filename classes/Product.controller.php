<?php

class Product{

//Om användaren klickar på en produktbild visas hela produktannonsen
  	public static function singleProduct($url_parts) {
  		require_once('Product.model.php');
  		
  		if (count($url_parts) > 0) {
  			$id = $url_parts[0];

  			$result = ProductModel::getSingleProduct($id);
  			if($result) {
          if(isset($_SESSION['user'])){
            $data['template'] = 'singleProductOnline.html';
            $data['product'] = $result;
          }else
  				  $data['template'] = 'singleProduct.html';
  				  $data['product'] = $result;
  			} else {
  				  $data['template'] = 'registerError.html';
  			}

  		} else {
  			$data['redirect'] = '?/User/home';
  		}
  		return $data;
  	}

//Om användaren klickar på en kategori i annonsen visas alla produkter i den kategorin
  	public static function productCategory($url_parts){
  		require_once('Product.model.php');

  		if (count($url_parts) > 0) {
  			$category_id=$url_parts[0];

  			$result=ProductModel::getProductsCategory($category_id);
  			if ($result) {
  				$data['template'] = 'index.html';
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['category_name'];
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på en underkategori i annonsen visas alla produkter i den underkategorin
  	public static function productSubcategory($url_parts){
  		require_once('Product.model.php');

  		if (count($url_parts) > 0) {
  			$subcategory_id=$url_parts[0];

  			$result=ProductModel::getProductsSubcategory($subcategory_id);
  			if ($result) {
  				$data['template'] = 'index.html';
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['subcategory_name'];
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på ett län i annonsen visas alla produkter i det länet
  	public static function productState($url_parts){
  		require_once('Product.model.php');

  		if (count($url_parts) > 0) {
  			$state_id=$url_parts[0];

  			$result=ProductModel::getProductsState($state_id);
  			if ($result) {
  				$data['template'] = 'index.html';
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['state_name'];
  				}
  			}
  		}return $data;
  	}

//Om användaren klickar på säljarnamnet i annonsen visas alla produkter från den säljaren
  	public static function productUser($url_parts){
  		require_once('Product.model.php');

  		if (count($url_parts) > 0) {
  			$user_id=$url_parts[0];

  			$result=ProductModel::getProductsUser($user_id);
  			if ($result) {
  				$data['template'] = 'index.html';
  				$data['products'] = $result;
  				if(count($result)>0) {
  					$data['title'] = $result[0]['name'];
  				}
  			}
  		}return $data;
  	}
}