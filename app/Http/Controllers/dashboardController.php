<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class dashboardController extends Controller
{
	public function index(){

		$title = 'Dashboard';		
		$announcements = Announcement::orderBy('created_at', 'desc')->get();
		return view('dashboard',compact('title','announcements'));
	}
}