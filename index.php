<?php include('config/config.php');
		
		session_start();//INICIA SESSÃO
		if($_SESSION){
			//$_SESSION['email'] =  '';
			$_SESSION['senha'] =  '';
			//unset($_SESSION['email']); 
			unset($_SESSION['senha']); 
			//var_dump($_SESSION);
			unset($_COOKIE);
			//session_destroy();
		}
?>
<!doctype html>
<p>Bem-Vindo, para acessar o conteúdo você precisa se autenticar</p>
       <div class="control-group">
           <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
                <input type="text" id="inputEmail" placeholder="Email">
             </div>
       </div>
       <div class="control-group">
          <label class="control-label" for="inputPassword">Senha</label>
             <div class="controls">
                <input type="password" id="inputPassword" placeholder="Password">
             </div>
       </div>
       <div class="control-group">
           <div class="controls">
             <label class="checkbox">
               <input type="checkbox"> lembrar-me
             </label>
             <button type="submit" class="btn btn-small btn-primary">Login</button>
             <button type="submit" class="btn btn-danger">Cancela</button>
           </div>
        </div>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>:: LOGIN :: Lojas Calçados</title>

	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- ESTILO DA PAGINA -->
    <link href="css/style_loja.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

<?php 
			$query = mysql_query('SELECT senha,usuario FROM Funcionario');
			$num_rows = mysql_num_rows($query );
			
		
			if (isset($_POST['login']) && ($_POST['login'] == 'Logar')){
				
		
			$erro 		= '';
			$usuario 	= trim($_POST['usuario']);
			$senha 		= trim($_POST['senha']);
			$_SESSION['usuario'] =  $usuario;
			$_SESSION['senha'] =  $senha;
			
		
		if (empty($usuario)){
			$erro = "<strong >Atenção!</strong> Por favor <b>".$_SESSION['usuario']."</b> preencha o campo usuário";
			}
		elseif (empty($senha)){
			$erro = "<strong >Atenção!</strong> Por favor <b>".$_SESSION['usuario']."</b> preencha o campo senha";
			}	
		else{
		
			$query_pega_user = mysql_query("SELECT usuario FROM Funcionario WHERE usuario = '".$_SESSION['usuario']."'");
			$qdUser = mysql_num_rows($query_pega_user);
			
			if ($qdUser == 1){
				$query_valida_senha = mysql_query("SELECT senha FROM Funcionario WHERE senha = '".$_SESSION['senha']."'");
				$qdValSenhaUsuario = mysql_num_rows($query_valida_senha);
			}
			
			if ($qdUser == 0):
				$erro = 'Atenção! <strong>( '.$usuario.' )</strong>'.' Usuário ou senha incorretos, entre em contato com a administração';
					$_SESSION['usuario'] =  '';
					$_SESSION['senha'] =  '';
					unset($_SESSION['usuario']); 
					unset($_SESSION['senha']); 
					session_destroy();
			endif;
			
			if (($qdUser == 1) && ($qdValSenhaUsuario == 0)):
				$erro = '<strong>Senha incorreta:</strong> a senha que você digitou está incorreta. Tente novamente (tenha certeza de que a função Caps Lock está desligada). <br /><br />Ou entre em contato com a administração';
					$_SESSION['email'] =  '';
					$_SESSION['senha'] =  '';
					unset($_SESSION['email']); 
					unset($_SESSION['senha']); 
					session_destroy();
			endif;
	
				
			if (($qdUser == 1) && ($qdValSenhaUsuario == 1)):
				//header("Location: www.agenciacriamais.com.br");
				$erro = 'Olá, seja bem vindo - Logado com sucesso!';
			endif;
			
			
			if ($qdUser > 1):
				$erro = 'Entre em contato com a diretoria, pois existe 2 usuários com mesmo e-mail cadastrado';
					$_SESSION['email'] =  '';
					$_SESSION['senha'] =  '';
					unset($_SESSION['email']); 
					unset($_SESSION['senha']); 
					session_destroy();
			endif;	
				
			}
		var_dump($_SESSION);
			
	}
	
	?>
		
   <div class="container" style="margin-top:10%;">
   <div class="row">
       <div class="col-xs-offset-4 col-md-4" style="padding:20px; border:solid 1px #f5f5f5; border-radius:7px;">
   					
                    <?php if (!empty($erro)){ ?>	
                    <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $erro;?>
                    </div>
                    <?php }?>
    
    		<form action="" class="form-signin" method="post">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">Usuário </label><br />
            <input type="text" class="form-control" placeholder="Usuário" required autofocus name="usuario">
            <label for="inputPassword" class="sr-only">Senha</label><br />
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required name="senha"><br />
            <input class="btn btn-lg btn-primary btn-block" name="login" type="submit" value="Logar">
          </form>
          
        </div>
    </div>
    </div> <!-- /container -->
        
        
 
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
