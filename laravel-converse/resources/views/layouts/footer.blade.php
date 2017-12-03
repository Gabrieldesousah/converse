<!-- FOOTER 
<div id="f">
	<div class="container">
		<div class="row centered">
    	    <div class="col-lg-12">
        	    <br><br>
        	    
        	   <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=294663650950601";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
        		
        		
        		<div class="fb-share-button" data-href="https://www.facebook.com/seumerito" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fseumerito&amp;src=sdkpreparse">Compartilhar</a></div>
        		
        		<br>
        		<!--<a href="#"><i class="fa fa-twitter"></i></a
        		<a href="https://www.facebook.com/seumerito" target="_blanck" title="Nossa página no Facebook"><i class="fa fa-facebook"></i></a>
        		<!--<a href="https://instagram.com/seumerito/" target="_blanck" title="Nossa página no Instagram"><i class="fa fa-instagram"></i></a>
    	    </div>
	    </div>
	</div>
    </div><!-- container 
</div><!-- Footer -->




<!-- MODAL FOR LOGIN -->
<!-- Modal -->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Entrar</h4>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <div class="row centered">
                        <div class="col-lg-12">
                            <!--a  href="#" class="btn btn-primary large">Entrar com Facebook</a-->
                        </div>
                        <div class="col-lg-12">
                            <input name="email" id="email" value="" placeholder="E-mail" class="form-control" type="email">
                        </div>
                        <div class="col-lg-12">
                            <input name="password" id="pas" value="" placeholder="Senha" class="form-control" type="password">
                        </div>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-danger" value="enviar">
                        </div>

                        <br>
                        
                        <div class="col-lg-12">
                            <a href="#">Não é cadastrado? Clique aqui</a>
                        </div>
                    </div>   
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-61679208-4', 'auto');
	ga('send', 'pageview');
</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/typer.js') }}"></script>
</body>
</html>