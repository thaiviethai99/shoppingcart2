<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Classes\Cart;
use DB;

class HomeController extends Controller
{
	var $cart;
	public function __construct(){
		$this->cart = new Cart();
	}

    public function index()
    {
        $products = DB::table('products')->orderBy('id', 'desc')->get()->toArray();
        return view('home', compact('products'));
    }

    public function muahang($id)
    {
        $productID = $id;
        // get product details
        $product = Product::find($id)->toArray();
        $itemData = array(
            'id'    => $product['id'],
            'name'  => $product['name'],
            'price' => $product['price'],
            'qty'   => 1,
        );

        $insertItem  = $this->cart->insert($itemData);
        $redirectLoc = $insertItem ? 'giohang' : 'index.php';
        return redirect()->route($redirectLoc);
    }

    public function giohang(){
    	return view('giohang', compact('products'));
    }
}
