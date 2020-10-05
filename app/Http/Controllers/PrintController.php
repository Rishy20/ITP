<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class PrintController extends Controller
{
    public function test()
    {
        // Set params
        $mid = '123123456';
        $store_name = 'LeatherLine';
        $store_address = 'No.69,Bodhiraja Mawatha,';
        $store_city = 'Kurunegala';
        $store_phone = '037-2224660';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';

        // Set items
        $items = [
            [
                'name' => 'French Fries (tera)',
                'pcode' => 'IGN1500',
                'qty' => 2,
                'price' => 650,
            ],
        ];

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($mid, $store_name, $store_address,$store_city, $store_phone, $store_email, $store_website);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['pcode'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        // $printer->setQRcode([
        //     'tid' => $transaction_id,
        // ]);

        // Print receipt
        $printer->printReceipt();
    }
}
