<?php

namespace KNorbert\Twig\Extension;
use Twig_Extension;
use Twig_Filter_Method;

class KeywordHighlighter extends Twig_Extension {

    public function getFilters() {
        return [
            'keywords' => new Twig_Filter_Method($this, 'highlightKeywords', [ 'is_safe' => [ 'html' ] ])
        ];
    }

    public function highlightKeywords($text) {
        return preg_replace('/\|(.*?)\|/i', '<strong>$1</strong>', $text);
    }

    public function getName() {
        return 'keyword_highlighter';
    }
}
