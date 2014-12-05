@extends('layouts.default')

@section('head')
	<title> HELUMA - {{ $evento->nome }} </title>
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/evento.css">
@stop

@section('body')
	<div id="content">
	@include('layouts.header')
		<div id="container">	
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
						<label for="sinopse">Sinopse:</label>
						@if ( !strcmp($evento->tipo, 'f'))
							<p name="sinopse"> {{ $evento->filme()->sinopse }}</p>
						@elseif ( !strcmp($evento->tipo, 's'))
							<p name="sinopse"> {{ $evento->show()->descricao }}</p>
						@else
							<p name="sinopse"> {{ $evento->peca()->sinopse }}</p>
						@endif

					</div>
				</div>
			</div>
			@unless ( empty( $evento->instancia_evento() ) )
				<div class="evento">
					<table class="table">
						<thead>
							<tr>
								<th> Local	</th>
								<th> Data   </th>
								<th> Horário </th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($evento->instancia_evento() as $instancia)
							<tr>
								<td> {{ $instancia->local()->nome }} </td>
								<td> {{ $instancia->data }} </td>
								<td> {{ $instancia->hora }} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endunless
		</div>
	</div>
@stop