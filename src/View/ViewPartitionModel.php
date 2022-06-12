<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewPartitionModel implements ViewModelInterface
{
    private const SCOPE_TEMPLATE = "\n<div class=\"block\">\n%s</div>\n";

    private ViewScopeModel $viewScope;

    public function __construct(ViewScopeModel $viewScope)
    {
        $this->viewScope = $viewScope;
    }

    public function style(string $styleContent): string
    {
        return "<style type=\"text/css\">$styleContent</style>";
    }

    public function page(string $pageContent): string
    {
        return "<page>\n$pageContent</page>";
    }

    public function convert(array $data): string
    {
        $html = '';
        foreach ($data as $scopeData) {
            $scope = $this->viewScope->convert($scopeData);
            $html .= sprintf(self::SCOPE_TEMPLATE, $scope);
        }

        return $html;
    }
}
