<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\InquiryMail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/admin/projects');
    }

    public function mail()
    {
        $inquiry = [
            'name' => 'Mark Hussy',
            'message' => 'Mark Hussy'
        ];
        Mail::to('xmark030@gmail.com')->send(new InquiryMail($inquiry));
        
        return 'Email was sent';
    }
    
}
