<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToProfactureRequest;
use App\Http\Requests\RemoveProductFromProfactureRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateProductQuantityOfProfactureRequest;
use App\ListType;
use App\Product;
use App\Profacture;
use App\Subject;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Profacture::query()
        // ->where('list_type','101')
        ->where('status','waiting')
        ->with('subject:id,name,contact_name,phone_1,user_id')
        ->get();
        return Inertia::render('Order/Index', ['orders' => $orders]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers =
            Subject::select(['id', 'name', 'user_id', 'subject_type'])
            ->where('subject_type', 'supplier')
            ->get();
        return Inertia::render('Order/New', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $request->validated();

        $supplier = Subject::where($request->input('suplier_id'))->first();

        $products = Product::query()

            ->where('supplier_id', $supplier->id);

        if ($request->input('stock_type') == 'minimal_stock') {

            $products->whereRaW('stock < minimal_stock');
        } else if ($request->input('stock_type') == 'maximal_stock') {
            $products->whereRaW('stock < maximal_stock');
        }

        $order = new Profacture();
        $order_type_number = ListType::all()->random();



        $order->subject_id = $request->get('supplier_id');
        $order->list_type_id = $order_type_number->id;


        $order->user_id = $request->user()->id;
        $order->status = 'waiting';

        $order->save();

        $products = $products->get();

        if ($request->input('stock_type') == 'minimal_stock') {
            $products->each(function ($product, $index) use ($order) {

                $order->products()->attach($product, [
                    'product_order_no' => $index + 1,
                    'custom_product_name' => $product->name,
                    'quantity' => $product->minimal_stock - $product->stock,
                    'price' => $product->buying_price,
                    'discount' => 0.0
                ]);
            });
        } else if ($request->input('stock_type') == 'maximal_stock') {
            $products->each(function ($product, $index) use ($order) {

                $order->products()->attach($product, [
                    'product_order_no' => $index + 1,
                    'custom_product_name' => $product->name,
                    'quantity' => $product->maximal_stock - $product->stock,
                    'price' => $product->buying_price,
                    'discount' => 0.0
                ]);
            });
        }




        // dd($products);
        return redirect()->route('order.show', $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function accept_order($id)
    {
        $order = Profacture::where('id', $id)
            ->with('subject')
            // ->with('products')
            ->first();
        if (!$order) {
            return redirect('order')->withErrors(['not_found' => 'Porosia nuk u gjet!']);
            // dd('Oferta nuk u gjet');
        }
        // dd($order->products);

        $order['products'] = $order->products->transform(function ($product) {

            $new_obj_product['product_order_no'] = $product->pivot->product_order_no;
            $new_obj_product['custom_product_name'] = $product->pivot->custom_product_name;
            $new_obj_product['quantity'] = $product->pivot->quantity;
            $new_obj_product['buying_price'] = $product->buying_price;
            $new_obj_product['discount'] = $product->pivot->discount;

            $new_obj_product['brand_name'] = $product->brand->name;

            $new_obj_product['stock'] = $product->stock;
            $new_obj_product['maximal_stock'] = $product->maximal_stock;
            $new_obj_product['minimal_stock'] = $product->minimal_stock;


            $new_obj_product['supplier_no'] = $product->supplier_no;
            $new_obj_product['stock_no'] = $product->stock_no;
            $new_obj_product['original_no'] = $product->original_no;
            $new_obj_product['id'] = $product->id;

            return $new_obj_product;
        });

        // return $order->products;


        $products = Product::query()->where('supplier_id', $order->subject_id)->with('brand')->get();



        return Inertia::render('Order/Accept', ['order' => $order, 'products' => $products]);
    }
    public function show($id)
    {
        $order = Profacture::where('id', $id)
            ->with('subject')
            // ->with('products')
            ->first();
        if (!$order) {
            return redirect('order')->withErrors(['not_found' => 'Porosia nuk u gjet!']);
            // dd('Oferta nuk u gjet');
        }
        // dd($order->products);

        $order['products'] = $order->products->transform(function ($product) {

            $new_obj_product['product_order_no'] = $product->pivot->product_order_no;
            $new_obj_product['custom_product_name'] = $product->pivot->custom_product_name;
            $new_obj_product['quantity'] = $product->pivot->quantity;
            $new_obj_product['buying_price'] = $product->buying_price;
            $new_obj_product['discount'] = $product->pivot->discount;

            $new_obj_product['brand_name'] = $product->brand->name;

            $new_obj_product['stock'] = $product->stock;
            $new_obj_product['maximal_stock'] = $product->maximal_stock;
            $new_obj_product['minimal_stock'] = $product->minimal_stock;


            $new_obj_product['supplier_no'] = $product->supplier_no;
            $new_obj_product['stock_no'] = $product->stock_no;
            $new_obj_product['original_no'] = $product->original_no;
            $new_obj_product['id'] = $product->id;

            return $new_obj_product;
        });

        // return $order->products;


        $products = Product::query()->where('supplier_id', $order->subject_id)->with('brand')->get();



        return Inertia::render('Order/View', ['order' => $order, 'products' => $products]);
    }





    public function remove_product(RemoveProductFromProfactureRequest $request)
    {
        $request->validated();

        $order = Profacture::where('id', $request->get('profacture_id'))->with('products:id')->first();
        // $product = Product::where('id', $request->get('product_id'))->first();



        $order->products()->detach($request->get('product_id'));


        return Response::json(200);
    }


    public function add_product(AddProductToProfactureRequest $request)
    {
        $request->validated();

        //   product_obj_copy["quantity"] = 1;
        //   product_obj_copy["custom_product_name"] = product.name;
        //   product_obj_copy["price"] =
        //     product_obj_copy.cost *
        //     this.order.client.price_level.quota *
        //     this.order.client.price_increase_quota;
        //   product_obj_copy["discount"] = 0.0;
        //   product_obj_copy["product_order_no"] = this.order.products.length + 1;

        $order = Profacture::where('id', $request->get('profacture_id'))->with('products:id')->first();
        $product = Product::where('id', $request->get('product_id'))->first();


        $order_no = $order->products->count() + 1;
        $custom_name = $product->name;
        $quantity = $request->get('quantity');
        $price = $product->buying_price;

        $order->products()->attach($product, [
            'product_order_no' => $order_no,
            'custom_product_name' => $custom_name,
            'quantity' => $quantity,
            'price' => $price,
            'discount' => 0.0
        ]);




        $new_obj_product['product_order_no'] = $order_no;
        $new_obj_product['custom_product_name'] = $custom_name;
        $new_obj_product['quantity'] = $quantity;
        $new_obj_product['buying_price'] = $price;

        $new_obj_product['brand_name'] = $product->brand->name;

        $new_obj_product['stock'] = $product->stock;
        $new_obj_product['maximal_stock'] = $product->maximal_stock;
        $new_obj_product['minimal_stock'] = $product->minimal_stock;


        $new_obj_product['supplier_no'] = $product->supplier_no;
        $new_obj_product['stock_no'] = $product->stock_no;
        $new_obj_product['original_no'] = $product->original_no;
        $new_obj_product['id'] = $product->id;

        return Response::json([
            'product' => $new_obj_product,
        ], 200);
    }

    public function update_product_quantity(UpdateProductQuantityOfProfactureRequest $request)
    {
        $request->validated();


        $order = Profacture::where('id', $request->get('profacture_id'))->first();


        $order->products()->updateExistingPivot($request->get('product_id'), ['quantity' => $request->get('quantity')]);
        $order->updated_at = Carbon::now()->toDateTime();
        $order->save();

        return Response::json([
            'message' => "success",
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
