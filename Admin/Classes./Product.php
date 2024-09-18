<?php

spl_autoload_register(function ($class) {
    require $class . '.php';
});

class Product
{
    public $connection;

    public $productImageClass;

    public function __construct($connection)
    {
        $this->connection = $connection;

        $this->productImageClass = new ProductImage($connection);
    }

    public function getAllProducts()
    {
        $statement = $this->connection->prepare('Select * from products');

        $result =  $statement->execute();

        if ($result) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function getProductById($id)
    {
        $statement = $this->connection->prepare('select * from products where id=:id');
        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function store($data)
    {
        $statement = $this->connection->prepare('insert into products(name,short_description,description,price,quantity) values (:name,:short_description, :description, :price, :quantity)');
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':short_description', $data['short_description']);
        $statement->bindParam(':description', $data['description']);
        $statement->bindParam(':price', $data['price']);
        $statement->bindParam(':quantity', $data['quantity']);

        $result = $statement->execute();

        if ($result) {

            $lastIndex = $this->connection->lastInsertId();

            if (isset($data['image'])) {
                $this->upload($data['image'], $lastIndex);
            }

            return true;
        }

        return false;
    }

    public function update($data, $id)
    {
        $statement = $this->connection->prepare('update products set name =:name ,short_description=:short_description,description=:description,price=:price,quantity=:quantity where id =:id');
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':short_description', $data['short_description']);
        $statement->bindParam(':description', $data['description']);
        $statement->bindParam(':price', $data['price']);
        $statement->bindParam(':quantity', $data['quantity']);
        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {

            if (isset($data['image']['name']) && $data['image']['name'][0] != '') {
                $this->productImageClass->deleteImageByProductId($id);
                $this->upload($data['image'], $id);
            }

            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $statement = $this->connection->prepare('delete from products where id =:id');
        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function upload($data, $id)
    {
        for ($i = 0; $i < count($data['name']); $i++) {

            $randomString =  md5(rand(0, 20));

            $ext = pathinfo($data['name'][$i], PATHINFO_EXTENSION);

            $tmp_name = $data['tmp_name'][$i];

            $dir = dirname(__DIR__) . "//uploads/" . $randomString . '.' . $ext;

            $semi_directory = "uploads/" . $randomString . '.' . $ext;

            move_uploaded_file($tmp_name, $dir);

            $this->productImageClass->store(['image_path' => $semi_directory, 'product_id' => $id]);
        }
    }

    public function getAllProductsWithImages() {
        $sql = "select DISTINCT products.* , product_images.image_path from products inner join product_images on product_images.product_id = products.id  GROUP BY  product_images.product_id";

        $statement = $this->connection->prepare($sql);

        $result =  $statement->execute();

        if ($result) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    // public function getProductByIdWithImages($id)
    // {
    //     $statement = $this->connection->prepare('select DISTINCT products.* , product_images.image_path from products inner join product_images on product_images.product_id = products.id where products.id=:id  GROUP BY product_images.product_id ');
    //     $statement->bindParam(':id', $id);

    //     $result = $statement->execute();

    //     if ($result) {
    //         return $statement->fetch(PDO::FETCH_ASSOC);
    //     }

    //     return null;
    // }
}