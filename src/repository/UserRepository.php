<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user u LEFT JOIN user_details ud 
                ON u.id_user_details = ud.id_user_details WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['id_user'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['phone'],
            $user['id_user_role']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user_details (name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user (email, password, id_user_details, id_user_role)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $user->getRole()
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        //TODO program sie wyjebie jak podasz dwa razy to samo imie nazwisko i numer telefonu
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data['id_user_details'];
    }

    public function cookieCheck($user_token): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM cookie_session WHERE token=:token AND expiration>:currentDate
        ');
        $currentDate = date("Y-m-d H:i:s");
        $stmt->bindParam(':token', $user_token, PDO::PARAM_STR);
        $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $stmt->execute();

        $cookieInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($cookieInfo == null) {
            return 0;
        }
        return $cookieInfo['id_user'];
    }

    public function setCookie($id_cookie_session, $token)
    {
        //Delete old cookies of this user.
        $stmt = $this->database->connect()->prepare('
        DELETE FROM cookie_session
        WHERE id_user=:id_cookie_session
        ');
        $stmt->bindParam(':id_cookie_session', $id_cookie_session, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO cookie_session (id_user,token,expiration)
            VALUES(?,?,?)
        ');

        $time = date("Y-m-d H:i:s", time() + 3600);
        try {
            $stmt->execute([
                $id_cookie_session,
                $token,
                $time
            ]);
        } catch (PDOException $e) {
            //TODO mozna zrobic aktualizacje expiration w przypadku resetu cookie'sa
            die("Exception happened while setting cookie. Message: " . $e->getMessage());
        }
    }

    public function unsetCookie($token): string
    {
        try {
            $stmt = $this->database->connect()->prepare('
            DELETE FROM cookie_session 
            WHERE token=:token
        ');
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();
            return ("You have logged out");
        } catch (PDOException $e) {
            return ("Exception happened while unsetting cookie. Message: " . $e->getMessage());
        }
    }

    public function checkPrivilege(int $userID){

        $stmt = $this->database->connect()->prepare('
            SELECT id_user_role FROM public.user WHERE id_user = :id 
        ');
        $stmt->bindParam(':id ', $userID, PDO::PARAM_STR);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data['id_user_role'];
    }
}

