<?php

require_once 'utilities/Model.php';
require_once 'User.php';

class Task  extends Model
{
    private int $id;
    private string $name;
    private string $to_do_at; // TODO change type
    private bool $is_done;
    private int $id_user;



    // accesseurs (getters & setters)

    /**
     * Permet de récupérer l'identifiant de la tâche
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getToDoAt(): string
    {
        return $this->to_do_at;
    }

    /**
     * @param string $to_do_at
     * @return void
     */
    public function setToDoAt(string $to_do_at): void
    {
        $this->to_do_at = $to_do_at;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->is_done;
    }

    /**
     * @param bool $is_done
     * @return void
     */
    public function setIsDone(bool $is_done): void
    {
        $this->is_done = $is_done;
    }


    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return void
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * Récupérer une tache avec son id
     * @param int $id
     * @return array|false
     */
    public function getTaskById(int $id) : array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Ajouter une tache dans la bdd
     * @return void
     */
    public function add() : void
    {
        $stmt = $this->pdo->prepare("INSERT INTO task (`name`,`to_do_at`,`id_user`) VALUES (:name, :to_do_at, :id_user");
        $stmt->execute([
            "name" => $this->name,
            "to_do_at" => $this->to_do_at,
            "id_user" => $this->id_user
        ]);
    }

    /**
     * Supprimer une tache dans la bdd
     * @return void
     *  */  
    public function delete() : void
    {
        $stmt = $this->pdo->prepare("DELETE FROM task WHERE id=:id");
        $stmt->execute([
            "id" => $this->id
        ]);
    }

    /**
     * Editer une tache en la trouvant avec son id
     * 
     */
    public function edit(int $id) : self|false
    {
        $stmt = $this->pdo->prepare("UPDATE  task SET `name` = :new_name, `to_do_at` = :new_date WHERE id = :id ");
        $stmt->execute([
            "new_name" => ,
            "new_date" => ,
            "id" => $this->id
        ]);
        return $stmt->fetch();
    }

    /**
     * Déclarer une tache comme faite
     * 
     */


    /**
     * Afficher les taches
     * @param int $id_user
     * @return array|false
     */

    public function getTasks(int $id_user) : array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id_user = :id_user ");
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetch();
    }
}

