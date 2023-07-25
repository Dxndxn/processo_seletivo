<div class="main__title">
  <img src="assets/hello.svg" alt="" />
  <div class="main__greeting">
    <h1>Clientes</h1>
    <a href="<?php pastaBase; ?>">Página Inicial</a> / <a href="#">Clientes </a>
  </div>
</div>
<table id="tableOrder" class="full margin-top-1">
  <thead>
    <tr>
      <th>NOME</th>
      <th>CPF</th>
      <th>CEP</th>
      <th>AÇÃO</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (isset($clientes['registros']) && count($clientes['registros']) > 0) {
      foreach ($clientes['registros'] as $key => $cliente) { ?>
        <tr>
          <td><?= $cliente['CLIENTE_NOME']; ?></td>
          <td><?php echo formataCpf($cliente['CLIENTE_CPF']); ?></td>
          <td><?php echo formataCep($cliente['CLIENTE_CEP']); ?></td>
          <td>
            <a href="<?php echo urlOnline; ?>clientes\edit\<?php echo $cliente['CLIENTE_ID'] ?>" class="button-black">
              <i class="bx bx-pen"></i> Editar Cliente
            </a>
            <a href="<?php echo urlOnline; ?>clientes\delete\<?php echo $cliente['CLIENTE_ID'] ?>" class="button-opinionBox">
              <i class="bx bx-trash"></i> Excluir Cliente
            </a>
          </td>
        </tr>
      <?php }
    } else { ?>
      <tr>
        <td colspan="9" align="center">Não foram encontrados clientes cadastrados.</td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<a type="button" class="button-opinionBox float-right margin-top-1 text-up" href=" <?= urlOnline . 'clientes/new'; ?>"><i class="bx bx-plus"></i> Cadastrar novo cliente</a>