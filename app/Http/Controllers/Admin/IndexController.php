<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin\User;
use App\Admin\Order;
use App\Service\Chart;
use App\Admin\VenueStatistics;
use App\Admin\Venue;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    //
    public function index()
    {
    	return view('admin/index/index');
    }

    public function welcome()
    {
    	return view('admin/index/welcome');
    }


    public function getVenueStatistics($venueId=1) {

        if($this->request->method()=='POST'){//ajax请求
            $date = $this->request->input('date') ?? date('Y-m-d');
            $venueId = $this->request->input('venue_id') ?? 1;

            $list = VenueStatistics::statistics($date,$venueId)->toArray();

            $names = array_column($list,'time_interval');
            $counts = array_column($list,'order_number');

            $chart = New Chart("bar",$names,'人数',$counts,false, false,'(age)','(number)');
            $data = $chart->getOption();
            return response()->json(['code'=>0,'msg'=>'ok','data'=>$data]);
        }

        $date = date('Y-m-d');
        $list = VenueStatistics::statistics($date,$venueId)->toArray();

        $names = array_column($list,'time_interval');
        $counts = array_column($list,'order_number');

        $chart = New Chart("bar",$names,'人数',$counts,false, false,'(age)','(number)');
        $data = $chart->getOption();

        return $data;
    }
}
