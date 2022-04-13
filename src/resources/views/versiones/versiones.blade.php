@extends('layouts.modulo')
@section('style')
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
@append
@section('breadcrumbs')
    <ul class="breadcrumb breadcrumb-page">
        <li><a href="#">Inicio</a></li>
        <li class="active"><a href="#">Versiones</a></li>
    </ul>
@endsection

@section('titulo-seccion')
    <i class="fa fa-code-fork"></i> Control de versiones </h1>
@endsection

@section('contenido-seccion')
    <div class="panel panel-default">
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class="active"><a href="/version?cmd=ramas"><i class="fa fa-code-fork"></i> Versiones</a></li>
                <li><a href="/actualizaciones"><i class="fa fa-github"></i> Actualizaciones</a></li>
            </ul>

            <h3>Rama actual: {{$rama_actual}} <small>| {{$hash}} | {{$fecha}}</small></h3>

            <hr>

            {!! Form::open([
            'route' => 'version.cambiar',
            'class' => 'form',
            'novalidate' => 'novalidate',
            'method'=>'POST']) !!}

            <div class="row">
                <div class="col-md-4">
                    @include('EdgarOrozco::versiones._lista_con_radios')
                    <hr>
                    <div class="form-group" style="margin-bottom: 0;">
                        <div>
                            <button type="submit" class="btn btn-primary btn-cambiar-rama">Cambiar rama</button>
                            <button type="reset" class="btn btn-warning">Cancelar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <h4 class="text-center text-info">Cambios en esta rama</h4>
                    @include('EdgarOrozco::versiones._lista_log')
                </div>

            </div>

            {!! Form::close(); !!}
        </div>
    </div>
@append
