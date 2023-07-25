<div class="main__title">
  <img src="assets/hello.svg" alt="" />
  <div class="main__greeting">
    <h1>Bairros</h1>
    <a href="<?php pastaBase; ?>">Página Inicial</a> / <a href="#">Bairros </a>
  </div>
</div>
<table id="tableOrder" class="full margin-top-1">
  <thead>
    <tr>
      <th>NOME</th>
      <th>CEP'S SITUADOS NESTE BAIRRO</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (isset($bairros['registros']) && count($bairros['registros']) > 0) {
      foreach ($bairros['registros'] as $key => $bairro) { ?>
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
<?php if (isset($bairros['registros']) && count($bairros['registros']) > 0) {
  $paginacao->links($bairros['totalPaginas']); ?>
<?php } ?>