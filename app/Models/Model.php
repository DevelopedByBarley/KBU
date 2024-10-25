<?php

namespace App\Models;

use App\Helpers\Debug;
use App\Helpers\FileSaver;
use App\Helpers\Mailer;
use Database;
use Exception;
use InvalidArgumentException;
use PDO;
use PDOException;

class Model
{
  protected $Pdo;
  protected $Debug;
  protected $Mailer;
  protected $FileSaver;


  public function __construct()
  {
    DATABASE_PERM === 1 ? $this->Pdo = Database::getInstance() : null;
  }

  public function sendMail()
  {
    $name = 'name';
    $this->Mailer->renderAndSend('Test', ['name' => $name], 'arpadsz@max.hu', 'Test');
  }

  public function storeToken($token, $expires, $link, $ref_id)
  {
    try {
      $stmt = $this->Pdo->prepare("INSERT INTO `token` VALUES (NULL, :token, :expires, :link, :ref_id, current_timestamp());");
      $stmt->bindParam(":token", $token);
      $stmt->bindParam(":expires", $expires);
      $stmt->bindParam(":link", $link);
      $stmt->bindParam(":ref_id", $ref_id);
      $stmt->execute();

      return $link;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the storeToken method: " . $e->getMessage());
    }
  }

  public function checkResetToken()
  {
    $token = $_GET['token'] ?? '';
    $expires = $_GET['expires'] ?? '';

    if (empty($token) || empty($expires)) {
      return false;
    }

    if (time() > (int)$expires) {
      return false;
    }

    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM token WHERE token = :token");
      $stmt->execute(['token' => $token]);

      if ($stmt->rowCount() > 0) {
        $token = $stmt->fetch(PDO::FETCH_ASSOC);
        return $token;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      error_log("Adatbázis hiba: " . $e->getMessage());
      http_response_code(500);
      throw new Exception("An error occurred during the database operation in the checkResetToken method: " . $e->getMessage());
    }
  }


  public function deactivateResetToken($token)
  {
    try {
      $stmt = $this->Pdo->prepare("UPDATE token SET expires = -1 WHERE token = :token");
      $stmt->execute(['token' => $token]);

      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      error_log("Adatbázis hiba: " . $e->getMessage());
      http_response_code(500); // Belső szerver hiba
      throw new Exception("Adatbázis hiba történt a deactivateResetToken metódusban: " . $e->getMessage());
    }
  }






  public function searchBySingleEntity($table, $entity, $searched, $searchDefault)
  {
    $search = $searched ?? $searchDefault;
    try {
      $searched = "%" . $search . "%"; // $searched előállítása
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE `$entity` LIKE :searched");
      $stmt->bindParam(":searched", $searched);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $data;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the searchBySingleEntity method: " . $e->getMessage());
    }
  }


  public function paginate($results, $limit, $search = '', $searchCondition = null)
  {
    if (empty($results)) {
      return [
        "status" => true,
        "pages" => [],
        "numOfPage" => 0,
        "limit" => 0
      ];
    }




    $offset = isset($_GET["offset"]) ? (int)$_GET["offset"] : null;


    $calculated = ($offset - 1) * $limit;
    $countOfRecords = count($results);
    $numOfPage = ceil($countOfRecords / $limit);

    if ($searchCondition) $searchCondition($offset, $numOfPage, $search);


    if ($countOfRecords === 0) {
      return [
        "status" => false,
        "message" => "No results found for the given search criteria.",
        "pages" => [],
        "numOfPage" => 0,
        "limit" => $limit
      ];
    }


    // Lapozott eredmények kiválasztása a limit és offset alapján
    $pagedResults = array_slice($results, $calculated, $limit);
    if (empty($pagedResults)) {
      return [
        "status" => false,
        "message" => "No paginated results found for the given offset and limit.",
        "pages" => [],
        "numOfPage" => 0,
        "limit" => $limit
      ];
    }


    return [
      "status" => true,
      "pages" => $pagedResults,
      "numOfPage" => $numOfPage,
      "limit" => $limit
    ];
  }


  public function show($table, $id)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {

      echo "An error occurred during the database operation:: " . $e->getMessage();
      return false;
    }
  }




  public function all($table)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table`");
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (PDOException  $e) {

      throw new Exception("An error occurred during the database operation in the all method: " . $e->getMessage());
      return false;
    }
  }

  public function allBySearch($table, $search, $entities)
  {
    try {
      // Alap SQL lekérdezés
      $sql = "SELECT * FROM `$table`";

      // Ha van keresési paraméter és van megadva keresési entitások tömb
      if (!empty($search) && !empty($entities)) {
        $conditions = [];
        foreach ($entities as $entity) {
          $conditions[] = "`$entity` LIKE :search";
        }
        $sql .= " WHERE " . implode(" OR ", $conditions);
      }

      $stmt = $this->Pdo->prepare($sql);

      if (!empty($search)) {
        $searchParam = "%" . $search . "%";
        $stmt->bindValue(":search", $searchParam);
      }

      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the allBySearch method: " . $e->getMessage());
      return false;
    }
  }





  public function selectByRecord($table, $column, $value, $param)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM {$table} WHERE {$column} = :value");
      $stmt->bindParam(':value', $value, $param);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the selectByRecord method: " . $e->getMessage());
    }
  }

  public function selectAllByRecord($table, $entity, $value, $param, $orderColumn = 'NAME', $orderDirection = 'ASC')
  {
    try {
      // Biztonságosabb megoldás az ORDER BY használatára
      $orderDirection = strtoupper($orderDirection);
      if (!in_array($orderDirection, ['ASC', 'DESC'])) {
        throw new InvalidArgumentException("Invalid order direction parameter: $orderDirection");
      }

      // Feltételezzük, hogy az $orderColumn érvényes oszlopnév.
      // Ez egy egyszerű ellenőrzés, de ajánlott lenne egy bővebb ellenőrzés az oszlopnevek érvényességére.
      if (preg_match('/^[a-zA-Z0-9_]+$/', $orderColumn) !== 1) {
        throw new InvalidArgumentException("Invalid order column parameter: $orderColumn");
      }

      $stmt = $this->Pdo->prepare("SELECT * FROM $table WHERE $entity = :entity ORDER BY $orderColumn $orderDirection");
      $stmt->bindParam(':entity', $value, $param);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the selectAllByRecord method: " . $e->getMessage());
    }
  }




  public function deleteRecordById($table, $id)
  {
    try {
      $stmt = $this->Pdo->prepare("DELETE FROM `$table` WHERE `id` = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in the deleteRecordById method: " . $e->getMessage());
    }
  }


  public function deletePairRefIdIfItExist($userId)
  {
    try {
      $stmt =  $this->Pdo->prepare("SELECT * FROM USERS WHERE id = :userId OR pairRef_id = :userId");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($users as $user) {
        if ((int)$user['pair_status'] === 1) {
          $stmt = $this->Pdo->prepare("UPDATE users SET pair_status = 2, pair_eligibility = 1 WHERE id = :userId AND pair_status = 1");
          $stmt->bindParam(':userId', $user['id'], PDO::PARAM_INT);
          $stmt->execute();
        }
      }

      $stmt = $this->Pdo->prepare("UPDATE users SET pairRef_id = NULL WHERE id = :userId OR pairRef_id = :userId");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (\Throwable $th) {
      error_log("Adatbázis hiba: " . $th->getMessage());
      http_response_code(500);
      exit("Belső szerver hiba.");
    }
  }
}
