<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function index()
    {
        return $this->render('@MorphView/index/index.html.twig');
    }
}
