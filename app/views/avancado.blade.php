@extends('layouts.default')

@section('head')
	<title> HELUMA - Pesquisa Avançada</title>
	<link rel="stylesheet" href="/css/pesquisa.css">
@stop

@section('body')
	<div id="content">
	@include('layouts.header')
		<div id="container">	
			<div id="pesquisa_avancada">
				<h2> Pesquisa Avançada</h2>
				{{ Form::open(['url' => 'pesquisa/avancada/']) }}
				<div class="form-group"> 
					{{ Form::checkbox('nome-cb', '1') }}
					{{ Form::label('nome-cb', 'Título') }}
					{{ Form::text('nome', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group"> 
					{{ Form::checkbox('genero-cb', '1') }}
					{{ Form::label('genero-cb', 'Gênero') }}
					{{ Form::text('genero', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group"> 
					{{ Form::checkbox('classificacao-cb', '1') }}
					{{ Form::label('classificacao-cb', 'Classificação') }}
					{{ Form::text('classificacao', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::label('tipo', 'Tipo de evento')}}
					{{ Form::select('tipo', 
							array(
								't' => 'Todos (Filme, Show, Peça)', 
								'f' => 'Filme',
								'p' => 'Peça',
								's' => 'Show'
							),
							't',
							['class' => 'form-control'] 
						)
					}}
				</div>
					{{ Form::submit('Entrar', ['id' => 'pesquisa-submit', 'class' => 'btn btn-default' ]) }}
				{{ Form::close() }}
			</div>
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