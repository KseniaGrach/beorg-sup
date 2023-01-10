<?php

namespace App\Http\Controllers\Admin;

use App\Models\Duration;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.home.index', [
            'projectsCount' => auth()->user()->clientProjects->count(),
            'meetingsCount' => auth()->user()->clientMeetings->count(),
        ]);
    }

    public function getProjects()
    {
        $projects = auth()->user()->clientProjects()->orderBy('created_at', 'ASC')->get();

        return view('client.project.index', [
            'projects' => $projects
        ]);
    }

    public function showProject(Project $project)
    {
        return view('client.project.show', [
            'project' => $project,
        ]);
    }

    public function getMeetings()
    {
        $meetings = auth()->user()->clientMeetings()->orderBy('id', 'ASC')->get();

        return view('client.meeting.index', [
            'meetings' => $meetings
        ]);
    }

    public function showMeeting(Meeting $meeting)
    {
        return view('client.meeting.show', [
            'meeting' => $meeting,
        ]);
    }

    public function agreementMeeting(Request $request, Meeting $meeting)
    {
        $meeting->client_approval = 1;
        $meeting->save();

        return redirect()->back()->withSuccess("Проведение конференции согласовано!");
    }
}
