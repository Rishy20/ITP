<?php

namespace App\Http\Livewire;

use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AllSales extends Component
{
    public $sale;
    public $date;

    public function mount($sales){
        $this->sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at
                    from sales s,employees e, customers c
                    where s.customerId = c.id and s.staffId = e.id' );
    }

    public function render()
    {
        return view('livewire.all-sales');
    }

    public function filterDate($i){
        dd($i);
    }

    public function filterDateSelect($i){


        date_default_timezone_set('Asia/Colombo');
        $this->sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at
        from sales s,employees e, customers c
        where s.customerId = c.id and s.staffId = e.id' );

        switch($i){
            case 1 :

                    $start = date("Y-m-d");
                    $date = date_create(date("Y-m-d")) ;
                    $diff1Day = new DateInterval('P1D');
                    $end = date_add($date,$diff1Day);

                    $this->sale = DB::select('select s.id,e.fname,e.lname,c.firstname,c.lastname,s.amount,s.discount,s.updated_at,s.created_at
                    from sales s,employees e, customers c
                    where s.customerId = c.id and s.staffId = e.id and s.created_at >= ? and s.created_at < ?',[$start,$end] );

                break;
        }





    }
}
