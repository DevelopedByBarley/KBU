<?php

namespace App\Models;

use App\Models\Model;
use Exception;
use PDO;
use PDOException;

class User extends Model
{
  
  public function compare($body, $userId) {
    $pairing_pw = $body['pairing_pw'] ?? null;

    try {
      $stmt = $this->Pdo->prepare("SELECT id, name, pair_password FROM `users` WHERE `id` = :user_id AND pairRef_id IS NULL");
      $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      return $pairing_pw === $user['pair_password'];

    } catch (PDOException $e) {
      throw new  Exception("An error occurred during the database operation in getAllUsersByDuelSportId method: " . $e->getMessage(), 1);
      exit;
    }
  }

  public function getAllUsersByDuelSportId($duel_sport_id)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `users` WHERE `duel_sportRef_id` = :duel_sportRefId AND pairRef_id IS NULL");
      $stmt->bindParam(":duel_sportRefId", $duel_sport_id, PDO::PARAM_INT);
      $stmt->execute();

      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $users;
    } catch (PDOException $e) {
      throw new  Exception("An error occurred during the database operation in getAllUsersByDuelSportId method: " . $e->getMessage(), 1);
      exit;
    }
  }

  public function storeUser($body, $files)
  {
    $email = filter_var($body["email"] ?? '', FILTER_SANITIZE_EMAIL);
    $pw = password_hash(filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
    $fileName = $this->FileSaver->saver($files['file'], 'uploads/images', null, ['image/png', 'image/jpeg']);


    $isUserExist = $this->selectByRecord('users', 'email', $email, PDO::PARAM_STR);

    if ($isUserExist) return false;

    try {

      $stmt = $this->Pdo->prepare("INSERT INTO `users` (`id`, `email`, `password`,  `fileName`, `created_at`) VALUES (NULL, :email, :password, :fileName, current_timestamp())");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $pw, PDO::PARAM_STR);
      $stmt->bindParam(":fileName", $fileName, PDO::PARAM_STR);
      $stmt->execute();

      return true;
    } catch (PDOException $e) {
      throw new  Exception("An error occurred during the database operation in storeUser method: " . $e->getMessage(), 1);
      exit;
    }
  }

  public function loginUser($body)
  {
    try {

      $email = filter_var($body["email"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $pw = filter_var($body["password"] ?? '', FILTER_SANITIZE_EMAIL);



      $stmt = $this->Pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user || !password_verify($pw, $user["password"])) {
        return false;
      }


      return $user['id'];
    } catch (PDOException $e) {
      throw new  Exception("An error occurred during the database operation in loginUser method: " . $e->getMessage(), 1);
      exit;
    }
  }
}
