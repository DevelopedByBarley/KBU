<?php

namespace App\Models;

use PDO;
use PDOException;
use Exception;

class MainTeam extends Model
{
  

public function getAllMainTeamsWithUsers()
  {
    try {
      // Lekérdezzük az összes fő csapatot
      $stmt = $this->Pdo->prepare("SELECT * FROM main_teams");
      $stmt->execute();
      $main_teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Inicializálunk egy asszociatív tömböt a csapatokkal és felhasználóikkal
      $teams_with_users = [];

      // Végigmegyünk az összes fő csapaton
      foreach ($main_teams as $team) {
        // Lekérdezzük az adott csapathoz tartozó összes felhasználót
        $stmt = $this->Pdo->prepare("SELECT * FROM users WHERE main_teamRef_id = :team_id");
        $stmt->bindParam(':team_id', $team['id'], PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hozzáadjuk a felhasználókat a csapathoz
       // $team['users'] = $users;
        (int)$team['max'] -= count($users);
        // Hozzáadjuk a csapatot a végső tömbhöz
        $teams_with_users[] = $team;
      }

      return $teams_with_users;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in geAllMainTeams: " . $e->getMessage());
    }
  }
}
