<?php

namespace App\Http\Controllers;

use Milon\Barcode\DNS2D;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
      return view('product');
    }

    public function generateQRCode(Request $request)
    {
        $data = $request->input('data');
        $dns2d = new DNS2D();
        $qrCode = $dns2d->getBarcodeHTML($data, 'QRCODE');

        return response()->json(['qrCode' => $qrCode]);
    }
}



