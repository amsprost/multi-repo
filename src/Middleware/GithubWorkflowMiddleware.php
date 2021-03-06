<?php declare(strict_types=1);

namespace Linkorb\MultiRepo\Middleware;

use Linkorb\MultiRepo\Dto\FixerInputDto;
use Linkorb\MultiRepo\Services\Helper\TemplateLocationHelper;

class GithubWorkflowMiddleware implements MiddlewareInterface
{
    private TemplateLocationHelper $templateHelper;

    public function __construct(TemplateLocationHelper $templateHelper)
    {
        $this->templateHelper = $templateHelper;
    }

    public function __invoke(FixerInputDto $input, MiddlewareInterface $next)
    {

    }
}
