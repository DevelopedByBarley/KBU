<?php

namespace App\Models;

use PDO;
use PDOException;
use Exception;

class DuelSport extends Model
{
  public function store($body)
  {
    // Szanitizálás
    try {
      $name = filter_var($body['name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $max = filter_var($body['max'] ?? '', FILTER_SANITIZE_NUMBER_INT);

      // Option value szétválasztása
      $optionValue = $body['main-team'] ?? '';

      $pairs = explode(';', $optionValue);
      $data = [];

      foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair);
        $data[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
      }

      $main_teamRef_id = $data['id'] ?? '';
      $main_teamRef_color = $data['color'] ?? '';

      $stmt = $this->Pdo->prepare("INSERT INTO `duel_sports` (`id`, `name`, `color`, `max`, `main_teamRef_id`, `created_at`) VALUES (NULL, :name, :color, :max, :main_teamRef_id, current_timestamp())");

      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':color', $main_teamRef_color, PDO::PARAM_STR);
      $stmt->bindParam(':max', $max, PDO::PARAM_INT);
      $stmt->bindParam(':main_teamRef_id', $main_teamRef_id, PDO::PARAM_STR);
      $stmt->execute();
    } catch (Exception $e) {
      var_dump($e->getMessage());
      exit;
      throw new Exception("An error occurred during the database operation in store: " . $e->getMessage());
    }
  }
}
