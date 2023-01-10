<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Duration;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\ReportingInstruction;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SystemController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function (Builder $query) {
            $query->where('role_id', '!=', Role::getIdByCode('client'));
        })->orderBy('created_at', 'ASC')->get();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function getUser(User $user)
    {
        $departments = Department::orderBy('id', 'ASC')->get();
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('admin.user.edit', [
            'user' => $user,
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    public function newUser()
    {
        $departments = Department::orderBy('id', 'ASC')->get();
        $roles = Role::orderBy('id', 'ASC')->get();
        return view('admin.user.create', [
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'int'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id
        ]);

        $user->roles()->attach($request->role_id);

        return redirect()->back()->withSuccess("Пользователь {$user->email} успешно добавлен!");
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'int'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->middlename = $request->middlename;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->department_id = $request->department_id;

        $user->roles()->detach();
        $user->roles()->attach($request->role_id);
        $user->save();
        return redirect()->back()->withSuccess("Информация о пользователе {$user->email} успешно обновлена!");
    }

    public function destroyUser(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->back()->withSuccess("Пользователь {$user->email} успешно удалён!");
    }

    public function getRoles()
    {
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('admin.role.index', [
            'roles' => $roles
        ]);
    }

    public function getRole(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role,
        ]);
    }

    public function newRole()
    {
        return view('admin.role.create');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->back()->withSuccess("Роль {$role->name} успешно добавлена!");
    }

    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        $role->name = $request->name;
        $role->code = $request->code;
        $role->save();

        return redirect()->back()->withSuccess("Информация о роли {$role->name} успешно обновлена!");
    }

    public function destroyRole(Role $role)
    {
        $role->users()->detach();
        $role->delete();
        return redirect()->back()->withSuccess("Роль {$role->name} успешно удалена!");
    }

    public function getDepartments()
    {
        $departments = Department::orderBy('id', 'ASC')->get();

        return view('admin.department.index', [
            'departments' => $departments
        ]);
    }

    public function getDepartment(Department $department)
    {
        return view('admin.department.edit', [
            'department' => $department,
        ]);
    }

    public function newDepartment()
    {
        return view('admin.department.create');
    }

    public function storeDepartment(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);

        $department = Department::create([
            'description' => $request->description,
        ]);

        return redirect()->back()->withSuccess("Отдел {$department->description} успешно добавлен!");
    }

    public function updateDepartment(Request $request, Department $department)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);

        $department->description = $request->description;
        $department->save();

        return redirect()->back()->withSuccess("Информация об отделе {$department->description} успешно обновлена!");
    }

    public function destroyDepartment(Department $department)
    {
        if ($department->users->isEmpty()) {
            $department->delete();
        } else {
            return redirect()->back()->withError("Невозможно удалить отдел, в котором есть сотрудники!");
        }
        return redirect()->back()->withSuccess("{$department->description} успешно удалён!");
    }

    public function getTypes()
    {
        $types = Type::orderBy('created_at', 'ASC')->get();

        return view('admin.type.index', [
            'types' => $types
        ]);
    }

    public function getType(Type $type)
    {
        return view('admin.type.edit', [
            'type' => $type,
        ]);
    }

    public function newType()
    {
        return view('admin.type.create');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:255'],
        ]);

        $type = Type::create([
            'name' => $request->name,
            'document_type' => $request->document_type,
        ]);

        return redirect()->back()->withSuccess("Тип проекта {$type->name} успешно добавлен!");
    }

    public function updateType(Request $request, Type $type)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:255'],
        ]);

        $type->name = $request->name;
        $type->document_type = $request->document_type;

        $type->save();

        return redirect()->back()->withSuccess("Информация о типе проекта {$type->name} успешно обновлена!");
    }

    public function destroyType(Type $type)
    {
        if ($type->projects->isEmpty()) {
            $type->delete();
        } else {
            return redirect()->back()->withError("Невозможно удалить тип проекта, который присвоен существующему проекту!");
        }
        return redirect()->back()->withSuccess("{$type->name} успешно удалён!");
    }

    public function getDurations()
    {
        $durations = Duration::orderBy('id', 'ASC')->get();

        return view('admin.duration.index', [
            'durations' => $durations
        ]);
    }

    public function getDuration(Duration $duration)
    {
        return view('admin.duration.edit', [
            'duration' => $duration,
        ]);
    }

    public function newDuration()
    {
        return view('admin.duration.create');
    }

    public function storeDuration(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
        ]);

        $duration = Duration::create([
            'name' => $request->name,
            'period' => $request->period,
        ]);

        return redirect()->back()->withSuccess("Продолжительность проекта: {$duration->name} успешно добавлена!");
    }

    public function updateDuration(Request $request, Duration $duration)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
        ]);

        $duration->name = $request->name;
        $duration->period = $request->period;

        $duration->save();

        return redirect()->back()->withSuccess("Информация о продолжительности проекта: {$duration->name} успешно обновлена!");
    }

    public function destroyDuration(Duration $duration)
    {
        if ($duration->projects->isEmpty()) {
            $duration->delete();
        } else {
            return redirect()->back()->withError("Невозможно удалить продолжительность проекта, которая присвоена существующему проекту!");
        }
        return redirect()->back()->withSuccess("Продолжительность проекта: {$duration->name} успешно удалена!");
    }

    public function destroyClient(User $client)
    {
        if ($client->clientProjects->isEmpty()) {
            $client->delete();
        } else {
            return redirect()->back()->withError("Невозможно удалить клиента, который участвует в проекте!");
        }

        return redirect()->back()->withSuccess("Клиент {$client->email} успешно удалён!");
    }

    public function destroyProject(Project $project)
    {
        $project->meetings()->delete();
        $project->instructions()->delete();
        $project->statistic()->delete();
        $project->users()->detach();
        $project->delete();

        return redirect()->back()->withSuccess("Проект: {$project->name} успешно удалён!");
    }

    public function destroyMeeting(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()->back()->withSuccess("Конференция №{$meeting->id} успешно удалена!");
    }

    public function destroyInstruction(ReportingInstruction $instruction)
    {
        $instruction->delete();

        return redirect()->back()->withSuccess("Закрытие месяца №{$instruction->id} успешно удалено!");
    }
}