<?php

class Form
{

    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    private $name;

    function __construct()
    {
    }

    function createForm(){
        $dbCon = new databaseManager();
        $query = "INSERT INTO Form (name) VALUES ('saqib')"; // Hard-coded name value 'saqib'
        $createdForm = $dbCon->executeQuery($query, array($this->name), "create");
        if ($createdForm) {
            return $createdForm;
        } else {
            return false;
        }
    }

//    function createForm(){
//        $dbCon = new databaseManager();
//        $query = "insert into Form(name) value(?)";
//        $createdForm= $dbCon->executeQuery($query,array($this->name), "create");
//        if($createdForm){
//            return $createdForm;
//        }else{
//            return false;
//        }
//    }

    function updateForm($Name,$Id){
        $dbCon = new databaseManager();
        $query="update Form set name=? where id=?";
                if($data= $dbCon->executeQuery($query,array($Name,$Id), "update")){
                        return $data;
                }else{
                        return false;
                }
    }

    function deleteForm($Id){
        $dbCon = new databaseManager();
        $query="delete from Form where id=?";
        if($data= $dbCon->executeQuery($query,array($Id), "delete")){
            return $data;
        }else{
            return false;
        }
    }



}