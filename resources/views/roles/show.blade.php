@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Información del rol {{ $role->name }}</h2><br>
            </div>
        </div>
    </div>

    <style>
        .badge-container {
            display: inline-block;
        }

        .badge-success {
            background-color: #68686891;
            color: white;
            margin-right: 3px;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 4px;
            margin-top: 2px;
        }
    </style>
<br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                <br><br>
                @if (!empty($rolePermissions))
                    <div class="badge-container">
                        @foreach ($rolePermissions as $v)
                            <span class="badge badge-success">{{ $v->name }}</span>
                        @endforeach
                    </div>
                @endif
                <div style="text-align: left;"><br><br><br>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Volver atras</a>
                </div>
            </div>
        </div>
    </div>
@endsection
