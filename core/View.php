<?php

/**
 * Cette classe génère les vues en fonction de ce que chaque contrôlleur lui passe en paramètre.
 */
class View
{
    /**
     * Le titre de la page.
     */
    private string $title;


    /**
     * Constructeur.
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Cette méthode retourne une page complète.
     *
     * @param string $viewName
     * @param array $params : les paramètres que le controlleur a envoyé à la vue.
     * @return void
     */
    public function render(string $viewName, array $params = []): void
    {
        // On s'occupe de la vue envoyée
        $viewPath = $this->buildViewPath($viewName);

        try {
            // Les deux variables ci-dessous sont utilisées dans le "main.php" qui est le template principal.
            $content = $this->_renderViewFromTemplate($viewPath, $params);
        } catch (Exception $e) {
            $homeController = new HomeController();
            $homeController->showError(
                'vue introuvable',
                $e->getMessage(),
            );
        }

        $title = $this->title;
        if (!isset($params['errorPage']) && Utils::isAuthenticated()) {
            $userManager = new UserManager();
            $user = Utils::getUserFromSession();
            $messageManager = new MessageManager();
            $unreadCount = $messageManager->getUnreadMessagesCount($user->getId());
        }
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }

    /**
     * Coeur de la classe, c'est ici qu'est généré ce que le controlleur a demandé.
     *
     * @param $viewPath : le chemin de la vue demandée par le controlleur.
     * @param array $params : les paramètres que le controlleur a envoyés à la vue.
     * @return string : le contenu de la vue.
     * @throws Exception : si la vue n'existe pas.
     */
    private function _renderViewFromTemplate(string $viewPath, array $params = []): string
    {
        if (file_exists($viewPath)) {
            extract($params); // On transforme les diverses variables stockées dans le tableau "params" en véritables variables qui pourront être lues dans le template.
            ob_start();
            require($viewPath);
            return ob_get_clean();
        }

        throw new RuntimeException("La vue '$viewPath' est introuvable.");
    }

    /**
     * Cette méthode construit le chemin vers la vue demandée.
     *
     * @param string $viewName : le nom de la vue demandée.
     * @return string : le chemin vers la vue demandée.
     */
    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}



