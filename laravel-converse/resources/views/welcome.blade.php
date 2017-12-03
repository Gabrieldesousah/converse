@extends('layouts.app')

@section('content')

   <div id="headerwrap">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-8 col-lg-offset-2">
				<div style="margin-top: 9%;"><br></div>
        			<img width="100" src="{{ asset('img/logo.png') }}"/>
        			<h1>Seu M&eacute;rito</h1>
        			<h2>
        			    Sua plataforma colaborativa de <span class="typer" data-delay="100" data-words="provas, listas, resumos, resoluções, aulas" data-colors="white"></span><span class="cursor" data-owner="first-typer"></span><br> 
        			    <a style="text-decoration: none; color: #fff" href="{{ url('/share/material') }}">Contribua para um maior acervo.</a>
        			</h2>
            		<form action="{{ url('/search/key') }}" method="GET">
            			<input type="text" name="key" class="search-input" placeholder="Pesquisar por nome  do professor, conteúdo ou tópicos">
            			}
            		</form>
                    <br>
				</div>
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- headerwrap -->


	
	<!-- Contents -->
	<div id="dg">
		<div class="container">
			<div class="row centered">
                @foreach($contents as $content)
		        <div class="col-lg-4">
		            <div class="box-option">
		                <div class="box-top">
		                    <div class="box-header">
		                    	<span class="box-title">{{ $content->name }}</span>
		                    </div>
		                </div>
		                <a href="{{ url('/contents') }}/{{ $content->name }}" class="box-signup">Ver mais</a>
		            </div>
		        </div>
		        @endforeach
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- DG -->


	<div id="blue">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-8 col-lg-offset-2">
    				<h2>De universit&aacute;rios para universit&aacute;rios</h2>
    
    				<p>Estamos trabalhando para conseguir o m&aacute;ximo de conte&uacute;do para voc&ecirc;.
    				Aproveite e compartilhe o que voc&ecirc; j&aacute; possui. &Eacute; ajudando que se recebe ajuda ;)</p>
    	    		<br>
    				<div class="box-option">
    				   <a href="<!--?php echo ROOT-->share/material" class="box-signup">Compartilhe</a>
    				</div>
		        </div>
		    </div>
		</div>
	</div><!-- container -->


	<!-- About -->
	<div id="dg">
		<div class="container">
			<h2>Sobre</h2>
			<div class="container">
				<p>
				O Seu Mérito é uma plataforma de crowdsourcing, 
				ou seja, um site colaborativo feito de alunos para alunos. 
				Faça sua contribuição upando suas provas para que possamos 
				disponibilizar a vocês, de forma gratuita,
				o maior acervo de provas do mundo. 
	            <br>
	            Nossa plataforma é aberta a qualquer pessoa ou curso que deseje 
	            colaborar com essa preservação de conhecimento.
                </p>
        	</div>
		</div><!-- container -->
	</div><!-- DG -->

	<!-- How -->
	<div id="blue">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-8 col-lg-offset-2">
    				<h2>Como funciona</h2>
    				<p>
    				É simples e rápido. 
    				Basta enviar uma prova para nosso sistema 
    				que automaticamente ela estará disponível para qualquer usuário.
    				Você também pode visualizar qualquer prova online 
    				ou realizar o download da mesma.
                    <br>
                     <!-- Nossa plataforma ainda te dá a oportunidade de comprar aulas particulares de nossos usuários, ou se preferir ofertar suas próprias aulas. Você também tem a opção de comercializar a sua resolução da prova. -->
                    </p>
		        </div>
		    </div>
		</div>
	</div><!-- container -->

@endsection