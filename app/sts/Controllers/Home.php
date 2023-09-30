<?php

namespace Sts\Controllers;

use Core\ConfigView;
use PDOException;
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
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();

            if (!empty($_SESSION) && $_SESSION['user']['status'] = "active") {
                $this->data['user'] = $_SESSION['user'];
            }
        }

        $loadView = new ConfigView("sts/Views/Home/main", $this->data);
        $loadView->renderView();
    }

    /**
     * Carrega a pagina de login de usuario
     * @param array|null $urlParametters 
     * @return void
     */
    public function login(array $urlParametters = [])
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
        if (!empty($urlParametters)) {
            $this->data['result'] = (!empty($urlParametters['result'])) ? $urlParametters['result'] : null;
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
    public function cadastro(array $urlParametters = [])
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

        // Carrega a pagina/View
        $loadView = new ConfigView("sts/Views/acesso/cadastro/cad", $this->data);
        $loadView->renderView();
    }

    public function about(): void
    {
        $loadView = new ConfigView("sts/Views/sobre/sobre", $this->data);
        $loadView->renderView();
    }

    /**
     * Desloga o usuario
     * @param array $urlParametters
     * @return void
     */
    public function sair(array $urlParametters = [])
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