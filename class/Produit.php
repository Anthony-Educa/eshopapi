<?php

class Produit{
    /*VARIABLES*/
    private $idProduit;
    private $libelle;
    private $description;
    private $prix;
    private $image;
    
    /*GETTERS*/
    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getImage() {
        return $this->image;
    }
    /*SETTERS*/

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setImage($image) {
        $this->image = $image;
    }


    private static $select = "select * from  produit";
    private static $selectById = "select * from produit where idProduit = :idProduit";
    private static $insert = "insert into produit (libelle,description,image,prix) values (:libelle,:description,:image,:prix)";
    private static $update = "update produit set libelle =:libelle,description=:description,image=:image,prix=:prix where idProduit=:idProduit";
    /*METHODS*/
            private static function arrayToProduit(Array $array){
            $p = new Produit();
            $p -> idProduit = $array["idProduit"];
            $p -> libelle = $array["libelle"];
            $p -> description = $array["description"];
            $p -> image = $array["image"];
            $p -> prix = $array["prix"];
            return $p;
        }
        public static function fetchAll(){
            $collectionProduit = null;
            $pdo = (new DBA())-> getPDO();
            $pdoStatement = $pdo -> query(Produit::$select);
            $recordSet = $pdoStatement-> fetchAll(PDO::FETCH_ASSOC);
            foreach($recordSet as $record){
                $collectionProduit[] = Produit::arrayToProduit($record);
            }
            return $collectionProduit;
        }
        
        public static function fetch($idProduit){
            $pdo = (new DBA()) -> getPDO;
            $pdoStatement = $pdo -> prepare(Produit::$selectById);
            $pdoStatement -> bindParam(":idProduit", $idProduit);
            $pdoStatement -> execute();
            $record = $pdoStatement -> fetch(PDO::FETCH_ASSOC);
            $produit = Produit::arrayToProduit($record);
            return $produit;
        }
        public function save(){
            if($this ->idProduit == null) {
                $this -> insert();
            }
            else{
                $this->update();
            }
        }
        public function insert(){
            $pdo = (new DBA()) ->getPDO();
            $pdoStatement = $pdo -> prepare(Produit::$insert);
            $pdoStatement -> bindParam(":libelle", $this ->libelle);
            $pdoStatement -> bindParam(":description",$this ->description);
            $pdoStatement -> bindParam(":image",$this -> image);
            $pdoStatement -> bindParam(":prix",$this ->prix);
            $pdoStatement -> execute();
            $this->idProduit = $pdo ->lastInsertId();
        }
        
        public function update(){
            $pdo = (new DBA()) ->getPDO();
            $pdoStatement = $pdo -> prepare(Produit::$update);
            $pdoStatement -> bindParam("idProduit", $this ->idProduit);
            $pdoStatement -> bindParam(":libelle", $this ->libelle);
            $pdoStatement -> bindParam(":description",$this ->description);
            $pdoStatement -> bindParam(":image",$this -> image);
            $pdoStatement -> bindParam(":prix",$this ->prix);
        }
        public function delete(){
            $pdo = (new DBA()) ->getPDO();
            $pdoStatement = $pdo -> prepare(Produit::$delete);
            $pdoStatement -> bindParam("idProduit",$this->idProduit);
            $resultat = $pdoStatement -> execute();
            $nblignesAffectees = $pdoStatement -> rowCount();
            if ($nblignesAffectees ==1){
                $this->idProduit= null;
            }
            return $resultat;
        }
     
}

