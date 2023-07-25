<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>





<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Clientes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Página Inicial</a></li>
          <li class="breadcrumb-item active">Clientes</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark collapsed-card">
          <div class="card-header" data-card-widget="collapse" title="Collapse">
            <h3 class="card-title">Filtros</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body" style="display: none;">
            <form role="form" action="<?= urlOnline . 'solicitacoes/1/q'; ?>" method="GET">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="unidade">Código:</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="<?= (!empty($filtros['codigo']) && $filtros['codigo']) ? $filtros['codigo'] : ''; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="unidade_origem">Unidade de Origem:</label>
                    <select class="form-control select2" id="unidade_origem" name="unidade_origem">
                      <option value="">Selecione...</option>
                      <?php
                      foreach ($unidades as $key => $unidade) {
                        echo "<option value='" . $unidade[0] . "''>" . $unidade[1] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="unidade_destino">Unidade de Destino:</label>
                    <select class="form-control select2" id="unidade_destino" name="unidade_destino">
                      <option value="">Selecione...</option>
                      <?php
                      foreach ($unidades as $key => $unidade) {
                        echo "<option value='" . $unidade[0] . "''>" . $unidade[1] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="tipo">Tipo de Remoção:</label>
                    <select class="form-control select2" id="tipo" name="tipo">
                      <option value="">Selecione...</option>
                      <?php
                      foreach ($tipo as $key => $tipos) {
                        echo "<option value='" . $tipos[0] . "''>" . $tipos[1] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control select2" id="status" name="status">
                      <option value="">Selecione...</option>
                      <?php
                      foreach ($statuss as $key => $status) {
                        echo "<option value='" . $status[0] . "''>" . $status[1] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="unidade">Data:</label>
                    <input type="date" name="data" id="data" class="form-control" value="<?= (!empty($filtros['data']) && $filtros['data']) ? $filtros['data'] : ''; ?>">
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
                  <a type="button" href="<?= urlOnline . 'solicitacoes/1'; ?>" class="btn btn-default float-left">Limpar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card card-dark">
          <div class="card-body p-0">
            <table id="tableOrder" class="table table-striped">
              <thead>
                <tr>
                  <th>CÓDIGO</th>
                  <th>REMOÇÃO</th>
                  <th>DATA</th>
                  <th>STATUS</th>
                  <th>ORIGEM</th>
                  <th>DESTINO</th>
                  <th>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($clientes['registros']) && count($clientes['registros']) > 0) {
                  foreach ($clientes['registros'] as $key => $cliente) { ?>
                    <tr>
                      <td><?= $cliente[0]; ?></td>
                      <?php
                      if (Autenticacao::user()->USU_REL_NIVEL != 20) {
                      ?>
                        <td><?= $cliente[15]; ?> | <?= $cliente[16]; ?></td>
                      <?php
                      }
                      ?>
                      <td><?= $cliente[2]; ?></td>
                      <td><?= inverteData($cliente[3]); ?></td>
                      <td><?= $cliente[5]; ?></td>
                      <td><?= $cliente[7]; ?></td>
                      <td><?= $cliente[9]; ?></td>
                      <td>
                        <?php
                        if (($cliente[4] == 9) || ($cliente[4] == 10) || ($cliente[4] == 14) || ($cliente[4] == 12)) {
                        ?>
                          <a href="\<?php echo pastaBase; ?>\solicitacoes\retornos\<?= $cliente[0]; ?>" class="btn btn-info">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                          </a>
                        <?php
                        } else {
                        ?>
                          <a href="\<?php echo pastaBase; ?>\solicitacoes\view\<?= $cliente[0]; ?>" class="btn btn-info">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                          </a>
                        <?php
                        }
                        ?>
                        <?php
                        if ($cliente[4] == 10 && $cliente[14] != NULL) {
                        ?>
                          <a href="\<?php echo pastaBase; ?>\solicitacoes\termos\<?= $cliente[0]; ?>" class="btn btn-info" data-toggle="tooltip" title="Assinar termo de exercício.">
                            <i class="fas fa-pen"></i>
                          </a>
                        <?php
                        }
                        ?>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="9" align="center">Não foi encontrado nenhuma movimentação</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?php if (isset($clientes['registros']) && count($clientes['registros']) > 0) {
                $paginacao->links($clientes['totalPaginas']); ?>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="float-right">
      <a style="color: white" type="button" href="<?= urlOnline . 'solicitacoes/novo'; ?>" class="btn btn-warning float-left"><i class="fa fa-plus"></i> Solicitar Remoção</a>
    </div>
  </div>
</section>