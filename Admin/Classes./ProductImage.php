<?php


class ProductImage
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductImageByProductId($product_id)
    {
        $statement = $this->connection->prepare('select * from product_images where product_id =:product_id');
        $statement->bindParam(':product_id', $product_id);

        $result = $statement->execute();

        if ($result) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function store($data)
    {
        $statement = $this->connection->prepare('insert into product_images(image_path,product_id) values (:image_path,:product_id)');
        $statement->bindParam(':image_path', $data['image_path']);
        $statement->bindParam(':product_id', $data['product_id']);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function deleteImageByProductId($product_id)
    {
        $getAllProducts = $this->getProductImageByProductId($product_id);

        foreach ($getAllProducts as $image) {

            $path = "../" . $image['image_path'];

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $statement = $this->connection->prepare('delete from product_images where product_id =:product_id');
        $statement->bindParam(':product_id', $product_id);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }
}