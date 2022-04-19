<?php

namespace App\Controllers;
use App\Models\ProductsModel;

class PageLoader extends BaseController
{
    public function products()
    {

        $productsModel = new ProductsModel();

        $allProducts = $productsModel->findAll();
        
        $data = array(
            "title" => "Products",
            "products" => $allProducts
        );

        helper("form");

        echo view("products",$data);
        
    }

    public function fetch_all_products_html()
    {
        
        $productsModel = new ProductsModel();

        $allProducts = $productsModel->findAll();

        helper("form");

        $productsHTML = '';

        foreach($allProducts as $product){
            $productImages = json_decode($product["product_images"],TRUE);
            $productsHTML.='<tr>

            <td>'.$product["product_name"].'</td>
            <td class="w-25"><img src="'.site_url("assets/images/".$productImages[0]).'" style="width: 20%;"></td>
            <td>₹ '.$product["product_price"].'</td>
            <td>'.$product["product_description"].'</td>
            <td>

                <a class="btn btn-primary" href="'.site_url("product/".$product["uid"]).'">
                    View Details
                </a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editProductModal-'.$product["uid"].'">
                Edit
                </button>

                <div class="modal fade" id="editProductModal-'.$product["uid"].'" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.form_open(site_url("update-product-exe"),array("class"=>"updateform")).'

                                    <input type="hidden" name="pid" value="'.$product["id"].'">

                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input class="form-control" type="text" name="product_name" value="'.$product["product_name"].'" id="product_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price in INR</label>
                                        <input class="form-control" value="'.$product["product_price"].'" type="text" name="product_price" id="product_price">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Product Description</label>
                                        <textarea class="form-control" name="product_description" id="product_description" class="product_description">'.$product["product_description"].'</textarea>
                                    </div>



                                    <div class="form-group">
                                        <label for="product_images">Replace Product images</label>
                                        <input class="form-control" type="file" name="product_images[]" accept="image/*" id="product_images" multiple>
                                    </div>

                                    <button type="submit" class="btn btn-success">Update Product</button>



                                '.form_close().'
                            </div>
                        </div>
                    </div>
                </div>

                '.form_open(site_url("delete-product-exe"),array("class"=>"deleteProdForm")).'
                <input type="hidden" name="pid" value="'.$product["id"].'">
                <button type="submit" class="btn btn-danger">Delete</button>
                '.form_close().'

            </td>

        </tr>';
        }

        return $productsHTML;
        
    }

    public function product_details($uid)
    {
        
        $productsModel = new ProductsModel();

        $pdata = $productsModel->where("uid",$uid)->first();

        $data = array(

            "title" => $pdata["product_name"],
            "pdata" => $pdata

        );

        return view("product_page",$data);
        
    }

}
