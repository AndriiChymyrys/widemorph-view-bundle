<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphViewBundle\Tests\Unit\Infrastructure;

use PHPUnit\Framework\TestCase;
use WideMorph\Morph\Bundle\MorphViewBundle\Infrastructure\DTO\SideBarLinkDTO;
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
        $sideBarLink = new SideBarLink();

        $link = $sideBarLink->getMenuLinks();

        $this->assertEmpty($link);
    }

    /**
     * @dataProvider sideBarLinksDataProvider
     */
    public function testSideBarLinks(array $dto, array $tree): void
    {
        $sideBarLink = new SideBarLink();

        foreach ($dto as $item) {
            $sideBarLink->addLink($item);
        }

        $this->assertSame($tree, $sideBarLink->getMenuLinks());
    }

    public function sideBarLinksDataProvider(): array
    {
        return [
            [
                [
                    new SideBarLinkDTO('firstRoute', 'first', 1),
                    new SideBarLinkDTO('nextRoute_7', 'next_7', 7),
                    new SideBarLinkDTO('nextRoute_0', 'next_0', 0),
                    new SideBarLinkDTO('nextRoute_2', 'next_2', 2),
                    new SideBarLinkDTO('nextRoute_negative_1', 'next_negative_1', -1),
                    new SideBarLinkDTO('nextRoute_negative_0', 'next_negative_0', -0),
                    new SideBarLinkDTO('nextRoute_10', 'next_10', 10),
                ],
                [
                    [
                        'priority' => 10,
                        'label' => 'next_10',
                        'route' => 'nextRoute_10'
                    ],
                    [
                        'priority' => 7,
                        'label' => 'next_7',
                        'route' => 'nextRoute_7'
                    ],
                    [
                        'priority' => 2,
                        'label' => 'next_2',
                        'route' => 'nextRoute_2'
                    ],
                    [
                        'priority' => 1,
                        'label' => 'first',
                        'route' => 'firstRoute'
                    ],
                    [
                        'priority' => 0,
                        'label' => 'next_0',
                        'route' => 'nextRoute_0'
                    ],
                    [
                        'priority' => -0,
                        'label' => 'next_negative_0',
                        'route' => 'nextRoute_negative_0'
                    ],
                    [
                        'priority' => -1,
                        'label' => 'next_negative_1',
                        'route' => 'nextRoute_negative_1'
                    ],
                ]
            ],
            [
                [
                    new SideBarLinkDTO('nextRoute_3', 'next_3', 3),
                    new SideBarLinkDTO('nextRoute_7', 'next_7', 7),
                    new SideBarLinkDTO('nextRoute_2', 'next_2', 2, 'nextRoute_7'),
                    new SideBarLinkDTO('nextRoute_5', 'next_5', 5, 'nextRoute_7'),
                    new SideBarLinkDTO('nextRoute_negative_1', 'next_negative_1', -1, 'nextRoute_7'),
                    new SideBarLinkDTO('nextRoute_8', 'next_8', 8),
                    new SideBarLinkDTO('nextRoute_4', 'next_4', 4, 'nextRoute_8'),
                ],
                [
                    [
                        'priority' => 8,
                        'label' => 'next_8',
                        'route' => 'nextRoute_8',
                        'children' => [
                            [
                                'priority' => 4,
                                'label' => 'next_4',
                                'route' => 'nextRoute_4'
                            ],
                        ]
                    ],
                    [
                        'priority' => 7,
                        'label' => 'next_7',
                        'route' => 'nextRoute_7',
                        'children' => [
                            [
                                'priority' => 5,
                                'label' => 'next_5',
                                'route' => 'nextRoute_5'
                            ],
                            [
                                'priority' => 2,
                                'label' => 'next_2',
                                'route' => 'nextRoute_2'
                            ],
                            [
                                'priority' => -1,
                                'label' => 'next_negative_1',
                                'route' => 'nextRoute_negative_1'
                            ]
                        ]
                    ],
                    [
                        'priority' => 3,
                        'label' => 'next_3',
                        'route' => 'nextRoute_3',
                    ]
                ]
            ]
        ];
    }
}
