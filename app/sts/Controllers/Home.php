<?php

namespace Sts\Controllers;

use Core\ConfigView;
use PDOException;
use Sts\Models\Helpers\Insert;
use Sts\Models\Helpers\Select;
use Sts\Models\Helpers\Session;
use Sts\Models\RegisterUser;
use Sts\Models\VerifyUser;

class Home
{
    /**
     * Dados a ser passados para a view
     * @var array
     */
    private array $data = [];
    /**
     * Dados vindos do formulario
     * @var 
     */
    private ?array $dataForm = null;
    /**
     * Objeto que comporta o Usuario(Cadastro, consulta de dados, etc)
     * @var 
     */
    private ?object $user;

    /**
     * Carrega a pagina Home(index/inicial)
     * @param array|null $urlParametters Parametros da url
     * @return void
     */
    public function index(?array $urlParametters = [])
    {
        $session = new Session();
        $select = new Select();

        if ($session->create()) {
            if (isset($_SESSION['user']) && $_SESSION['user']['status'] = "active") {
                $this->data['user'] = $_SESSION['user'];
            }
        }

        if (isset($_SESSION['user'])) {
            try {
                $pessoaCategorias = $select->selectCat('pessoa', $_SESSION['user']['pessoaId']);

                $produtos = $select->selectAll('produtos');

                foreach ($produtos as $key => $value) {
                    $prodCategorias = $select->selectCat('produto', $value['produtoId']);
                    $produtos[$key]['categorias'] = $prodCategorias;
                }

                foreach ($produtos as $key => $value) {
                    if (!array_diff($value['categorias'], $pessoaCategorias)) {
                        unset($produtos[$key]);
                    }
                }

                $produtos = array_values($produtos);

                for ($i = 0; $i < count($produtos); $i++) {
                    $prevValue = count($produtos[$i]['categorias']);
                    for ($j = $i + 1; $j < count($produtos); $j++) {
                        $nextValue = count($produtos[$j]['categorias']);
                        if ($prevValue < $nextValue) {
                            $helper = $produtos[$i];
                            $produtos[$i] = $produtos[$j];
                            $produtos[$j] = $helper;
                        }
                    }
                }

                $this->data['produtos'] = array_slice($produtos, 0, 3);

            } catch (PDOException $err) {
                $this->data['err'] = $err->getMessage();
            }
        }

        $loadView = new ConfigView("sts/Views/Home/main", $this->data);
        $loadView->renderView();
    }

    /**
     * Carrega a pagina de login de usuario
     * @param array|null $urlParameters 
     * @return void
     */
    public function login(array $urlParameters = [])
    {
        // Pega os dados vindo por post do formulario
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verifica se tem uma request
        if (isset($this->dataForm['request'])) {
            // Exclui a request
            unset($this->dataForm['request']);

            try {

                // Chama a classe user
                $this->user = new VerifyUser($this->dataForm);
                // verifica se o usuario vindo do form está cadastrado no sistema
                $userData = $this->user->verifyUser($this->dataForm['email'], $this->dataForm['pass']);
                // var_dump($_SESSION);

                // Caso o usuario estiver cadastrado ele cria a sessão e loga o usuario
                if (!empty($_SESSION) && $_SESSION['user']['status'] == "active") {
                    header("location:" . DEFAULT_URL);
                }

                // Caso não ele retorna o resultado como um erro
                $this->data['result'] = "Email ou Senha incorretos!";
            } catch (PDOException $err) {
                // Caso haja algum erro na classe do banco ele retorna o codigo de erro e os dados do formulario 
                $this->data['result'] = $err->getCode();
                // $this->data['result'] = $err->getMessage();
                $this->data['form'] = $this->dataForm;
            }
        }

        // Caso tenha alguma variavel no Get ele manda
        // mais usado para confirmar o cadastro do usuario quando for redirecionado
        if (!empty($urlParameters)) {
            $this->data['result'] = (!empty($urlParameters['result'])) ? $urlParameters['result'] : null;
        }

        // var_dump($this->data);

        // Carrega a view
        $loadView = new ConfigView("sts/Views/acesso/login/log", $this->data);
        $loadView->renderView();
    }

    /**
     * Carrega a pagina de cadastro de usuario
     * @param array|null $urlParametters
     * @return void
     */
    public function cadastro(array $urlParameters = [])
    {
        // Pega os dados vindo por post do formulario
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);

        // Verifica se tem um request
        if (isset($this->dataForm['registerUser'])) {
            // Deleta a request
            unset($this->dataForm['registerUser']);

            try {
                // Seta a classe de usuario
                $this->user = new RegisterUser($this->dataForm);
                // Registra o usuario
                $this->user->registerUser($this->dataForm);

                // se der certo ele retorna um codigo de succeed 
                $this->data['result'] = "succeed";
            } catch (PDOException $err) {
                // Caso der algum erro na classe do banco ele retorna o codigo e os dados do formulario
                $this->data['result'] = $err->getCode();
                $this->data['form'] = $this->dataForm;
            }
        }

        if (isset($this->data['result']) && $this->data['result'] == "succeed") {
            header("location:" . DEFAULT_URL . "Home/categorias?nome=" . $this->dataForm['name']);
        }

        // Carrega a pagina/View
        $loadView = new ConfigView("sts/Views/acesso/cadastro/cad", $this->data);
        $loadView->renderView();
    }

    public function categorias(array $urlParameters = [])
    {
        $select = new Select();
        $insert = new Insert();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($this->dataForm['submit'])) {
            unset($this->dataForm['submit']);

            try {
                $this->data['result'] = $insert->insertCategories('pessoas', $this->dataForm['categorias'], $urlParameters['nome']);
            } catch (PDOException $err) {
                $this->data['result'] = $err->getCode();
                $this->data['err'] = $err->getMessage();
            }
        }

        if (isset($this->data['result']) && $this->data['result'] == "success") {
            header("location:" . DEFAULT_URL . "Home/login?result=success");
        }

        try {
            $this->data['categorias'] = $select->selectAll('categorias');
        } catch (PDOException $err) {
            $this->data['err'] = $err->getMessage();
        }

        $loadView = new ConfigView("sts/Views/preferidos/pref-categorias", $this->data);
        $loadView->renderView();
    }

    public function sobre(): void
    {
        $session = new Session;
        $session->create();

        $loadView = new ConfigView("sts/Views/sobre/sobre", $this->data);
        $loadView->renderView();
    }

    /**
     * Desloga o usuario
     * @param array $urlParameters
     * @return void
     */
    public function sair(array $urlParameters = [])
    {
        // Verifica se tem alguma sessão ativa
        // Se não tiver ele seta uma para apagar os dados da variavel de sessão
        // e destruir ela
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            // echo "hello";

            unset($_SESSION['user']);
            session_destroy();
        }
        header("location:" . DEFAULT_URL);
    }

}