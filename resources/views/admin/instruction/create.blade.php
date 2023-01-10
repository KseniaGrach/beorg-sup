@extends('layouts.admin_layout')

@section('title', 'Создание инструкции')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Создание инструкции</h1>
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
                        <form action="{{ route('instruction.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea id="description" name="description" class="form-control" :value="old('description')"
                                              placeholder="Укажите общее описание алгоритма создания отчета" rows="5" required autofocus></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="report_date">Дата сдачи отчета (крайняя)</label>
                                    <input id="report_date" type="datetime-local" name="report_date" class="form-control" :value="old('report_date')">
                                    <x-input-error :messages="$errors->get('report_date')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="interval">Временной период</label>
                                    <input id="interval" type="text" name="interval" class="form-control" :value="old('interval')"
                                           placeholder="Текстовое поле для описания периода, например, 2-3 дня, либо 29-30(31) числа месяца" required>
                                    <x-input-error :messages="$errors->get('interval')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="queries">SQL-запросы</label>
                                    <textarea id="queries" name="queries" class="form-control" :value="old('queries')"
                                              placeholder="Введите sql-запросы" rows="5"></textarea>
                                    <x-input-error :messages="$errors->get('queries')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите проект</label>
                                        <select name="project_id" class="form-control" required>
                                            <option value="">- Укажите проект -</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать</button>
                                <a href="{{route('instruction.index')}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
