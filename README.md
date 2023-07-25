# processo_seletivo
Processo Seletivo - Opinion Box

## ATENÇÃO
*******
Para o funcionamento correto do sistema, o arquivo 'CONSTANTS.PHP' localizado em 'processo_seletivo/funcoes/constants.php' deve ser alterado com os respectivos itens:

DEFINE('urlOnline', 'http://127.0.0.1/processo_seletivo/');  --- URL /NOME DA PASTA NO QUAL O SISTEMA IRÁ RODAR.
DEFINE('pastaBase', 'processo_seletivo'); /NOME DA PASTA NO QUAL O SISTEMA IRÁ RODAR.

Além, da importação do banco de dados para que os registros sejam listados. Sendo que, para a alteração do mesmo, altere o arquivo localizado em 'processo_seletivo/connection.php'

self::$instance = new PDO('mysql:host=localhost;dbname=processo_seletivo;charset=utf8', 'root', '', $pdo_options); --- DBNAME = NOME DO BANCO DE DADOS



## SOBRE O SISTEMA 
*******
  >*sistema foi desenvolvido no padrão MVC (Models, Views e Controllers), as Models são responsáveis pelas requisições no banco de dados, onde há um CRUD que estabelece o seguinte padrão: 

- READ
  
  >*A visualização dos dados, permite a analise dos dados de todos os clientes cadastrados, além dos bairros que possuem mais de um CEP associados a eles. 

- CREATE 

  >*Para cadastrar um novo cliente é verificado se o CPF (identificador) é existente, se existir, é exibido para o usuário uma mensagem informado que o mesmo já está cadastrado, se não, o cliente é inserido e há uma verificação em razão do Bairro do mesmo, onde, se esse, for existente (existir outro cliente habitante do mesmo bairro) não há a inserção dele no banco de dados dos bairros, porém, se for existente, não. Além de inserir o CEP deste novo cliente à tabela auxiliar dos CEP’s de cada bairro. 

- UPDATE

  >*A atualização de um cliente é similar a inserção, há uma verificação em razão do novo Bairro do cliente, para saber se é existente ou não, se for, apenas altera o CEP no cadastro do cliente e na tabela auxiliar, se não, cadastra um novo Bairro e um novo CEP auxiliar. 

- DELETE

  >*A exclusão de um cliente, se baseia também na exclusão de seu bairro (caso ele seja o único residente deste), se não, apenas a exclusão de seu CEP na tabela auxiliar (que vincula os CEPs aos bairros).

  >*Já as views são literais, é tudo aquilo que o úsuario pode "ver", ou seja, as telas e demais elementos gráficos do sistema, sendo que o Controller é quem realiza a comunicação desses elementos (front-end), com as Models (back-end).
