<?php

class Search {

	public static function searchCheck(){
		require_once('Upload.model.php');
		require_once('User.model.php');
		$data['states'] = UserModel::getStates();
		$data['categories'] = UploadModel::getCategories();
		$data['template'] = 'searchForm.html';
		return $data;
	}

	public static function searchResult(){
	
		require_once('Search.model.php');
		require_once('Upload.model.php');
		require_once('User.model.php');
		$data = array();
		if(isset($_POST['searchProduct'])) {
		$searchProduct=$_POST['searchField'];
		$category=$_POST['category'];
		$state=$_POST['state'];
		$sort=$_POST['sort'];
		$query = SearchModel::searchQuery($searchProduct,$category,$state,$sort);

			try{
	  			$searchresult = SearchModel::getSearchResult($searchProduct,$category,$state,$sort);
	  			$data['template'] = 'searchResult.html';
	  			$data['products'] = $searchresult;
	  			$data['states'] = UserModel::getStates();
				$data['categories'] = UploadModel::getCategories();
	  		}catch (Exception $e) {
	  			$data['error'] = $e->getMessage();
	  			$data['template'] = 'error.html';
	  			$data['states'] = UserModel::getStates();
				$data['categories'] = UploadModel::getCategories();
	  		}
  			
		} else {
			$searchCheck = Self::searchCheck();
			$data['redirect'] = 'error.html';
			}
		return $data;
	  }

	
}