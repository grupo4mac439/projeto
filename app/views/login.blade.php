@extends('layouts.default')

@section('head')
	<title>HELUMA - Login</title>
	<link rel="stylesheet" href="/css/login.css">
@stop

@section('body')
	<div id="content">
		<div id="header">
			<div id="heluma" class="header">
				<h1>HELUMA</h1>
			</div>

		</div>
		<div id="container">
			<div id="login">
				<h2>Login</h2>
				{{ Form::open(['url' => 'login']) }}
				<div class="form-group"> 
					{{ Form::label('email', 'Email:') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email@exemplo.com']) }}
				</div>
				<div class="form-group">
					{{ Form::label('senha', 'Senha:') }}
					{{ Form::password('senha', ['class' => 'form-control', 'placeholder' => 'senha']) }}
				</div>
					{{ Form::submit('Entrar', ['id' => 'login-submit', 'class' => 'btn btn-primary' ]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop