<?php namespace App\Models;

use CodeIgniter\Model;

class Products_Model extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['produceCode', 'description', 'category', 'supplier', 'quantityInStock', 'bulkBuyPrice', 'bulkSalePrice', 'photo'];

    public function getProducts($prodCode = null)
    {
        if(!$prodCode)
            return $this->findAll();

        return $this->asArray()
                    ->where(['produceCode' => $prodCode])
                    ->first();
    }

    public function countProducts() 
    {
        $builder = $this->builder();
        $query = $builder->countAll();
        return $query;
    }

    public function getProductsByID($id)
    {
        return $this->asArray()
                    ->where(['produceCode' => $id])
                    ->first();
    }

    public function countIDs()
    {
        $builder = $this->builder();
        $query = $builder->where('produceCode', 'S20_%')->countAll();
        return $query;
    }

    public function delProd($prodCode)
    {
        $this->db->table('products')->where('produceCode', $prodCode)->delete();
        return;
    }

    public function findProducts($keyword)
    {
        $db = $this->db;

        $query = $db->query("SELECT * FROM products WHERE description LIKE '%".$keyword."%'");
        return $query->getResultArray();
    }
}