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

		function insertNewProduct()
		{
			$title = $_POST['title'];
			$text = $_POST['text'];
			$price = $_POST['price'];
			$image = $_POST['image'];
			$category = $_POST['category'];
			$subcategory = $_POST['subcategory'];

			//för att få userid borde vi hämta den ur databasen först, sedan läsa in den igen 

			$query = ("INSERT INTO `text`, `price`, `image`, `category`, `subcategory`, `user_id`)  
					   VALUES ('$text', '$price', $price, $image, $category, $subcategory");
			return $this->query = $query;
		}


		function showProduct()
		{
			$query = ("SELECT * FROM product");
			return $this->query = $query;
		}
}