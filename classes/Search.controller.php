<?php

class Search {

	public static function searchCheck(){
		require_once('Upload.model.php');
		$data['states'] = UploadModel::getStates();
		$data['categories'] = UploadModel::getCategories();
		$data['template'] = 'searchForm.html';
		return $data;
	}

	public static function searchResult(){
	
		require_once('Search.model.php');
		$data = array();
		if(isset($_POST['searchProduct'])) {
		$searchProduct=$_POST['searchField'];
		$category=$_POST['category'];
		$state=$_POST['state'];
		$sort=$_POST['sort'];
		$result = SearchModel::searchQuery($searchProduct,$category,$state,$sort);

			try{
	  			$result = SearchModel::getSearchResult($searchProduct,$category,$state,$sort);
	  			$data['template'] = 'searchResult.html';
	  			$data['products'] = $result;
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