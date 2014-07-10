<?php

namespace KNorbert\Twig\Extension;
use Twig_Extension;
use Twig_Function_Method;

class Analytics extends Twig_Extension {

    private $uaCode;

    public function __construct($uaCode = null) {
        $this->uaCode = $uaCode;
    }

    public function getFunctions() {
        return [
            'analytics' => new Twig_Function_Method($this, 'renderAnalyticsCode', [ 'is_safe' => [ 'html' ] ])
        ];
    }

    public function renderAnalyticsCode() {
        if (!$this->uaCode) {
            return;
        }
        ob_start();
        ?>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '<?= htmlspecialchars($this->uaCode, ENT_COMPAT, 'utf-8') ?>', 'auto');
                ga('send', 'pageview');
            </script>
        <?php
        return ob_get_clean();
    }

    public function getName() {
        return 'analytics';
    }

}
