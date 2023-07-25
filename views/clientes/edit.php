<form action="/<?= pastaBase . '/clientes/update/' . $cliente['CLIENTE_ID']; ?>" method="POST">
    <div class="margin-top-1">
        <label>Nome:</label>
        <input type="text" placeholder="Nome completo" id="CLIENTE_NOME" name="CLIENTE_NOME" value="<?php echo $cliente['CLIENTE_NOME'] ?>" required>
    </div>
    <div class="margin-top-1">
        <label>CPF:</label>
        <input type="text" placeholder="CPF" id="CLIENTE_CPF" name="CLIENTE_CPF" value="<?php echo $cliente['CLIENTE_CPF'] ?>" required>
    </div>
    <div class="margin-top-1">
        <label>CEP:</label>
        <input type="text" placeholder="CEP" id="CLIENTE_CEP" name="CLIENTE_CEP" value="<?php echo $cliente['CLIENTE_CEP'] ?>" required>
    </div>
    <div class="margin-top-1">
        <label>Endereço:</label>
        <input type="text" placeholder="Endereço" id="CLIENTE_ENDERECO" name="CLIENTE_ENDERECO" value="<?php echo $cliente['CLIENTE_ENDERECO'] ?>" readonly>
    </div>
    <div class="margin-top-1">
        <label>Numero:</label>
        <input type="text" placeholder="Número" id="CLIENTE_NUMERO" name="CLIENTE_NUMERO" value="<?php echo $cliente['CLIENTE_NUMERO'] ?>" required>
    </div>
    <div class="margin-top-1">
        <label>Bairro:</label>
        <input type="text" placeholder="Bairro" id="CLIENTE_BAIRRO" name="CLIENTE_BAIRRO" value="<?php echo $cliente['CLIENTE_BAIRRO'] ?>" readonly>
    </div>
    <div class="margin-top-1">
        <label>Cidade:</label>
        <input type="text" placeholder="Cidade" id="CLIENTE_CIDADE" name="CLIENTE_CIDADE" value="<?php echo $cliente['CLIENTE_CIDADE'] ?>" readonly>
    </div>
    <div class="margin-top-1">
        <label>Estado:</label>
        <input type="text" placeholder="Estado" id="CLIENTE_ESTADO" name="CLIENTE_ESTADO" value="<?php echo $cliente['CLIENTE_ESTADO'] ?>" readonly>
    </div>
    <div class="margin-top-1">
        <label>Ativo:</label>
        <select name="CLIENTE_ATIVO" required id="CLIENTE_ATIVO">
            <option value="0">
                Não
            </option>
            <option value="1" selected>
                Sim
            </option>
        </select>
    </div>
    <button type="submit" class="button-opinionBox float-right margin-top-1 text-up">INSERIR</button>
    <a class="button-black float-right margin-top-1 text-up" href="<?= urlOnline ?>">VOLTAR</a>
</form>