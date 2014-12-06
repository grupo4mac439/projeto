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
						<label for="local">Local:</label>
						<p name="local">{{ $local->nome }}</p>
					</div>
					<div class="info-p">
						<label for="data">Data:</label>
						<p name="data"> {{ $instancia->data }} </p>
					</div>
					<div class="info-p">
						<label for="hora">Hora:</label>
						<p name="hora"> {{ $instancia->hora }} </p>
					</div>
				</div>
			</div>
			<div class="evento">
				<table class="table">
					<thead>
						<tr>
							<th> Setor	</th>
							<th> Preço entrada </th>
							<th> Preço meia-entrada </th>
							<th> Qtde. total </th>
							<th> Qtde. disponível </th>
							<th> Reservar </th>
						</tr>
					</thead>
					<tbody>
						@foreach($setores as $setor)
						<tr>
							<td> {{ $setor->nome }} </td>
							<td> {{ $setor->preco }} </td>
							<td> {{ $setor->cota_meia }} </td>
							<td> {{ $setor->capacidade_setor }}
							<td> {{ $setor->lugares_disponiveis() }} </td>
							<td width="150"> 
								{{ Form::open(['url' => '/reservar/' . $instancia->id . '/' . $setor->id]) }}
								<div class="input-group"> 
									{{ Form::text('setor_' . $setor->id, null, ['class' => 'form-control']) }}
									<span id="search_span" class="input-group-btn">
										{{ Form::submit('Reservar', ['class' => 'btn btn-default']) }}
									</span>
								</div>
								{{ Form::close() }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop