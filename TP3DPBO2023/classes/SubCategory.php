<?php

class SubCategory extends DB
{
    function getSubCategoryFood()
    {
        $query = "SELECT * FROM t_subcategory_food";
        return $this->execute($query);
    }

    function getSubCategoryFoodbyID($id)
    {
        $query = "SELECT * FROM t_subcategory_food WHERE id_subcategory_food=$id";
        return $this->execute($query);
    }

    function searchFood($keyword)
    {
        // ...
    }

    function addData($data)
    {
 
        $name_subcategory_food = $data['name_subcategory_food'];
        // Get all the submitted data from the form
        $query = "INSERT INTO t_subcategory_food VALUES('', '$name_subcategory_food')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        // ...
    }

    function deleteData($id)
    {
        // ...
    }
}
