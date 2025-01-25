<?php

namespace App\Pages;

use App\Queries\UserQuery;

class HomePage
{
    public function index()
    {
        $data['users'] = (new UserQuery())->getAllUser();

        return view('home', $data);
    }
}
