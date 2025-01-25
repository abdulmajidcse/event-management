<?php

namespace App\Pages;

use App\Queries\UserQuery;

class HomePage
{
    public function index()
    {
        header('Content-type: application/json');

        $users = (new UserQuery())->getAllUser();
        echo json_encode($users);

        // return view('home', ['message' => 'Welcome', 'name' => 'Abdul Majid']);
    }
}
