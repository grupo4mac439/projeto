@extends('layouts.default')

@section('head')
	<title>HELUMA - Cadastro</title>
	<link rel="stylesheet" href="/css/cadastro.css">
@stop

@section('body')
	<div id="content">
		<div id="header">
			<div id="heluma" class="header">
				<h1>HELUMA</h1>
			</div>

		</div>
		<div id="container">
			<div id="cadastro">
				<h2>Cadastro</h2>
				{{ Form::open(['url' => 'cadastro']) }}
				<div class="form-group"> 
					{{ Form::label('nome', 'Nome:') }}
					{{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Seu Nome']) }}
				</div>
				<div class="form-group"> 
					{{ Form::label('email', 'Email:') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email@exemplo.com']) }}
				</div>
				<div class="form-group"> 
					{{ Form::label('cpf', 'CPF:') }}
					{{ Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => 'Seu CPF']) }}
				</div>
				<div class="form-group"> 
					{{ Form::label('endereco', 'Endereço:') }}
					{{ Form::text('endereco', null, ['class' => 'form-control', 'placeholder' => 'Seu endereço']) }}
				</div>
				<div class="form-group">
					{{ Form::label('senha', 'Senha:') }}
					{{ Form::password('senha', ['class' => 'form-control', 'placeholder' => 'Sua senha']) }}
				</div>
					{{ Form::submit('Entrar', ['id' => 'cadastro-submit', 'class' => 'btn btn-primary' ]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop