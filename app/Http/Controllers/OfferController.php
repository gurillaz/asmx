<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\AddProductToProfactureRequest;
use App\Http\Requests\RemoveProductFromOfferRequest;
use App\ListType;
use App\Product;
use App\Profacture;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\Routing\Route as RoutingRoute;

use function PHPUnit\Framework\isNull;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //TODO:get only Profactures with list_types offer
        $offers = Profacture::query()

        ->with('client:id,first_name,last_name,subject_id')
        ->withCount('products')
        ->get(
            [
                "id",
                "private_doc_id"
            ]
        );

        return Inertia::render('Offer/Index',['offers'=>$offers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $clients =
            Client::select(['id', 'first_name', 'last_name', 'subject_id', 'price_level_id', 'client_type', 'phone_1'])
            ->with('subject:id,name,city')->with('price_level:id,name')->get();

        return Inertia::render('Offer/New', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer = new Profacture();
        $offer_type_number = ListType::all()->random();

        $id = DB::select("SHOW TABLE STATUS LIKE 'profactures'");
        $next_id = $id[0]->Auto_increment;

        $offer->client_id = $request->get('client_id');
        $offer->list_type_id = $offer_type_number->id;


        $offer->user_id = $request->user()->id;
        $offer->status = 'unconfirmed';

        $offer->save();

        return redirect()->route('offer.show', $offer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $offer = Profacture::where('id', $id)
            ->with('client:id,name,price_level')
            ->with('client.subject')
            ->with('client.price_level')
            ->with('products')->first();

        $offer['products'] = $offer->products->map(function ($product) {
            $product['product_order_no'] = $product->pivot->product_order_no;
            $product['custom_product_name'] = $product->pivot->custom_product_name;
            $product['quantity'] = $product->pivot->quantity;
            $product['price'] = $product->pivot->price;
            $product['discount'] = $product->pivot->discount;
            return $product;
        });

        // $products = Product::query()->with('brand')->get();



        return Inertia::render('Offer/Invoice', ['offer' => $offer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Profacture::where('id', $id)
            ->with('client:id,name,price_level')
            ->with('client.subject')
            ->with('client.price_level')
            // ->with('products')
            ->first();
        if (!$offer) {
            return redirect('offer')->withErrors( ['not_found'=>'Oferta nuk u gjet!']);
            // dd('Oferta nuk u gjet');
        }

        $offer['products'] = $offer->products->transform(function ($product) {
            $new_obj_product['product_order_no'] = $product->pivot->product_order_no;
            $new_obj_product['custom_product_name'] = $product->pivot->custom_product_name;
            $new_obj_product['quantity'] = $product->pivot->quantity;
            $new_obj_product['price'] = $product->pivot->price;
            $new_obj_product['discount'] = $product->pivot->discount;

            $new_obj_product['unique_no'] = $product->unique_no;
            $new_obj_product['supplier_no'] = $product->supplier_no;
            $new_obj_product['stock_no'] = $product->stock_no;
            $new_obj_product['original_no'] = $product->original_no;
            $new_obj_product['id'] = $product->id;
            return $new_obj_product;
        });

        // return $offer->products;

        $products = Product::query()->with('brand')->get();



        return Inertia::render('Offer/View', ['offer' => $offer, 'products' => $products]);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_last_offer()
    {
        //TODO: add where list_type id to get only the offers
        $last_offer = Profacture::latest()->first();

        // dd($last_offer);
        return $this->show($last_offer->id);

    }

    public function show_today_offers()
    {
        //TODO: add where list_type id to get only the offers
        $offers = Profacture::query()
        ->whereDate('created_at', Carbon::today())->get();
        dd($offers);



        return;
    }




    /**
     * Add product to offer.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function add_product(AddProductToProfactureRequest $request)
    {
        $request->validated();

        //   product_obj_copy["quantity"] = 1;
        //   product_obj_copy["custom_product_name"] = product.name;
        //   product_obj_copy["price"] =
        //     product_obj_copy.cost *
        //     this.offer.client.price_level.quota *
        //     this.offer.client.price_increase_quota;
        //   product_obj_copy["discount"] = 0.0;
        //   product_obj_copy["product_order_no"] = this.offer.products.length + 1;

        $offer = Profacture::where('id', $request->get('offer_id'))->with('products:id')->first();
        $product = Product::where('id', $request->get('product_id'))->first();
        $client = Client::where('id', $offer->client_id)->with('price_level')->first();

        $calculated_price =  $product->cost *
            $client->price_level->quota *
            $client->price_increase_quota;

        $offer->products()->attach($product, [
            'product_order_no' => $offer->products->count() + 1,
            'custom_product_name' => $product->name,
            'quantity' => 1,
            'price' => $calculated_price,
            'discount' => 0.0
        ]);

        $offer->refresh();
        $offer->products = $offer->products->transform(function ($product) {
            $new_obj_product['product_order_no'] = $product->pivot->product_order_no;
            $new_obj_product['custom_product_name'] = $product->pivot->custom_product_name;
            $new_obj_product['quantity'] = $product->pivot->quantity;
            $new_obj_product['price'] = $product->pivot->price;
            $new_obj_product['discount'] = $product->pivot->discount;

            $new_obj_product['unique_no'] = $product->unique_no;
            $new_obj_product['stock_no'] = $product->stock_no;
            $new_obj_product['original_no'] = $product->original_no;
            $new_obj_product['id'] = $product->id;
            return $new_obj_product;
        });

        return Response::json([
            'products' => $offer->products,
        ], 200);
    }

       /**
     * Remove product from offer.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function remove_product(RemoveProductFromOfferRequest $request)
    {
        $request->validated();


        //TODO: Check if profacture if confirmed with a material document


        $offer = Profacture::where('id', $request->get('offer_id'))->with('products:id')->first();
        // $product = Product::where('id', $request->get('product_id'))->first();


        $offer->products()->detach($request->get('product_id'));

        $offer->refresh();
        $offer->products = $offer->products->transform(function ($product) {
            $new_obj_product['product_order_no'] = $product->pivot->product_order_no;
            $new_obj_product['custom_product_name'] = $product->pivot->custom_product_name;
            $new_obj_product['quantity'] = $product->pivot->quantity;
            $new_obj_product['price'] = $product->pivot->price;
            $new_obj_product['discount'] = $product->pivot->discount;

            $new_obj_product['unique_no'] = $product->unique_no;
            $new_obj_product['stock_no'] = $product->stock_no;
            $new_obj_product['original_no'] = $product->original_no;
            $new_obj_product['id'] = $product->id;
            return $new_obj_product;
        });

        return Response::json([
            'products' => $offer->products,
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
        dd($request);
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
