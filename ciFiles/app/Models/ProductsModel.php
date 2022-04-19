<?php namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{

    protected $table = "products";

    protected $primaryKey = 'id';

    protected $allowedFields = ['product_name','uid','product_price','product_description','product_images'];


}