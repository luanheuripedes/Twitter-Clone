<?php

    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{

        public function timeline(){

            session_start();

            $this->validaAutenticacao();

                //RECUPERAÇÃO DOS TWEETS
                $tweet = Container::getModel('Tweet');

                $tweet->__set('id_usuario', $_SESSION['id']);

                $tweets = $tweet->getAll();

                /*
                echo "<pre>";
                    print_r($tweets);
                echo "</pre>";
                */

                $this->view->tweets = $tweets;

                $this->render('timeline');
           
        }

        public function tweet(){

            session_start();

           $this->validaAutenticacao();

                $tweet = Container::getModel('Tweet');

                $tweet->__set('tweet', $_POST['tweet']);
                $tweet->__set('id_usuario', $_SESSION['id']);

                $tweet->salvar();

                header('Location: /timeline');

        }

        public function validaAutenticacao(){

            session_start();

            if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
                header('Location: /?login=erro');
            }else{
                
            }
        }

    }
?>