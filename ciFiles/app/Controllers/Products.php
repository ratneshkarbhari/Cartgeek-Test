<?php

namespace App\Controllers;
use App\Models\ProductsModel;

class Products extends BaseController
{

    public function add()
    {

        $name = $this->request->getPost("product_name");
        $price = $this->request->getPost("product_price");
        $description = $this->request->getPost("product_description");

        $product_images = array();

        if ($imagefile = $this->request->getFiles()) {
            foreach($imagefile['product_images'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $product_images[] = $newName;
                    $img->move('./assets/images', $newName);
                }
            }
        }
        
        $productImagesJson = json_encode($product_images);

        $productData = array(

            "product_name" => $name,
            "uid" => uniqid(),
            "product_price" => $price,
            "product_description" => $description,
            "product_images" => $productImagesJson

        );

        $productsModel = new ProductsModel();

        if ($productsModel->insert($productData)) {
            return "success";
        } else {
            return "failure";
        }
        
        
    }

    public function update()
    {

        $pid = $this->request->getPost("pid");

        $productsModel = new ProductsModel();

        $prevProdData =  $productsModel->find($pid);


        $name = $this->request->getPost("product_name");
        $price = $this->request->getPost("product_price");
        $description = $this->request->getPost("product_description");

        $product_images_array = array();

        if ($imagefile = $this->request->getFiles()) {
            foreach($imagefile['product_images'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $product_images_array[] = $newName;
                    $img->move('./assets/images', $newName);
                }
            }
        }

        if(empty($product_images_array)){
            $productImagesJson = $prevProdData["product_images"];
        }else {
            $productImagesJson = json_encode($product_images_array);

        }

        

        $productData = array(

            "product_name" => $name,
            "uid" => uniqid(),
            "product_price" => $price,
            "product_description" => $description,
            "product_images" => $productImagesJson

        );


        if ($productsModel->update($pid,$productData)) {
            return "success";
        } else {
            return "failure";
        }
        
        
    }


    public function delete()
    {
        $pid = $this->request->getPost("pid");
        $productsModel = new ProductsModel();
        $prevData = $productsModel->find($pid);
        $images = json_decode($prevData["product_images"],TRUE);
        
        $deleted = $productsModel->delete($pid);

        if ($deleted) {
            foreach ($images as $image) {
                $imgPath = "./assets/images/".$image;
                unlink($imgPath);
            }
            return "success";
        } else {
            return "failure";
        }
        



    }

}