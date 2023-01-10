@extends('layouts.admin_layout')

@section('title', 'Добавление типа проекта')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление типа проекта</h1>
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
                        <form action="{{ route('type.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input id="name" type="text" name="name" class="form-control" :value="old('name')"
                                           placeholder="Введите наименование" required autofocus>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="document_type">Тип документа</label>
                                    <input id="document_type" type="text" name="document_type" class="form-control" :value="old('document_type')"
                                           placeholder="Укажите тип документа" required>
                                    <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                                <a href="{{route('type.index')}}" class="btn btn-info">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
