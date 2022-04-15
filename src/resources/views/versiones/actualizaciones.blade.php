@extends('layout.app-novue')
@push('styles')
    <style>
        .commit {
            font-weight: bold;
            font-size: larger;
            padding-top: 10px;
        }
        .author {
            font-size: smaller;
            color: gray;
        }
        .date {
            font-size: smaller;
            color: gray;
            padding-bottom: 5px;
        }
        .comment {
            padding-left: 15px;
        }
        .btn-inline {
            display: inline-block;
        }
    </style>
@endpush
@section('breadcrumbs')
    <ul class="breadcrumb breadcrumb-page">
        <li><a href="#">Inicio</a></li>
        <li class="active"><a href="#">Versiones</a></li>
    </ul>
@endsection

@section('titulo-seccion')
    <i class="fa fa-github"></i> Control de versiones </h1>
@endsection

@section('content')
    <div class="panel panel-default pt-4">
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class="nav-item"><a href="/version?cmd=ramas" class="nav-link"><i class="fa fa-code-fork"></i> Versiones</a></li>
                <li class="nav-item"><a href="/actualizaciones" class="nav-link active"><i class="fa fa-github"></i> Actualizaciones</a></li>
            </ul>

            <h3 class="mt-3">Rama actual: {{$rama_actual}} <small>| {{$hash}} | {{$fecha}}</small></h3>

            <hr>

            {!! Form::open(['route' => 'version.status', 'class' => 'form btn-inline', 'novalidate' => 'novalidate', 'method'=>'POST']) !!}
            <button type="submit" value="status" class="btn btn-info btn-inline" id="fetch">Status</button>
            <input type="hidden" name="accion" value="status"/>
            {!! Form::close(); !!}
            {!! Form::open(['route' => 'version.fetch', 'class' => 'form btn-inline', 'novalidate' => 'novalidate', 'method'=>'POST']) !!}
            <button type="submit" value="fetch" class="btn btn-info btn-inline" id="fetch">Fetch</button>
            <input type="hidden" name="accion" value="fetch"/>
            {!! Form::close(); !!}
            {!! Form::open(['route' => 'version.pull', 'class' => 'form btn-inline', 'novalidate' => 'novalidate', 'method'=>'POST']) !!}
            <button type="submit" value="pull" class="btn btn-info btn-inline" id="pull">Pull</button>
            <input type="hidden" name="accion" value="pull"/>
            {!! Form::close(); !!}
            {!! Form::open(['route' => 'version.migrate', 'class' => 'form btn-inline', 'novalidate' => 'novalidate', 'method'=>'POST']) !!}
            <button type="submit" value="migrate" class="btn btn-info btn-inline" id="migrate">Migrate</button>
            <input type="hidden" name="accion" value="migrate"/>
            {!! Form::close(); !!}
            {!! Form::open(['route' => 'version.composer-install', 'class' => 'form btn-inline', 'novalidate' => 'novalidate', 'method'=>'POST']) !!}
            <button type="submit" value="composer-install" class="btn btn-info btn-inline" id="composer-install">Composer install</button>
            <input type="hidden" name="accion" value="composer-install"/>
            {!! Form::close(); !!}

            <hr>

            @include('EdgarOrozco::versiones._lista_log')

        </div>
    </div>
@append
