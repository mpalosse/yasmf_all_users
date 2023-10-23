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

namespace services;


use PDO;
use PDOException;
use PHPUnit\Framework\TestCase;
use yasmf\DataSource;


class UsersServiceTest extends TestCase
{

    private PDO $pdo;
    private UsersService $usersService;

    public function setUp(): void
    {
        parent::setUp();
        // given a pdo for tests
        $datasource = new DataSource(
            $host = 'all_users_db',
            $port = 3306, # to change with the port your mySql server listen to
            $db_name = 'all_users', # to change with your db name
            $user = 'all_users', # to change with your db username
            $pass = 'all_users', # to change with your db password
            $charset = 'utf8mb4'
        );
        $this->pdo = $datasource->getPdo();
        // and a user service
        $this->usersService = new UsersService();

    }

    public function testFindUsersByUsernameAndStatus_withWrittenAccess()
    {
        try {
            $this->pdo->beginTransaction();
            // given the database initialized with the script in the readme
            // and with a special user
            $sql = "INSERT INTO `users` (`username`, `id`, `email`, `status_id`) VALUES ('mpfeiffer',100,'michelle@hollywood.com',2)";
            $this->pdo->query($sql);
            // when fetching all users with no specification username and status
            $statement = $this->usersService->findUsersByUsernameAndStatus($this->pdo, '%', 2);
            // then, based on the readme file + one
            self::assertEquals(7, $statement->rowCount());
            // and the first user is the one expected
            $row = $statement->fetch();
            self::assertEquals(9, $row[ 'user_id' ]);
            self::assertEquals('alpacino', $row[ 'username' ]);
            self::assertEquals('Active account', $row[ 'status' ]);
            $this->pdo->rollBack();
        } catch (PDOException) {
            $this->pdo->rollBack();
        }
    }

    public function testFindUsersByUsernameAndStatus()
    {
            // when fetching all users with no specification username and status
            $statement = $this->usersService->findUsersByUsernameAndStatus($this->pdo, '%', 2);
            // then, based on the readme file + one
            self::assertEquals(6, $statement->rowCount());
            // and the first user is the one expected
            $row = $statement->fetch();
            self::assertEquals(9, $row[ 'user_id' ]);
            self::assertEquals('alpacino', $row[ 'username' ]);
            self::assertEquals('Active account', $row[ 'status' ]);
    }
}
