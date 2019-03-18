<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewTeamController extends Controller
{
    public function index()
    {
        $teamUsers = \App\TeamUser::userId()->get();
        return view('teams.index', [
            'teamUsers' => $teamUsers,
        ]);
    }
}