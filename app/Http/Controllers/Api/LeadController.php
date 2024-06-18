<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMarkdown;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function create()
    {
        return view('guests.leads.create');
    }

    public function store(Request $request)
    {
        //dd($request);

        $val_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:2000',
        ]);

        $newLead = Lead::create($val_data);

        Mail::to('noreply@fotoalbum.com')->send(new NewLeadMarkdown($newLead));

        return back()->with('Message', 'Message sent successfully');
    }
}
