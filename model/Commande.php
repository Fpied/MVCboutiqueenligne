<?php

class Commande{
    private int $id;
    private int $user_id;
    private string $created_at;
    private int $total;
  

    public function __construct(int $id, int $user_id, string $created_at, int $total)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->total = $total;
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id(int $user_id){
        $this->user_id = $user_id;
    }

    public function getCreated_at(){
        return $this->created_at;
    }

    public function setCreated_at(string $created_at){
        $this->created_at = $created_at;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setTotal(int $total){
        $this->total = $total;
    }
}