<?php

namespace App\Http\Controllers\Admin;

use App\Models\Duration;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\ReportingInstruction;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function getClients()
    {
        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        return view('admin.client.index', [
            'clients' => $clients
        ]);
    }

    public function showClient(User $client)
    {
        return view('admin.client.show', [
            'client' => $client,
        ]);
    }

    public function editClient(User $client)
    {
        return view('admin.client.edit', [
            'client' => $client,
        ]);
    }

    public function newClient()
    {
        return view('admin.client.create');
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $client = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $client->roles()->attach(Role::getIdByCode('client'));

        return redirect()->back()->withSuccess("Клиент {$client->email} успешно добавлен!");
    }

    public function updateClient(Request $request, User $client)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->middlename = $request->middlename;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();

        return redirect()->back()->withSuccess("Информация о клиенте {$client->email} успешно обновлена!");
    }

    public function getGlobalProjects()
    {
        $projects = Project::orderBy('created_at', 'ASC')->get();

        return view('admin.project.global.index', [
            'projects' => $projects
        ]);
    }

    public function getGlobalProject(Project $project)
    {
        $users = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', '!=', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        return view('admin.project.global.show', [
            'project' => $project,
            'users' => $users
        ]);
    }

    public function getProjects()
    {
        $projects = auth()->user()->projects()->orderBy('created_at', 'ASC')->get();

        return view('admin.project.self.index', [
            'projects' => $projects
        ]);
    }

    public function showProject(Project $project)
    {
        $users = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', '!=', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        return view('admin.project.self.show', [
            'project' => $project,
            'users' => $users,
        ]);
    }

    public function editProject(Project $project)
    {
        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();
        $types = Type::orderBy('id', 'ASC')->get();
        $durations = Duration::orderBy('id', 'ASC')->get();

        return view('admin.project.self.edit', [
            'clients' => $clients,
            'types' => $types,
            'durations' => $durations,
            'project' => $project,
        ]);
    }

    public function newProject()
    {
        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();
        $types = Type::orderBy('id', 'ASC')->get();
        $durations = Duration::orderBy('id', 'ASC')->get();

        return view('admin.project.self.create', [
            'clients' => $clients,
            'types' => $types,
            'durations' => $durations
        ]);
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profitability' => ['required', 'string', 'max:255'],
            'cost' => ['required'],
            'client_id' => ['required'],
            'type_id' => ['required'],
            'duration_id' => ['required'],
        ]);

        $project = Project::create([
            'name' => $request->name,
            'profitability' => $request->profitability,
            'cost' => $request->cost,
            'activity' => 1,
            'client_id' => $request->client_id,
            'type_id' => $request->type_id,
            'duration_id' => $request->duration_id,
        ]);

        $project->users()->attach(auth()->user()->id);

        return redirect()->back()->withSuccess("Проект {$project->name} успешно создан!");
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profitability' => ['required', 'string', 'max:255'],
            'cost' => ['required'],
            'client_id' => ['required'],
            'type_id' => ['required'],
            'duration_id' => ['required'],
        ]);

        $project->name = $request->name;
        $project->profitability = $request->profitability;
        $project->cost = $request->cost;
        $project->client_id = $request->client_id;
        $project->type_id = $request->type_id;
        $project->duration_id = $request->duration_id;

        $project->save();

        return redirect()->back()->withSuccess("Информация о проекте: {$project->name} успешно обновлена!");
    }

    public function addUserToProject(Request $request, Project $project)
    {
        $request->validate([
            'user_id' => ['required', 'int']
        ]);

        $project->users()->attach($request->user_id);

        return redirect()->back()->withSuccess("Новый ответственный успешно назначен на проект: {$project->name}");
    }

    public function changeProjectStatus(Request $request, Project $project)
    {
        if ($project->activity) {
            $project->activity = 0;
        } else {
            $project->activity = 1;
        }

        $project->save();
        return redirect()->back()->withSuccess("Статус успешно изменён!");
    }

    public function getMeetings()
    {
        $meetings = Meeting::orderBy('id', 'ASC')->get();

        return view('admin.meeting.index', [
            'meetings' => $meetings
        ]);
    }

    public function showMeeting(Meeting $meeting)
    {
        return view('admin.meeting.show', [
            'meeting' => $meeting,
        ]);
    }

    public function editMeeting(Meeting $meeting)
    {
        $analysts = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('analyst'));
        })->orderBy('created_at', 'ASC')->get();

        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        $projects = Project::orderBy('created_at', 'ASC')->get();

        return view('admin.meeting.edit', [
            'clients' => $clients,
            'analysts' => $analysts,
            'projects' => $projects,
            'meeting' => $meeting
        ]);
    }

    public function newMeeting()
    {
        $analysts = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('analyst'));
        })->orderBy('created_at', 'ASC')->get();

        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        $projects = Project::orderBy('created_at', 'ASC')->get();

        return view('admin.meeting.create', [
            'analysts' => $analysts,
            'clients' => $clients,
            'projects' => $projects,
        ]);
    }

    public function storeMeeting(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'venue' => ['required', 'string', 'max:255'],
            'meeting_date' => ['required', 'date', 'after:today'],
            'user_id' => ['required', 'int'],
            'client_id' => ['required', 'int'],
            'project_id' => ['required', 'int'],
        ]);

        $meeting = Meeting::create([
            'description' => $request->description,
            'venue' => $request->venue,
            'meeting_date' => $request->meeting_date,
            'user_id' => $request->user_id,
            'client_id' => $request->client_id,
            'project_id' => $request->project_id,
            'author_id' => auth()->user()->id
        ]);

        return redirect()->back()->withSuccess("Конференция №{$meeting->id} успешно создана!");
    }

    public function updateMeeting(Request $request, Meeting $meeting)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'venue' => ['required', 'string', 'max:255'],
            'meeting_date' => ['required', 'date', 'after:today'],
            'user_id' => ['required', 'int'],
            'client_id' => ['required', 'int'],
            'project_id' => ['required', 'int'],
        ]);

        $meeting->description = $request->description;
        $meeting->venue = $request->venue;
        $meeting->meeting_date = $request->meeting_date;
        $meeting->user_id = $request->user_id;
        $meeting->client_id = $request->client_id;
        $meeting->project_id = $request->project_id;

        $meeting->save();

        return redirect()->back()->withSuccess("Информация о конференции №{$meeting->id} успешно обновлена!");
    }

    public function agreementMeeting(Request $request, Meeting $meeting)
    {
        $meeting->approval = 1;
        $meeting->save();

        return redirect()->back()->withSuccess("Проведение конференции согласовано!");
    }

    public function getInstructions()
    {
        $instructions = ReportingInstruction::orderBy('id', 'ASC')->get();

        return view('admin.instruction.index', [
            'instructions' => $instructions
        ]);
    }

    public function showInstruction(ReportingInstruction $instruction)
    {
        return view('admin.instruction.show', [
            'instruction' => $instruction,
        ]);
    }

    public function editInstruction(ReportingInstruction $instruction)
    {
        $projects = Project::orderBy('created_at', 'ASC')->get();

        return view('admin.instruction.edit', [
            'projects' => $projects,
            'instruction' => $instruction
        ]);
    }

    public function newInstruction()
    {
        $projects = Project::orderBy('created_at', 'ASC')->get();

        return view('admin.instruction.create', [
            'projects' => $projects,
        ]);
    }

    public function storeInstruction(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'report_date' => ['required', 'date', 'after:today'],
            'interval' => ['required', 'string', 'max:255'],
            'queries' => ['nullable', 'string'],
            'project_id' => ['required', 'int'],
        ]);

        $instruction = ReportingInstruction::create([
            'description' => $request->description,
            'report_date' => $request->report_date,
            'interval' => $request->interval,
            'queries' => $request->queries,
            'project_id' => $request->project_id,
        ]);

        return redirect()->back()->withSuccess("Закрытие месяца №{$instruction->id} успешно создано!");
    }

    public function updateInstruction(Request $request, ReportingInstruction $instruction)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'report_date' => ['required', 'date', 'after:today'],
            'interval' => ['required', 'string', 'max:255'],
            'queries' => ['nullable', 'string'],
            'project_id' => ['required', 'int'],
        ]);

        $instruction->description = $request->description;
        $instruction->report_date = $request->report_date;
        $instruction->interval = $request->interval;
        $instruction->queries = $request->queries;
        $instruction->project_id = $request->project_id;

        $instruction->save();

        return redirect()->back()->withSuccess("Информация о закрытии месяца №{$instruction->id} успешно обновлена!");
    }
}
