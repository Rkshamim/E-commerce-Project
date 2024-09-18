<?php

spl_autoload_register(function ($class) {
    require $class . '.php';
});

class Customer
{
    public $connection;


    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllCustomers()
    {
        $statement = $this->connection->prepare('Select * from customers');

        $result =  $statement->execute();

        if ($result) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function getCustomerById($id)
    {
        $statement = $this->connection->prepare('select * from customers where id=:id');
        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function store($data)
    {
        $image_path = '';
        $password =  password_hash($data['password'], PASSWORD_DEFAULT);

        if (isset($data['image']['name']) && $data['image']['name'][0] != '') {
            $image_path = $this->upload($data['image']);
        }

        $statement = $this->connection->prepare('insert into customers(first_name, last_name, email, image_path, password, role) values(:first_name ,:last_name,:email,:image_path, :password,:role)');
        $statement->bindParam(':first_name', $data['first_name']);
        $statement->bindParam(':last_name', $data['last_name']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $data['role']);
        $statement->bindParam(':image_path', $image_path);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function update($data, $id)
    {
        $image_path = '';

        $sql = 'update customers set first_name=:first_name ,last_name=:last_name,email=:email where id =:id';

        if (isset($data['image']['name']) && $data['image']['name'] != '') {
            $this->deleteImageByCustomerId($id);
            $sql = 'update customers set first_name=:first_name ,last_name=:last_name,email=:email, image_path=:image_path where id =:id';
            $image_path = $this->upload($data['image']);
        }

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':first_name', $data['first_name']);
        $statement->bindParam(':last_name', $data['last_name']);
        $statement->bindParam(':email', $data['email']);
        if ($image_path != '')
            $statement->bindParam(':image_path', $image_path);

        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $statement = $this->connection->prepare('delete from customers where id =:id');
        $statement->bindParam(':id', $id);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    public function upload($data)
    {
        $randomString =  md5(rand(0, 20));

        $ext = pathinfo($data['name'], PATHINFO_EXTENSION);

        $tmp_name = $data['tmp_name'];

        $dir = dirname(__DIR__) . "//uploads/" . $randomString . '.' . $ext;

        $semi_directory = "uploads/" . $randomString . '.' . $ext;

        move_uploaded_file($tmp_name, $dir);

        return $semi_directory;
    }

    public function deleteImageByCustomerId($customer_id)
    {
        $customer = $this->getCustomerById($customer_id);

        $path = "../" . $customer['image_path'];

        if (file_exists($path)) {
            unlink($path);

            return true;
        }

        return false;
    }

    public function login($data)
    {
        $statement = $this->connection->prepare('select * from customers where email=:email');
        $statement->bindParam(':email', $data['email']);

        $result = $statement->execute();

        if ($result) {
            $customer =  $statement->fetch(PDO::FETCH_ASSOC);

            if ($customer) {
                $passwordVerify = password_verify($data['password'], $customer['password']);

                if ($passwordVerify) {
                    return $customer;
                }else {
                    return false;
                }
            }

            return false;
        }

        return null;
    }

    public function logout()
    {
        
    }

    public function register($data)
    {
        $image_path = '';
        $password =  password_hash($data['password'], PASSWORD_DEFAULT);

        $role = 0;

        $statement = $this->connection->prepare('insert into customers(first_name, last_name, email, image_path, password, role) values(:first_name ,:last_name,:email,:image_path, :password,:role)');
        $statement->bindParam(':first_name', $data['first_name']);
        $statement->bindParam(':last_name', $data['last_name']);
        $statement->bindParam(':email', $data['email']);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':role', $role);
        $statement->bindParam(':image_path', $image_path);

        $result = $statement->execute();

        if ($result) {
            return true;
        }

        return false;
    }
}