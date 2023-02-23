<?php


namespace services;


use PDO;
use PDOStatement;

/**
 * The users service class
 */
class UsersService
{
    /**
     * Find users by criteria
     *
     * @param PDO $pdo the pdo object
     * @param string $likeUsername the string the username should contain
     * @param int $statusId the status id
     * @return PDOStatement the statement referencing the result set
     */
    public function findUsersByUsernameAndStatus(PDO $pdo, string $likeUsername, int $statusId): PDOStatement
    {
        $sql = "select users.id as user_id, username, email, s.name as status, s.id as status_id 
            from users join status s on users.status_id = s.id 
            where username like :likeUsername and status_id = :statusId order by username";
        $search_stmt = $pdo->prepare($sql);
        $search_stmt->execute(['likeUsername' => $likeUsername, 'statusId' => $statusId]);
        return $search_stmt;
    }


    private static $defaultUsersService ;

    /**
     * @return UsersService the default unique user service object
     */
    public static function getDefaultUsersService(): UsersService
    {
        if (UsersService::$defaultUsersService == null) {
            UsersService::$defaultUsersService = new UsersService();
        }
        return UsersService::$defaultUsersService;
    }
}