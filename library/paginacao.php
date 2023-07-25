<?php
class Paginacao
{

    private static $instance = NULL;

    public static $modelTotalRegistros;
    public static $modelDados;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Paginacao();
        }
        return self::$instance;
    }


    public function paginacao($totalPorPagina, $modelTotalRegistros = array(), $modelDados = array())
    {

        $url = MontaUrl();

        if (!isset($url[2]) && empty($url[2])) {
            $paginaAtual = 1;
            $paginaAnterior = FALSE;
            $paginaProxima = 2;
        } else {
            $paginaAtual = $url[2];
        }

        #echo 'Total registro Classe Paginacao<pre>';
        #var_dump($modelTotalRegistros);
        #echo '</pre>';

        if (isset($modelTotalRegistros[2])) {
            $totalRegistros = $modelTotalRegistros[0]::{$modelTotalRegistros[1]}($modelTotalRegistros[2]);

            #echo 'Total com parametro Classe Paginacao<pre>';
            #var_dump($totalRegistros);
            #echo '</pre>';

        } else {
            $totalRegistros = $modelTotalRegistros[0]::{$modelTotalRegistros[1]}();

            #echo 'Total SEM parametro Classe Paginacao<pre>';
            #var_dump($totalRegistros);
            #echo '</pre>';
        }


        //Reseta Array
        $totalRegistros = reset($totalRegistros);

        //Busca dados
        if ($paginaAtual == 1) {
            $offset = 0;
        } else {
            $offset = (($paginaAtual - 1) * $totalPorPagina);
        }




        if (isset($modelDados[2])) {
            $registros = $modelDados[0]::{$modelDados[1]}($totalPorPagina, $offset, $modelDados[2]);

            #echo 'Dados com Parametro Classe Paginacao<pre>';
            #var_dump($registros);
            #echo '</pre>';

        } else {
            $registros = $modelDados[0]::{$modelDados[1]}($totalPorPagina, $offset);

            #echo 'Dados SEM Parametro Classe Paginacao<pre>';
            #var_dump($registros);
            #echo '</pre>';
        }

        //calcula o número de páginas arredondando o resultado para cima 
        $numPaginas = ceil($totalRegistros[0] / $totalPorPagina);

        //variavel para calcular o início da visualização com base na página atual 
        $inicio = ($totalPorPagina * $paginaAtual) - $totalPorPagina;


        //Array de informações
        $dados = array(
            'registros' => $registros,
            'totalPaginas' => $numPaginas,
            'offsetInicioPaginaAtual' => $inicio,
            'totalPorPagina' => $totalPorPagina,
            'paginaAtual' => $paginaAtual
        );

        /*echo 'pag<pre>';
        var_dump($dados);
        echo '</pre>';*/

        return $dados;
    } // paginacao

    public function paginacao2($totalPorPagina, $modelTotalRegistros = array(), $modelDados = array())
    {

        $url = MontaUrl();

        if (!isset($url[3]) && empty($url[3])) {
            $paginaAtual = 1;
            $paginaAnterior = FALSE;
            $paginaProxima = 2;
        } else {
            $paginaAtual = $url[3];
        }

        #echo 'Total registro Classe Paginacao<pre>';
        #var_dump($modelTotalRegistros);
        #echo '</pre>';

        if (isset($modelTotalRegistros[2])) {
            $totalRegistros = $modelTotalRegistros[0]::{$modelTotalRegistros[1]}($modelTotalRegistros[2]);

            #echo 'Total com parametro Classe Paginacao<pre>';
            #var_dump($totalRegistros);
            #echo '</pre>';

        } else {
            $totalRegistros = $modelTotalRegistros[0]::{$modelTotalRegistros[1]}();

            #echo 'Total SEM parametro Classe Paginacao<pre>';
            #var_dump($totalRegistros);
            #echo '</pre>';
        }

        /*echo $totalRegistros;
        stop();*/

        //Reseta Array
        //$totalRegistros = reset($totalRegistros);

        //Busca dados
        if ($paginaAtual == 1) {
            $offset = 0;
        } else {
            $offset = (($paginaAtual - 1) * $totalPorPagina);
        }




        if (isset($modelDados[2])) {
            $registros = $modelDados[0]::{$modelDados[1]}($totalPorPagina, $offset, $modelDados[2]);

            #echo 'Dados com Parametro Classe Paginacao<pre>';
            #var_dump($registros);
            #echo '</pre>';

        } else {
            $registros = $modelDados[0]::{$modelDados[1]}($totalPorPagina, $offset);

            #echo 'Dados SEM Parametro Classe Paginacao<pre>';
            #var_dump($registros);
            #echo '</pre>';
        }

        //calcula o número de páginas arredondando o resultado para cima 
        $numPaginas = ceil($totalRegistros / $totalPorPagina);

        //variavel para calcular o início da visualização com base na página atual 
        $inicio = ($totalPorPagina * $paginaAtual) - $totalPorPagina;


        //Array de informações
        $dados = array(
            'registros' => $registros,
            'totalPaginas' => $numPaginas,
            'offsetInicioPaginaAtual' => $inicio,
            'totalPorPagina' => $totalPorPagina,
            'paginaAtual' => $paginaAtual
        );

        /*echo 'pag<pre>';
        var_dump($dados);
        echo '</pre>';*/

        return $dados;
    }

    public function links($totalPaginas)
    {
        $url = MontaUrl();
        if (!isset($url[2]) || empty($url[2]) || !is_int($url[2])) {
            $url[2] = 1;
        }

        $limite_menor = $url[2] - 3;
        $limite_maximo = $url[2] + 3;
        if ($limite_menor < 1) {
            $limite_maximo += -$limite_menor;
            $limite_menor = 1;
        }
        if ($limite_maximo > $totalPaginas) {
            $limite_menor -= ($limite_maximo - $totalPaginas);
            if ($limite_menor < 1) {
                $limite_menor = 1;
            }
            $limite_maximo = $totalPaginas;
        }
        if (isset($url[3]) && !empty($url[3])) {
            if ($limite_menor >= 3) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" href="/' . pastaBase . '/' . $url[1] . '/1/' . $url[3] . '">1</a></li>';
                echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
            } else if ($limite_menor == 2) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/1/' . $url[3] . '">1</a></li>';
            }
            for ($i = $limite_menor; $i <= ($limite_maximo); $i++) {
                $classe = null;
                if ($i == $url[2]) {
                    $classe = 'active';
                } else {
                    $classe = '';
                }
                echo '<li class="page-item ' . $classe . '"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/' . $i . '/' . $url[3] . '">' . $i . '</a></li>';
            }
            if ($limite_maximo <= ($totalPaginas - 2)) {
                echo '<li class="page-item disabled"><a class="page-link" style="background-color: gold; border-color: gold">...</a></li>';
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/' . $totalPaginas . '/' . $url[3] . '">' . $totalPaginas . '</a></li>';
            } else if ($limite_maximo == ($totalPaginas - 1)) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/' . $totalPaginas . '/' . $url[3] . '">' . $totalPaginas . '</a></li>';
            }
        } else {
            if ($limite_menor >= 3) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/1">1</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" style="background-color: gold; border-color: gold">...</a></li>';
            } else if ($limite_menor == 2) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[1] . '/1">1</a></li>';
            }
            for ($i = $limite_menor; $i <= ($limite_maximo); $i++) {
                $classe = null;
                if ($i == $url[2]) {
                    $classe = 'active';
                } else {
                    $classe = '';
                }
                echo '<li class="page-item ' . $classe . '"><a class="page-link" style="background-color: gold; border-color: gold" href="/' . pastaBase . '/' . $url[0] . '/' . $i . '">' . $i . '</a></li>';
            }
            if ($limite_maximo <= ($totalPaginas - 2)) {
                echo '<li class="page-item disabled" style="background-color: gold; border-color: gold"><a class="page-link">...</a></li>';
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" href="/' . pastaBase . '/' . $url[1] . '/' . $totalPaginas . '">' . $totalPaginas . '</a></li>';
            } else if ($limite_maximo == ($totalPaginas - 1)) {
                echo '<li class="page-item" style="background-color: gold; border-color: gold"><a class="page-link" href="/' . pastaBase . '/' . $url[1] . '/' . $totalPaginas . '">' . $totalPaginas . '</a></li>';
            }
        }
    }
}
