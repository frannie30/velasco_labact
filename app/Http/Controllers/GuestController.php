<?php

namespace App\Http\Controllers;

class GuestController extends Controller
{
    public function contactus() {
        return view('guestpages.contactus');
    }

    public function website() {
        return view('guestpages.website');
    }

    public function privacy() {
        return view('guestpages.privacy');
    }

    public function creator() {
        return view('guestpages.creator');
    }
}
