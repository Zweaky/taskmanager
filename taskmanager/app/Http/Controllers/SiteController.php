<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
	public function index()
	{
		return view('welcome');
	}

	public function features()
	{
		return view('features');
	}

	public function faq()
	{
		return view('faq');
	}
}
