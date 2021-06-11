<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $query = "select DATE_FORMAT(created_at,'%m-%d') as date , COUNT(*) as total_products from products where  DATE_FORMAT(created_at,'%y-%m-%d') BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() GROUP BY DATE_FORMAT(created_at,'%y-%m-%d') ORDER BY DATE_FORMAT(created_at,'%y-%m-%d') DESC";
        $reports = DB::select(DB::raw($query));
        $user_name = Auth::user()->full_name;
        flash('Welcome' . ' ' . $user_name);
        $users = User::count();
        $products = Product::count();
        $categories = Category::count();
        return view('home')->with([
            'users' => $users,
            'products' => $products,
            'categories' => $categories,
            'reports' => $reports
        ]);
    }
}
