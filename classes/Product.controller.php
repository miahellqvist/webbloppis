<?php

class Product{


  	public static function singleProduct($url_parts) {
  		require_once('Product.model.php');
  		
  		if (count($url_parts) > 0) {
  			$id = $url_parts[0];

  			$result = ProductModel::getSingleProduct($id);
  			if($result) {
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