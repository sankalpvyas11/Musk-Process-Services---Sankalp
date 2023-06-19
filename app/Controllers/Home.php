<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Index page or the home page
    public function index()
    {
        $data = [
            'page_title' => 'Musk Process Services',
            'page_heading' => 'Homepage'
        ];


        return view('Other/homeview', $data);
    }

    // About us page

    public function about()
    {
        $data = [
            'page_title' => 'About Us',
            'page_heading' => 'about section'
        ];

        return view('Other/aboutview', $data);
    }

    // Contact us page

    public function contact()
    {
        $data = [
            'page_title' => 'Contact Us',
            'page_heading' => 'contact section'
        ];



        return view('Other/contactview', $data);
    }


}
