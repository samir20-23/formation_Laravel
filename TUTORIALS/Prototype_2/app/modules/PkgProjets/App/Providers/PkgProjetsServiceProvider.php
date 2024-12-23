<?php

namespace Modules\PkgProjets\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class PkgProjetsServiceProvider extends ServiceProvider
{
    /**
     * Enregistrer les services dans l'application.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Effectuer les opérations de démarrage pour le module.
     *
     * @return void
     */
    public function boot()
    {
        // Charger les migrations du module
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Charger les routes du module
        // Charger tous les fichiers de routes du dossier routes
        $routeFiles = glob(__DIR__ . '/../../routes/*.php');
 
        $routeFiles = File::allFiles(__DIR__ . '/../../Routes');


        foreach ($routeFiles as $routeFile) {

            $this->loadRouteFile($routeFile);

            // $this->loadRoutesFrom($routeFile);
        }
        
        // Charger les vues du module
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'pkg_projets');

        $this->loadTranslationsFrom(
            __DIR__ . '/../../resources/lang',
            'pkg_projets'
        );

    }

    protected function loadRoutes()
    {
        $routeFiles = File::allFiles(base_path('routes'));

        foreach ($routeFiles as $file) {
            $this->loadRouteFile($file);
        }
    }


     /**
     * Load a route file.
     *
     * @param \SplFileInfo $file
     */
    protected function loadRouteFile($file)
    {
        $filePath = $file->getPathname();
        // $routePath = 'routes' . DIRECTORY_SEPARATOR . $file->getRelativePathname();
        $middleware = $this->getMiddleware($filePath);

        Route::middleware($middleware)->group(function () use ($filePath) {
            require $filePath;
        });
    }

    /**
     * Get middleware based on the route file.
     *
     * @param string $filePath
     * @return array
     */
    protected function getMiddleware($filePath)
    {
        // Add your logic to determine middleware based on the file if needed.
        return ['web'];
    }
}
