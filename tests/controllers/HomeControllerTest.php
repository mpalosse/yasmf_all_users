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

namespace controllers;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use services\UsersService;

class HomeControllerTest extends TestCase
{

    private HomeController $homeController;
    private UsersService $usersService;
    private PDO $pdo;
    private PDOStatement $pdoStatement;

    public function setUp(): void
    {
        parent::setUp();
        // given a users service
        $this->usersService = $this->createStub(UsersService::class);
        // and a pdo and a pdo statement
        $this->pdo = $this->createStub(PDO::class);
        $this->pdoStatement = $this->createStub(PDOStatement::class);
        $this->usersService->method('findUsersByUsernameAndStatus')->willReturn($this->pdoStatement);
        // and a home controller
        $this->homeController = new HomeController($this->usersService);
    }

    public function testIndex()
    {
        self::assertNotNull($this->usersService);
        self::assertNotNull($this->homeController);
        // when call to index
        $view = $this->homeController->index($this->pdo);
        // then the view point to the expected view file
        self::assertEquals("views/all_users", $view->getRelativePath());
        // and the statement returned by the service is set as a variable in the view
        self::assertSame($this->pdoStatement, $view->getVar("search_stmt"));
    }
}
