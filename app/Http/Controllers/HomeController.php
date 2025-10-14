<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        $stats = [
          'total_members'=>145,
          'generation'=>'VIII',
          'upcoming_events'=>3,
          'birthdays'=>7
        ];
        return view('home', compact('stats'));
    }
}
