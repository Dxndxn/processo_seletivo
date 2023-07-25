<div class="main__title">
  <img src="assets/hello.svg" alt="" />
  <div class="main__greeting">
    <h1>Relatórios</h1>
    <a href="<?php pastaBase; ?>">Página Inicial</a> / <a href="#">Relatórios </a>
  </div>
</div>
<hr class="margin-top-1">
<h6 class="margin-top-1">CLIENTES</h6>
<div class="faqs-item  margin-top-1">
  <a class="faqs-title" href="#custom">
    FILTROS
  </a>
  <div class="faqs-content">
    <div class="faqs-content-inside">
      <form role="form" action="<?= urlOnline . 'relatorios/1/q'; ?>" method="GET">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>NOME:</label>
              <input type="text" name="CLIENTE_NOME" id="CLIENTE_NOME" class="form-control" value="<?= (!empty($filtros['CLIENTE_NOME']) && $filtros['CLIENTE_NOME']) ? $filtros['CLIENTE_NOME'] : ''; ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group margin-top-1">
              <label>CPF:</>
                <input type="text" name="CLIENTE_CPF" id="CLIENTE_CPF" class="form-control" value="<?= (!empty($filtros['CLIENTE_CPF']) && $filtros['CLIENTE_CPF']) ? $filtros['CLIENTE_CPF'] : ''; ?>">
            </div>
          </div>
        </div>
        <button type="submit" class="button-opinionBox float-right margin-top-1 text-up">FILTRAR</button>
        <a class="button-black float-right margin-top-1 text-up" href=" <?= urlOnline ?>relatorios">LIMPAR FILTROS</a>
        <br>
      </form>
      <br>
    </div>
  </div>
</div>
<table id="tableOrder" class="full">
  <thead>
    <tr>
      <th>NOME</th>
      <th>CPF</th>
      <th>CEP</th>
      <th>ENDEREÇO</th>
      <th>NÚMERO</th>
      <th>BAIRRO</th>
      <th>CIDADE</th>
      <th>ESTADO</th>
      <th>ATIVO</th>
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
          <td><?= $cliente['CLIENTE_ENDERECO']; ?></td>
          <td><?= $cliente['CLIENTE_NUMERO']; ?></td>
          <td><?= $cliente['CLIENTE_BAIRRO']; ?></td>
          <td><?= $cliente['CLIENTE_CIDADE']; ?></td>
          <td><?= $cliente['CLIENTE_ESTADO']; ?></td>
          <td><?php if ($cliente['CLIENTE_ATIVO'] == 0) {
                echo "NÃO";
              } else {
                echo "SIM";
              }  ?></td>
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
  </tbody>
</table>
<hr class="margin-top-1">
<h6 class="margin-top-1">BAIRROS</h6>
<table id="tableOrder" class="full margin-top-1">
  <thead>
    <tr>
      <th>NOME</th>
      <th>CEP'S SITUADOS NESTE BAIRRO</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (isset($bairros) && count($bairros) > 0) {
      foreach ($bairros as $key => $bairro) { ?>
        <tr>
          <td><?php echo formataCpf($bairro['BAIRRO_NOME']); ?></td>
          <td><?php echo formataCep($bairro['COUNT(brrc.BAIRRO_CEP_DESC)']); ?></td>
        </tr>
      <?php }
    } else { ?>
      <tr>
        <td colspan="9" align="center">Não foram encontrados bairros cadastrados.</td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>