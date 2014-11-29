@extends('layouts.default')

@section('head')
	<title>HELUMA - Home</title>
@stop

@section('body')
	<div id="content">
		<div id="header">
			<div id="heluma" class="header">
				<h1>HELUMA</h1>
			</div>
			<div id="header-search" class="header">
				{{ Form::open(['url' => 'login']) }}
				<div class="input-group"> 
					{{ Form::text('search', null, ['class' => 'form-control' , 'placeholder' => 'Pesquise aqui']) }}
					<span id="search_span" class="input-group-btn">
						{{ Form::submit('Pesquisar', ['class' => 'btn btn-default']) }}
					</span>
				</div>
				{{ Form::close() }}
			</div>
			<div id="text" class="header">
				<ul>
					<li><a href="login">Login</a></li>
					<li><a href="#">Cadastro</a></li>
				</ul>		
			</div>
		</div>
		<div id="container">
		</div>
	</div>
@stop