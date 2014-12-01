@extends('layouts.default')

@section('head')
	<title>HELUMA - Home</title>
	<link rel="stylesheet" href="/css/home.css">
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
			<ul class="bxslider">
				<li>
					<div class="evento-container">
						<h2>Filmes</h2>
						<div id="filme" class="evento">
							<img src="/imagens/planetadosmacacos2.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Planeta dos Macacos - O Confronto</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Ação</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Peças</h2>
						<div id="peca" class="evento">
							<img src="/imagens/inespereira.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">A Farsa de Inês Pereira</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Comédia</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">10 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Shows</h2>
						<div id="show" class="evento">
							<img src="/imagens/edguy.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Edguy - Apresentação</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Rock Paulera</p>
								</div>
								<div class="info-p">	
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<ul class="bxslider">
				<li>
					<div class="evento-container">
						<h2>Filmes</h2>
						<div id="filme" class="evento">
							<img src="/imagens/planetadosmacacos2.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Planeta dos Macacos - O Confronto</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Ação</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Peças</h2>
						<div id="peca" class="evento">
							<img src="/imagens/inespereira.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">A Farsa de Inês Pereira</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Comédia</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">10 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Shows</h2>
						<div id="show" class="evento">
							<img src="/imagens/edguy.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Edguy - Apresentação</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Rock Paulera</p>
								</div>
								<div class="info-p">	
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<ul class="bxslider">
				<li>
					<div class="evento-container">
						<h2>Filmes</h2>
						<div id="filme" class="evento">
							<img src="/imagens/planetadosmacacos2.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Planeta dos Macacos - O Confronto</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Ação</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Peças</h2>
						<div id="peca" class="evento">
							<img src="/imagens/inespereira.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">A Farsa de Inês Pereira</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Comédia</p>
								</div>
								<div class="info-p">
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">10 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="evento-container">
						<h2>Shows</h2>
						<div id="show" class="evento">
							<img src="/imagens/edguy.jpg" class="evento-img">
							<div class="info">
								<div class="info-p">
									<label for="nome">Título:</label>
									<p name="nome">Edguy - Apresentação</p>
								</div>
								<div class="info-p">
									<label for="genero">Gênero:</label>
									<p name="genero">Rock Paulera</p>
								</div>
								<div class="info-p">	
									<label for="classificacao">Classificação:</label>
									<p name="classificacao">16 anos </p>
								</div>
								<div id="info-p">
									<label for="sinopse">Sinopse:</label>
									<p name="sinopse"> Dez anos após a conquista da liberdade, César (Andy Serkis) e os demais macacos vivem em paz na floresta próxima a San Francisco. Lá eles desenvolveram uma comunidade própria, baseada no apoio mútuo, enquanto os humanos enfrentam uma das maiores epidemias de todos os tempos, causada por um vírus criado em laboratório. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>

@stop