@extends('layouts.default')

@section('head')
	<title> HELUMA - Pesquisa </title>
	<link rel="stylesheet" href="/css/pesquisa.css">
@stop

@section('body')
	<div id="content">
	@include('layouts.header')
		<div id="container">	
			@foreach($eventos as $evento)
				<div class="evento">
					<div class="evento-img-container">
						<img src="/imagens/{{ $evento->foto }}" class="evento-img">
					</div>
					<div class="info">
						<div class="info-p">
							<label for="nome">Título:</label>
							<p name="nome">{{ $evento->nome }}</p>
						</div>
						<div class="info-p">
							<label for="genero">Gênero:</label>
							<p name="genero">{{ $evento->genero }}</p>
						</div>
						<div class="info-p">
							<label for="classificacao">Classificação:</label>
							<p name="classificacao"> {{ $evento->classificacao }} </p>
						</div>
						<div class="info-p">
							{{ link_to('exibir/' . $evento->id, 'Ver mais') }}
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@stop