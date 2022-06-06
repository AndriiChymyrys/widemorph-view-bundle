<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Tests\Unit\Infrastructure;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\Twig\SideBarLink;

/**
 * Class SideBarLinkTest
 *
 * @package WideMorph\Morph\Bundle\MorphViewBundle\Tests\Unit\Infrastructure
 */
class SideBarLinkTest extends TestCase
{
    public function testEmptyLinks(): void
    {
        $generatorMock = $this->createMock(UrlGeneratorInterface::class);
        $requestMock = $this->createMock(RequestStack::class);

        $generatorMock
            ->expects($this->never())
            ->method('generate');

        $sideBarLink = new SideBarLink($generatorMock, $requestMock);

        $link = $sideBarLink->getMenuLinks();

        $this->assertEmpty($link);
    }

    /**
     * @dataProvider sideBarLinksDataProvider
     */
    public function testSideBarLinks(array $dto, array $tree): void
    {
        $generatorMock = $this->createMock(UrlGeneratorInterface::class);
        $requestMock = $this->createMock(RequestStack::class);

        $generatorMock
            ->expects($this->atLeastOnce())
            ->method('generate')
            ->willReturn('generatedRoute');

        $sideBarLink = new SideBarLink($generatorMock, $requestMock);

        foreach ($dto as $item) {
            [$routeName, $label, $priority, $parentRouteName] = $item;
            $sideBarLink->addLink($routeName, $label, $priority, $parentRouteName);
        }

        $this->assertSame($tree, $sideBarLink->getMenuLinks());
    }

    public function sideBarLinksDataProvider(): array
    {
        return [
            [
                [
                    ['firstRoute', 'first', 1, null],
                    ['nextRoute_7', 'next_7', 7, null],
                    ['nextRoute_0', 'next_0', 0, null],
                    ['nextRoute_2', 'next_2', 2, null],
                    ['nextRoute_negative_1', 'next_negative_1', -1, null],
                    ['nextRoute_negative_0', 'next_negative_0', -0, null],
                    ['nextRoute_10', 'next_10', 10, null],
                ],
                [
                    [
                        'priority' => 10,
                        'label' => 'next_10',
                        'routeName' => 'nextRoute_10',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => 7,
                        'label' => 'next_7',
                        'routeName' => 'nextRoute_7',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => 2,
                        'label' => 'next_2',
                        'routeName' => 'nextRoute_2',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => 1,
                        'label' => 'first',
                        'routeName' => 'firstRoute',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => 0,
                        'label' => 'next_0',
                        'routeName' => 'nextRoute_0',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => -0,
                        'label' => 'next_negative_0',
                        'routeName' => 'nextRoute_negative_0',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                    [
                        'priority' => -1,
                        'label' => 'next_negative_1',
                        'routeName' => 'nextRoute_negative_1',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ],
                ]
            ],
            [
                [
                    ['nextRoute_3', 'next_3', 3, null],
                    ['nextRoute_7', 'next_7', 7, null],
                    ['nextRoute_2', 'next_2', 2, 'nextRoute_7'],
                    ['nextRoute_5', 'next_5', 5, 'nextRoute_7'],
                    ['nextRoute_negative_1', 'next_negative_1', -1, 'nextRoute_7'],
                    ['nextRoute_8', 'next_8', 8, null],
                    ['nextRoute_4', 'next_4', 4, 'nextRoute_8'],
                ],
                [
                    [
                        'priority' => 8,
                        'label' => 'next_8',
                        'routeName' => 'nextRoute_8',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                        'children' => [
                            [
                                'priority' => 4,
                                'label' => 'next_4',
                                'routeName' => 'nextRoute_4',
                                'route' => 'generatedRoute',
                                'isActive' => false,
                            ],
                        ]
                    ],
                    [
                        'priority' => 7,
                        'label' => 'next_7',
                        'routeName' => 'nextRoute_7',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                        'children' => [
                            [
                                'priority' => 5,
                                'label' => 'next_5',
                                'routeName' => 'nextRoute_5',
                                'route' => 'generatedRoute',
                                'isActive' => false,
                            ],
                            [
                                'priority' => 2,
                                'label' => 'next_2',
                                'routeName' => 'nextRoute_2',
                                'route' => 'generatedRoute',
                                'isActive' => false,
                            ],
                            [
                                'priority' => -1,
                                'label' => 'next_negative_1',
                                'routeName' => 'nextRoute_negative_1',
                                'route' => 'generatedRoute',
                                'isActive' => false,
                            ]
                        ]
                    ],
                    [
                        'priority' => 3,
                        'label' => 'next_3',
                        'routeName' => 'nextRoute_3',
                        'route' => 'generatedRoute',
                        'isActive' => false,
                    ]
                ]
            ]
        ];
    }
}
