<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center">Registro de Novo Cliente</h3>

            <form action="?a=criar_cliente" method="post">

            <!-- email -->
            <div class="my-3">
                <label>Email</label>
                <input type="email" name="text_email" placeholder="Email" class="form-control" required>
            </div>

            <!-- senha1 -->
            <div class="my-3">
                <label>Senha</label>
                <input type="password" name="text_senha1" placeholder="Senha" class="form-control" required>
            </div>

            <!-- senha2 -->
            <div class="my-3">
                <label>Repetir a Senha</label>
                <input type="password" name="text_senha2" placeholder="Repetir a Senha" class="form-control" required>
            </div>

            <!-- nome completo -->
            <div class="my-3">
                <label>Nome completo</label>
                <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required>
            </div>

            <!-- endereço -->
            <div class="my-3">
                <label>Endereço</label>
                <input type="text" name="text_endereco" placeholder="Endereço" class="form-control" required>
            </div>

            <!-- cidade -->
            <div class="my-3">
                <label>Cidade</label>
                <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" required>
            </div>

            <!-- telefone -->
            <div class="my-3">
                <label>Telefone</label>
                <input type="text" name="text_telefone" placeholder="Telefone" class="form-control" >
            </div>

            <!-- sunmit -->
            <div class="my-4">
                <input type="submit" value="Criar conta" class="btn btn-primary">
            </div>




            </form>

            

        </div>
    </div>
</div>

<!-- 
    email *
	senha_1 *
	senha_2 *
	nome_completo *
	endereco *
	cidade *
	telefone
	
 -->