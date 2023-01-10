<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        $meetings = Meeting::get();
        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        return view('admin.home.index',[
            'projectsCount' => $projects->count(),
            'meetingsCount' => $meetings->count(),
            'clientsCount' => $clients->count(),
            'selfProjectsCount' => auth()->user()->projects->count(),
        ]);
    }

    public function getStartPage()
    {
        if (auth()->user()->hasRole('client')) {
            return redirect()->route('homeClient');
        } else {
            return redirect()->route('homeAdmin');
        }
    }
}