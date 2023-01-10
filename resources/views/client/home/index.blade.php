@extends('layouts.client_layout')

@section('title', 'Главная')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $projectsCount }}</h3>
                            <p>Мои проекты</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-briefcase"></i>
                        </div>
                        <a href="{{route('client.project.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $meetingsCount }}</h3>
                            <p>Мои встречи</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatbubbles"></i>
                        </div>
                        <a href="{{route('client.meeting.index')}}" class="small-box-footer">Перейти <i
                                    class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
