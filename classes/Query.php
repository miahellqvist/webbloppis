<?php

class Query{

	function chooseCategory()
		{
			$query = ("SELECT * FROM category");
			 return $this->query = $query;

		}

		function chooseSubCategory()
		{
			$query = ("SELECT * FROM subcategory");
			 return $this->query = $query;

		}

	function getUserid()
		{

			$query = ("SELECT user_id FROM user WHERE username = $username LIMIT 1");
			 return $this->query = $query;

		}	

		//Hämtar all data i product-tabellen (annonsen)
		function showProduct()
		{
			$query = ("SELECT * FROM product");
			return $this->query = $query;
		}

		//Hämtar all data i product-tabellen (annonsen) samt deklarerar bildens namn som GET-id
		function showAddProduct()
		{
			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				$query = ("SELECT * FROM product
							WHERE product.image_name='$id'");
				return $this->query = $query;
			}
		}

		//Hämtar ut säljarens e-post.
		function getUsermail($dbcon)
		{
			$id=$_GET['id'];
			$query =("SELECT user.email FROM user WHERE user.id = '$id'");
			return $this->query = $query;
		}
}