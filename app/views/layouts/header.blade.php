		<div id="header">
			<div id="heluma" class="header">
				<h1>
					HELUMA 
				</h1>
			</div>
			<div id="header-search" class="header">
				{{ Form::open(['url' => 'pesquisa']) }}
				<div class="input-group"> 
					{{ Form::text('pesquisa', null, ['class' => 'form-control' , 'placeholder' => 'Pesquise aqui']) }}
					<span id="search_span" class="input-group-btn">
						{{ Form::submit('Pesquisar', ['class' => 'btn btn-default']) }}
					</span>
				</div>
				{{ Form::close() }}
				<a href="/pesquisa/avancada">Pesquisa avançada</a>
			</div>
			<div id="text" class="header">
				<ul>
					@if ( Autenticador::logado() )
						<li> {{ Autenticador::cliente()->nome }} </li>
						<li><a href="/sair">Sair</a></li>
					@else
						<li><a href="/login">Login</a></li>
						<li><a href="/cadastro">Cadastro</a></li>
					@endif
				</ul>		
			</div>
		</div>