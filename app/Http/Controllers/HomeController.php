<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Models\Product;
use App\Order;
use App\Order_Item;
use DB;
use Illuminate\Http\Request;

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

    public function capnhatgiohang(Request $request, $id, $qty)
    {
        if ($request->ajax()) {

            $itemData = array(
                'rowid' => $id,
                'qty'   => $qty,
            );
            $updateItem = $this->cart->update($itemData);
            echo $updateItem ? 'ok' : 'err';die;
        }
    }

    public function checkout()
    {
        $_SESSION['sessCustomerID'] = 1;
        $custRow                    = DB::table('customers')->where('id', $_SESSION['sessCustomerID'])->get()->first();
        //print_r($custRow);
        return view('checkout', compact('custRow'));
    }

    public function placeOrder()
    {
        if ($this->cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])) {
            $order              = new Order;
            $order->customer_id = $_SESSION['sessCustomerID'];
            $order->total_price = $this->cart->total();
            $save               = $order->save();
            if ($save) {
                $orderID   = $order->id;
                $cartItems = $this->cart->contents();
                foreach ($cartItems as $item) {
                    $order_item = new Order_Item;
                    $order_item->order_id = $orderID;
                    $order_item->product_id = $item['id'];
                    $order_item->quantity = $item['qty'];
                    $save = $order_item->save();
                }
                $this->cart->destroy();
                return redirect()->route('orderSuccess');
            }
            else {
                return redirect()->route('giohang');
            }
        }
    }

    public function orderSuccess(){
        echo 'Them don hang thanh cong';
    }
}
