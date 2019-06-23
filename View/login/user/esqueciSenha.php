<?php include '../../Templates/header.php'?>
<form class="form" action="/corretora/Controller/esqueciSenhaController.php?acao=update&usuario=" method="POST" id="registrationForm">
        
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Insira seu nome ( O mesmo usado em seu cadastro)</h4></label>
                                <input type="text" class="form-control" name="nome"  placeholder="Insira seu nome" title="Insira seu nome." required>
                            </div>
                            <div class="col-xs-6">
                                <label for="email"><h4>Insira seu Email</h4></label>
                                <input type="email" class="form-control" name="usuario"  placeholder="Insira seu email" title="Insira seu email." required>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            
                            
                        </div>
                        <div class="form-group">
                            
                        
                            <div class="col-xs-6">
                                <label for="password" ><h4>Insira a nova Senha</h4></label>
                                <input type="password" class="form-control" name="senha_nova"  placeholder="Nova senha" title="Insera sua nova senha." required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                    <br>
                                    <button  class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
                                    <a class="pull-right"  ></i> Salvar</a></button>
                                    
                                </div>
                        </div>
                    </form>