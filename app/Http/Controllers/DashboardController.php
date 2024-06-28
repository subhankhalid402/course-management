<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public $menu_url = "dashboard";

    public function __construct()
    {
        $this->colors = [
            '#8654B9',
            '#3F615D',
            '#170658',
            '#19E743',
            '#BC42FE',
            '#BFA7E9',
            '#64A285',
            '#19DE78',
            '#04B839',
            '#1369ED',
            '#EF6215',
            '#9641A2',
            '#3B8496',
            '#085F39',
            '#948601',
            '#5D9F62',
            '#67C3F9',
            '#EA68CD',
            '#E98D6B',
            '#A3B51E',
            '#9A2760',
        ];
    }

    public function index()
    {
        $dogs = Dog::get();
        $users = User::whereHas('role', function ($Role) {
            $Role->where('code', 'user');
        })->get();

        $this->data = [];

        $this->data['mate_count'] = $dogs->where('preference', "mate")->count();
        $this->data['play_count'] = $dogs->where('preference', "play")->count();
        $this->data['missing_count'] = $dogs->where('preference', "missing")->count();
        $this->data['adopt_count'] = $dogs->where('preference', "adopt")->count();
        $this->data['male_dogs_count'] = $dogs->where('gender', "male")->count();
        $this->data['female_dogs_count'] = $dogs->where('gender', "female")->count();
        $this->data['menu'] = $this->menu_url;
        $this->data['total_users'] = $users->count();
        $this->data['total_dogs'] = $dogs->count();

        $this->data['recent_users']= User::with(['dog'])->whereHas('dog')->latest()->limit(20)->get();

        $this->data['menu'] = $this->menu_url;

        return view('dashboard.dashboard2')->with($this->data);
    }

    public function lineChart()
    {
        $index = 0;
        $lineArray[$index]['label'] = 'Registerations ';
        $lineArray[$index]['borderColor'] = $this->colors[$index];
        $lineArray[$index]['fill'] = false;

        $counter = 0;
        for ($i = 15; $i >= 0; $i--) {
            $interval_start_date = Carbon::today()->subDays($i)->format('Y-m-d');

            $users = User::whereDate('created_at', $interval_start_date)->count();

            $lineArray[$index]['data'][] = $users;

            $labels[$counter++] = Carbon::parse($interval_start_date)->format('d/m/Y');
        }


        return response()->json([
            'status' => true,
            'data' => $lineArray,
            'labels' => $labels
        ]);
    }

    public function pieChart()
    {
        $Dogs = Dog::groupBy('preference')
            ->selectRaw('preference, count(id) as total_dogs')
            ->orderBy('total_dogs', 'DESC')
            ->limit(10)
            ->get();

        $totalDogs = [];
        $pie_Labels = [];
        $pie_bgColors = [];

        foreach ($Dogs as $key => $detail) {
            $title = ucfirst($detail['preference']);

            $totalDogs[] = $detail['total_dogs'];
            $pie_Labels[] = $title;
            $pie_bgColors[] = $this->colors[$key];
        }
        return response()->json([
            'status' => true,
            'labels' => $pie_Labels,
            'bg_colors' => $pie_bgColors,
            'quantity' => $totalDogs
        ]);
    }
}
