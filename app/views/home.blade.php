@extends('layouts.default')

@section('head')
	<title>HELUMA - Home</title>
	<link rel="stylesheet" href="/css/home2.css">
	<link rel="stylesheet" href="/js/jquery.bxslider/jquery.bxslider.css">
	<script src="/js/jquery-1.11.1.min.js"></script>
	<script src="/js/jquery.bxslider/jquery.bxslider.min.js"></script>

	<script>
		$(document).ready(function(){
		  $('.bxslider').bxSlider(
		  	{
				auto: true,
				autoControls: true
			});
		});
	</script>
@stop

@section('body')
	<div id="content">
	@include('layouts.header')
		<div id="container">
			<h2>Filmes</h2>
			<ul class="bxslider">
			@foreach( $filmes as $filme )
				<li>
					<div class="evento">
						<div class="evento-img-container">
							<img src="/imagens/{{ $filme->foto }}" class="evento-img">
						</div>
						<div class="info">
							<div class="info-p">
								<label for="nome">Título:</label>
								<p name="nome">{{ $filme->nome }}</p>
							</div>
							<div class="info-p">
								<label for="genero">Gênero:</label>
								<p name="genero">{{ $filme->genero }}</p>
							</div>
							<div class="info-p">
								<label for="classificacao">Classificação:</label>
								<p name="classificacao"> {{ $filme->classificacao }} </p>
							</div>
							<div class="info-p">
								<label for="sinopse">Sinopse:</label>
								<p name="sinopse"> {{ $filme->filme()->sinopse }}</p>
							</div>
						</div>

					</div>
				</li>
			@endforeach
			</ul>
			
 			<h2>Shows</h2>
			<ul class="bxslider">
			@foreach( $shows as $show )
				<li>
					<div class="evento">
						<div class="evento-img-container">
							<img src="/imagens/{{ $show->foto }}" class="evento-img">
						</div>
						<div class="info">
							<div class="info-p">
								<label for="nome">Título:</label>
								<p name="nome">{{ $show->nome }}</p>
							</div>
							<div class="info-p">
								<label for="genero">Gênero:</label>
								<p name="genero">{{ $show->genero }}</p>
							</div>
							<div class="info-p">
								<label for="classificacao">Classificação:</label>
								<p name="classificacao"> {{ $show->classificacao }} </p>
							</div>
							<div class="info-p">
								<label for="sinopse">Sinopse:</label>
								<p name="sinopse"> {{ $show->show()->descricao }}</p>
							</div>
						</div>
					</div>
				</li>
			@endforeach
			</ul>

			<h2>Peças</h2>
			<ul class="bxslider">
			@foreach( $pecas as $peca )
				<li>
					<div class="evento">
						<div class="evento-img-container">
							<img src="/imagens/{{ $peca->foto }}" class="evento-img">
						</div>
						<div class="info">
							<div class="info-p">
								<label for="nome">Título:</label>
								<p name="nome">{{ $peca->nome }}</p>
							</div>
							<div class="info-p">
								<label for="genero">Gênero:</label>
								<p name="genero">{{ $peca->genero }}</p>
							</div>
							<div class="info-p">
								<label for="classificacao">Classificação:</label>
								<p name="classificacao"> {{ $peca->classificacao }} </p>
							</div>
							<div class="info-p">
								<label for="sinopse">Sinopse:</label>
								<p name="sinopse"> {{ $peca->peca()->sinopse }}</p>
							</div>
						</div>
					</div>
				</li>
			@endforeach
			</ul>
		</div>
	</div>

@stop