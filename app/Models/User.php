<?php

namespace App\Models;

use App\Models\Model;
use Exception;
use PDO;
use PDOException;

class User extends Model
{

  public function deleteUser($user_id)
  {

    if ($user_id === null) {
      http_response_code(400);
      exit("Hiányzó userId.");
    }


    try {
      $stmt = $this->Pdo->prepare("DELETE FROM users WHERE id = :userId");
      $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        http_response_code(404);
        exit("A felhasználó nem található.");
      }
    } catch (\Throwable $th) {
      error_log("Adatbázis hiba: " . $th->getMessage());
      http_response_code(500);
      exit("Belső szerver hiba.");
    }
  }





  public function compare($body, $userId)
  {
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
      $stmt = $this->Pdo->prepare("SELECT * FROM `users` WHERE `duel_sportRef_id` = :duel_sportRefId AND pairRef_id IS NULL  AND pair_status = 2");
      $stmt->bindParam(":duel_sportRefId", $duel_sport_id, PDO::PARAM_INT);
      $stmt->execute();

      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $users;
    } catch (PDOException $e) {
      throw new  Exception("An error occurred during the database operation in getAllUsersByDuelSportId method: " . $e->getMessage(), 1);
      exit;
    }
  }

  public function storeUser($body)
  {
    $name = filter_var($body["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $class = filter_var($body["class"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($body["email"] ?? '', FILTER_SANITIZE_EMAIL);
    $ident_number = filter_var($body["ident-number"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $main_teamRef_id = isset($body["main-team"]) ? (filter_var($body["main-team"], FILTER_VALIDATE_INT) ?: null) : null;
    $team_sportRef_id = isset($body["team-sport"]) ? (filter_var($body["team-sport"], FILTER_VALIDATE_INT) ?: null) : null;
    $duel_sportRef_id = isset($body["duel-sport"]) ? (filter_var($body["duel-sport"], FILTER_VALIDATE_INT) ?: null) : null;

    $chess = 0;
    //  $chess = filter_var($body["chess"] ?? '', FILTER_VALIDATE_INT);
    $run = 0;
    //$run = filter_var($body["run"] ?? '', FILTER_VALIDATE_INT);
    $transfer = 0;
    //$transfer = filter_var($body["transfer"] ?? '', FILTER_VALIDATE_INT);
    $vegetarian = 0;
    //$vegetarian = filter_var($body["vegetarian"] ?? '', FILTER_VALIDATE_INT);
    $actimo = 0;;
    //$actimo = filter_var($body["actimo"] ?? '', FILTER_VALIDATE_INT);
    $pair_status = filter_var($body["pair-status"] ?? '', FILTER_VALIDATE_INT);
    $pair_eligibility = filter_var($body["pair-eligibility"] ?? '', FILTER_VALIDATE_INT);
    $pair_password = filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $pairRef_id = isset($body["pair-id"]) ? (int) $body["pair-id"] : null;
    $pairHaveRefId = $this->selectByRecord('users', 'id', $pairRef_id, PDO::PARAM_INT)['pairRef_id'];



    if ($pairRef_id === 0 || !filter_var($pairRef_id, FILTER_VALIDATE_INT)) {
      $pairRef_id = null;
    }

    // Want to select pair but that one had a pair :D 
    if($pairRef_id && $pairHaveRefId) {
      return false;
    }


    try {
      $stmt = $this->Pdo->prepare(" INSERT INTO `users` VALUES (NULL, :name, :class, :email, :ident_number, :main_teamRef_id, :team_sportRef_id, :duel_sportRef_id, :chess, :run, :transfer, :vegetarian, :actimo, :pair_status, :pair_eligibility, :pair_password, :pairRef_id, current_timestamp())");

      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":class", $class, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":ident_number", $ident_number, PDO::PARAM_STR);
      $stmt->bindParam(":main_teamRef_id", $main_teamRef_id, PDO::PARAM_INT);
      $stmt->bindParam(":team_sportRef_id", $team_sportRef_id, PDO::PARAM_INT);
      $stmt->bindParam(":duel_sportRef_id", $duel_sportRef_id, PDO::PARAM_INT);
      $stmt->bindParam(":chess", $chess, PDO::PARAM_INT);
      $stmt->bindParam(":run", $run, PDO::PARAM_INT);
      $stmt->bindParam(":transfer", $transfer, PDO::PARAM_INT);
      $stmt->bindParam(":vegetarian", $vegetarian, PDO::PARAM_INT);
      $stmt->bindParam(":actimo", $actimo, PDO::PARAM_INT);
      $stmt->bindParam(":pair_status", $pair_status, PDO::PARAM_INT);
      $stmt->bindParam(":pair_eligibility", $pair_eligibility, PDO::PARAM_INT);
      $stmt->bindParam(":pair_password", $pair_password, PDO::PARAM_STR);
      $stmt->bindParam(":pairRef_id", $pairRef_id, PDO::PARAM_INT);

      $stmt->execute();
      $last_inserted_id = $this->Pdo->lastInsertId();

      if ($pairRef_id) {
        try {
          $stmt = $this->Pdo->prepare("UPDATE `users` SET `pairRef_id` = :last_inserted_id WHERE `users`.`id` = :pairRef_id");
          $stmt->bindParam(":last_inserted_id", $last_inserted_id, PDO::PARAM_INT);
          $stmt->bindParam(":pairRef_id", $pairRef_id, PDO::PARAM_INT);

          $stmt->execute();
        } catch (PDOException $e) {
          throw new Exception("An error occurred during the database operation in storeUser method: " . $e->getMessage(), 1);
        }
      }

      return $last_inserted_id;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in storeUser method: " . $e->getMessage(), 1);
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
