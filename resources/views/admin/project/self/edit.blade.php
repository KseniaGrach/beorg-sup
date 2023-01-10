@extends('layouts.admin_layout')

@section('title', 'Редактирование проекта')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование проекта: {{ $project['name'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fa fa-check"></i>{{ session('success') }}</h5>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('project.self.update', $project['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{$project->name}}"
                                           placeholder="Укажите наименование проекта" required autofocus>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="profitability">Рентабельность</label>
                                    <input id="profitability" type="text" name="profitability" class="form-control" value="{{$project->profitability}}"
                                           placeholder="Укажите рентабельность проекта" required>
                                    <x-input-error :messages="$errors->get('profitability')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="cost">Стоимость проекта</label>
                                    <input id="cost" type="number" step="0.01" name="cost" class="form-control" value="{{$project->cost}}">
                                    <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите клиента</label>
                                        <select name="client_id" class="form-control" required>
                                            <option value="">- Укажите клиента -</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}"
                                                    @if($project['client_id'] == $client->id)
                                                        selected
                                                    @endif
                                                >{{ $client->fullName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите тип проекта</label>
                                        <select name="type_id" class="form-control" required>
                                            <option value="">- Укажите тип проекта -</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    @if($project['type_id'] == $type->id)
                                                        selected
                                                    @endif
                                                >{{ $type->name }} ({{$type->document_type}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Укажите сроки проекта</label>
                                        <select name="duration_id" class="form-control" required>
                                            <option value="">- Укажите сроки -</option>
                                            @foreach ($durations as $duration)
                                                <option value="{{ $duration->id }}"
                                                    @if($project['duration_id'] == $duration->id)
                                                        selected
                                                    @endif
                                                >{{ $duration->name }} ({{$duration->period}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{route('project.self.show', $project->id)}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
