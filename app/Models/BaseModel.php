<?php

namespace App\Models;

use PDO;
use PDOException;

class BaseModel
{
    protected $connection;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->connect();
    }

    // Kết nối database
    protected function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    // Lấy tất cả dữ liệu
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy dữ liệu theo ID
    public function find($id)
    {
        return $this->first([$this->primaryKey => $id]);
    }

    // Lấy dữ liệu có điều kiện
    public function where($conditions)
    {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $sql = "SELECT * FROM {$this->table} WHERE $whereClause";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một bản ghi duy nhất có điều kiện
    public function first($conditions)
    {
        $whereClause = implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $sql = "SELECT * FROM {$this->table} WHERE $whereClause LIMIT 1";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Chèn dữ liệu mới
    public function create($data)
    {
        $columns = implode(',', array_keys($data));
        $values = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    // Cập nhật dữ liệu theo ID
    public function update($id, $data)
    {
        $fields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $fields WHERE {$this->primaryKey} = :id";
        $data['id'] = $id;

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    // Xóa dữ liệu theo ID
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Thực hiện truy vấn SQL tùy chỉnh
    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
