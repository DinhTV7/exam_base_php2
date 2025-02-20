<?php

namespace App\Models;

use PDO;

class Product extends BaseModel
{
    protected $table = 'products';

    public function getAllProducts()
    {
        $sql = "SELECT products.*, categories.name as category_name
                FROM products
                JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}