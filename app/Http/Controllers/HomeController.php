<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Classes\Cart;
use App\Models\Product;
use DB;

class HomeController extends Controller
{
    public $cart;
    public function __construct()
    {
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
        $product  = Product::find($id)->toArray();
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

    public function giohang()
    {
        return view('giohang');
    }

    public function xoagiohang($id)
    {
        $deleteItem = $this->cart->remove($id);
        return redirect()->route('giohang');
    }

    public function capnhatgiohang(Request $request,$id,$qty)
    {
        if ($request->ajax()) {
            
            $itemData = array(
                'rowid' => $id,
                'qty'   => $qty
            );
            $updateItem = $this->cart->update($itemData);
            echo $updateItem ? 'ok' : 'err';die;
        }
    }
    
    public function checkout(){
        $_SESSION['sessCustomerID'] = 1;
        $custRow = DB::table('customers')->where('id',$_SESSION['sessCustomerID'])->get()->first();
        //print_r($custRow);
        return view('checkout',compact('custRow'));
    }
}
