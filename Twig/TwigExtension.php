<?php

namespace TheWellCom\TwigBundle\Twig;

class TwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('phone', array($this, 'phoneFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('paginator', array($this, 'paginatorFunction'), array(
                'is_safe' => array('html'),
                'needs_environment' => true,
            )),
        );
    }

    public function paginatorFunction(\Twig_Environment $twig, $pathName, $cursorName, $currentPageNb, $totalItem, $nbPerPage, $query = array(), $prevNb = null, $nextNb = null)
    {
        return $twig->render('TheWellComTwigBundle:Default:paginator.html.twig', array(
            'pathName' => $pathName,
            'cursorName' => $cursorName,
            'currentPageNb' => $currentPageNb,
            'totalItem' => $totalItem,
            'nbPerPage' => $nbPerPage,
            'query' => $query,
            'prevNb' => $prevNb,
            'nextNb' => $nextNb,
        ));
    }

    public function phoneFilter($phone, $interval = ' ')
    {
        $phone = preg_replace('/ /', '', $phone);
        $phone = str_split($phone); // transformed to an array
        $phoneTransformed = '';
        $phoneLength = sizeof($phone);

        for ($i = 0; $i < $phoneLength; ++$i) {
            $phoneTransformed .= $phone[$i];

            if ($i < ($phoneLength - 1) && !$this->isEven($i)) {
                $phoneTransformed .= $interval;
            }
        }

        return $phoneTransformed;
    }

    private function isEven($number)
    {
        if ($number % 2 == 0) {
            return true;
        }

        return false;
    }

    public function getName()
    {
        return 'thewellcom_twig_extension';
    }
}
