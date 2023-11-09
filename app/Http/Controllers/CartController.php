<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Xendit\Xendit;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaksi;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve data from the 'transaksi' table and order it by 'total_harga' column
        $latestTransaction = Transaksi::latest('created_at')->first();
        $priceData = $latestTransaction ? $latestTransaction->total_harga : null;

        return view('cart.index', [
            'title' => 'Masukan Data Untuk Membuat Invoice',
            'priceData' => $priceData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function addToCart(Request $request)
    {
        // Validasi permintaan jika diperlukan
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        // Dapatkan nama dan harga barang yang ditambahkan dari permintaan
        $itemName = $request->input('name');
        $itemPrice = $request->input('price');

        // Dapatkan item-item dalam keranjang dari sesi
        $cartItems = session('cart', []);

        // Cek apakah item dengan nama yang sama sudah ada dalam keranjang
        $existingItem = collect($cartItems)->firstWhere('name', $itemName);

        if ($existingItem) {
            // Jika item sudah ada, tambahkan jumlah atau sesuaikan item yang ada
            $existingItem['quantity'] += 1;
        } else {
            // Jika item belum ada, tambahkan item baru ke dalam keranjang
            $cartItems[] = [
                'name' => $itemName,
                'price' => $itemPrice,
                'quantity' => 1, // Tambahkan jumlah item
            ];
        }

        // Simpan item-item dalam keranjang ke dalam sesi
        session(['cart' => $cartItems]);

        // Hitung total harga semua item dalam keranjang
        $totalPrice = $this->calculateTotalPrice($cartItems);

        // Kembalikan item-item dalam keranjang dan total harga dalam respons JSON
        return response()->json([
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    private function calculateTotalPrice($cartItems)
    {
        // Hitung total harga dari item-item dalam keranjang
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return $totalPrice;
    }
    public function store(StoreCartRequest $request)
    {
        try {
            //code...
            $latestTransaction = Transaksi::latest('created_at')->first();
            $priceData = $latestTransaction ? $latestTransaction->total_harga : 0;
            DB::beginTransaction();
            $order_id = 'pembelian' . date('YmdHis');
            $request->merge([
                'order_id' => $order_id,
                'amount' => $priceData,
                'description' => 'Pembelian Barang',
            ]);
            Cart::create($request->all());
            DB::commit();

            Xendit::setApiKey(env('XENDIT_SECRET_API_KEY'));
            $params = [
                'external_id' => $order_id,
                'amount' => $priceData,
                'description' => 'Pembelian Barang',
                'invoice_duration' => 86400,
                'customer' => [
                    'given_names' => $request->name,
                    'surname' => $request->last_name,
                    'email' => $request->email,
                    'mobile_number' => $request->phone_number
                ],
                'customer_notification_preference' => [
                    'invoice_created' => [
                        'whatsapp',
                        'sms',
                        'email',
                        'viber'
                    ],
                    'invoice_reminder' => [
                        'whatsapp',
                        'sms',
                        'email',
                        'viber'
                    ],
                    'invoice_paid' => [
                        'whatsapp',
                        'sms',
                        'email',
                        'viber'
                    ],
                    'invoice_expired' => [
                        'whatsapp',
                        'sms',
                        'email',
                        'viber'
                    ]
                ],
                'success_redirect_url' => route('success'),
                'failure_redirect_url' => route('failure'),
                'currency' => 'IDR',
                'items' => [
                    [
                        'name' => 'Pembelian Barang',
                        'quantity' => 1,
                        'price' => $priceData,
                        'category' => 'Education',
                        'url' => url('/')
                    ]
                ],
                'fees' => [
                    [
                        'type' => 'ADMIN',
                        'value' => 0
                    ]
                ]
            ];
            $createInvoice = \Xendit\Invoice::create($params);
            return Redirect::to($createInvoice['invoice_url']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('status', $ex->getMessage());
        }
    }
}
