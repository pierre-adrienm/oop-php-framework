<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller {

    protected $db;

    /**
     * Summary of __construct
     * @param DBConnection $db
     */
    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    /**
     * Summary of view
     * @param string $path
     * @param array|null $params
     * @return void
     */
    protected function view(string $path, array $params = null)
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        // var_dump("Controller view",VIEWS , $path);
        //die();
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }

    /**
     * Summary of getDB
     * @return DBConnection
     */
    protected function getDB()
    {
        // retourne le résultat de la base de donnée
        return $this->db;
    }

    /**
     * Summary of isAdmin
     * @return bool
     */
    protected function isAdmin()
    {
        // verifier la si c'est bien du connexion de compte administrateur
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
            return true;
        } else {
            return header('Location:'. HREF_ROOT.'login');
        }
    }
}
