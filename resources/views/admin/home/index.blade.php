@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $projectsCount }}</h3>
                            <p>Все проекты</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-briefcase"></i>
                        </div>
                        <a href="{{route('project.global.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $selfProjectsCount }}</h3>
                            <p>Мои проекты</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="{{route('project.self.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $meetingsCount }}</h3>
                            <p>Встречи</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatbubbles"></i>
                        </div>
                        <a href="{{route('meeting.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $clientsCount }}</h3>
                            <p>Клиенты</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{route('client.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
