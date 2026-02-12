<?php
/*
 * yasmf - Yet Another Simple MVC Framework (For PHP)
 *     Copyright (C) 2023   Franck SILVESTRE
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU Affero General Public License as published
 *     by the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU Affero General Public License for more details.
 *
 *     You should have received a copy of the GNU Affero General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace application;

use controllers\HomeController;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use services\UsersService;
use yasmf\NoControllerAvailableForNameException;
use yasmf\NoServiceAvailableForNameException;

#[CoversClass(DefaultComponentFactory::class)]
#[UsesClass(HomeController::class)]
#[UsesClass(UsersService::class)]
class DefaultComponentFactoryTest extends TestCase
{

    private DefaultComponentFactory $componentFactory;

    public function setUp(): void
    {
        parent::setUp();
        // given a component factory
        $this->componentFactory = new DefaultComponentFactory();
    }

    public function testBuildControllerByName_Home()
    {
        // when ask for home controller
        $controller = $this->componentFactory->buildControllerByName("Home");
        // then the controller is HomeController instance
        self::assertInstanceOf(HomeController::class,$controller);
    }

    public function testBuildControllerByName_Other()
    {
        // expected exception when ask for a non-existant controller
        $this->expectException(NoControllerAvailableForNameException::class);
        $controller = $this->componentFactory->buildControllerByName("NoController");
    }

    public function testBuildServiceByName_Users()
    {
        // when ask for user service
        $service = $this->componentFactory->buildServiceByName("Users");
        // then the service is UsersService instance
        self::assertInstanceOf(UsersService::class,$service);
    }

    public function testBuildServiceByName_Other()
    {
        // expected exception when ask for a non-existant service
        $this->expectException(NoServiceAvailableForNameException::class);
        $this->componentFactory->buildServiceByName("NoService");
    }
}
