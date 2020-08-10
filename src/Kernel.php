<?php

namespace Linkorb\MultiRepo;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/{services}.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }

        $this->loadReposConfig($container);
    }

    private function loadReposConfig(ContainerConfigurator $container): void
    {
        $reposPath = $_ENV['MULTI_REPO_CONFIG_PATH'] ?? 'repos.yaml';

        $container->import(__DIR__ . '/../' . $reposPath);
        $container->parameters()->set('repositoriesConfigPath', $reposPath);
    }
}
