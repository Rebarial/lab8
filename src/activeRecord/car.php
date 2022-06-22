<?php

namespace activeRecord;
use PDO;

class car
{
    private $id;
    private $mark;
    private $model;

    private $connect;

    function __construct(){
        $this->connect = new PDO("mysql:host=localhost;dbname=lr8", "lr8user", "lr8parol");
    }

    public function getId()
    {
        return $this->id;
    }
    public function getMark()
    {
        return $this->mark;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function setID($i){
        $this->id = $i;
    }
    public function setModel($mo){
        $this->model = $mo;
    }
    public function setMark($ma){
        $this->mark = $ma;
    }
    public function fById($id){
        $sql = 'select * from cars where id ='. $id;
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function fByMark($mark){
        $sql = 'select * from cars where mark = '. "'". $mark . "'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAll(){
        $sql = 'select * from cars';
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function add(){
        $sql = 'insert into cars (id, model, mark) values (' . $this->id . ', ' . "'". $this->mark . "'". ', ' . "'". $this->model . "'". ')';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('mark', $this->mark);
        $stmt->bindParam('model', $this->model);
        $stmt->execute();
    }

    public function delete(){
        $sql = 'delete from cars where id = ' . $this->id;
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('id', $this->id);
        $stmt->execute();
    }

}