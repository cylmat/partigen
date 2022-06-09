<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewModel implements ViewModelInterface
{
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
        return "<page>$pageContent</page>";
    }

    public function convert(array $data): string
    {
        $html = '';
        foreach ($data as $scopeData) {
            $html .= $this->scopes($scopeData);
        }

        return $html;
    }

    private function scopes(array $scopesData): string
    {
        $scopesHtml = ''; 
        foreach ($scopesData as $scopeData) {
            $scopeHtml = $this->viewScope->convert($scopeData);
            $scopesHtml .= '<div class="scopes">' . $scopeHtml . "</div>\n";
        }

        return $scopesHtml;
    }
}
