<?php

class TypeMenu extends DB
{
    function getTypeMenu()
    {
        $query = "SELECT * FROM t_type_menu";
        return $this->execute($query);
    }

    function getTypeMenuById($id)
    {
        $query = "SELECT * FROM t_type_menu WHERE id_type_menu=$id";
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
