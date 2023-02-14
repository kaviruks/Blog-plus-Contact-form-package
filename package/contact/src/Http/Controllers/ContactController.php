<?php

namespace Kavinda\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Kavinda\Contact\Models\Contact;


class ContactController extends Controller

{   

    //Load Contact form View.
    public function index()
    
    {

        return view('contact::form');


    }



    //Store Contact form data in to the database.
    public function store(Request $request)
    
    {

        Contact::create($request->all());

        session()->flash('successmsg', 'Operation Done');

        return redirect('/contact');
        

        


    }



}
