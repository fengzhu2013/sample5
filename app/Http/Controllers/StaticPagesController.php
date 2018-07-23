<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * 显示首页
     * @return [type] [description]
     */
    public function home()
    {
    	return view('static_pages.home');
    }

    /**
     * 显示帮助页
     * @return [type] [description]
     */
    public function help()
    {
    	return view('static_pages.help');
    }

    /**
     * 显示关于页面
     * @return [type] [description]
     */
    public function about()
    {
    	return view('static_pages.about');
    }



}
