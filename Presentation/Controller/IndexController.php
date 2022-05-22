<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Presentation\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class IndexController
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Presentation\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('@MorphView/index/index.html.twig');
    }
}
