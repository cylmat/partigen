<?php

declare(strict_types=1);

namespace Partigen\View;

class ViewPartitionModel implements ViewModelInterface
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
        return "<page>\n$pageContent</page>";
    }

    public function convert(array $data): string
    {
        $html = '';
        foreach ($data as $scopesData) {
            $html .= $this->scopes($scopesData);
        }

        return $html;
    }

    private function scopes(array $scopesData): string
    {
        $scopesHtml = ''; 
        foreach ($scopesData as $scopeData) {
            $scopesHtml .= $this->viewScope->convert($scopeData);
        }        

        return "\n" . '<div class="block">' . "\n" . $scopesHtml . "</div>\n";
    }
}
