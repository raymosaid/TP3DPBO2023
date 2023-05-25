<?php

class Food extends DB
{
    function getFoodJoin()
    {
        $query = "SELECT * FROM t_food JOIN t_subcategory_food ON t_food.id_subcategory_food=t_subcategory_food.id_subcategory_food JOIN t_type_menu ON t_food.id_type_menu=t_type_menu.id_type_menu ORDER BY t_food.id_food";

        return $this->execute($query);
    }

    function getFood()
    {
        $query = "SELECT * FROM t_food";
        return $this->execute($query);
    }

    function getFoodById($id)
    {
        $query = "SELECT * FROM t_food JOIN t_subcategory_food ON t_food.id_subcategory_food=t_subcategory_food.id_subcategory_food JOIN t_type_menu ON t_food.id_type_menu=t_type_menu.id_type_menu WHERE id_subcategory_food=$id";
        return $this->execute($query);
    }

    function searchFood($keyword)
    {
        // ...
    }

    function addData($data, $file)
    {
        // ...
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
