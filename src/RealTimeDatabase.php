<?php

namespace Deigon\SDK;

use Kreait\Firebase\Factory;
use Throwable;

class RealTimeDatabase
{

    private $uri = '';
    private $table = '';
    private $database;
    private $reference = [];
    private $configFile;

    /**
     * RealTimeDatabase constructor.
     * @param $uri
     */
    public function __construct($uri, $configFile)
    {
        $this->uri = $uri;
        $this->configFile = $configFile;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param String $table
     */
    public function setTable(String $table){
        $this->table = $table;
    }

    /**
     * @return $this
     */
    public function init(): RealTimeDatabase
    {
        $this->database = (new Factory())
            ->withServiceAccount($this->configFile)
            ->withDatabaseUri($this->uri)->createDatabase();
        return $this;
    }

    /**
     * @param null $ref
     * @return array|RealTimeDatabase
     */
    public function references($ref = null)
    {
        if(is_null($ref)){
            return $this->reference;
        }
        $this->reference[] = $ref;
        return $this;
    }

    /**
     * @return mixed
     */
    public function snapshot(){
        return $this->getReference()->getSnapshot();
    }

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->snapshot()->getValue();
    }

    /**
     * @param array $dataAttributes
     * @return Throwable
     */
    public function create(Array $dataAttributes){
        try {
            $this->getReference()->push($dataAttributes);
        }catch (Throwable $th){
            return $th;
        }
    }

    /**
     * @param int $id
     * @param array $dataAttributes
     */
    public function update(int $id, Array $dataAttributes){
        $this->references($id);
        $this->create($dataAttributes);
    }

    /**
     * @param String $ref
     */
    public function delete(String $ref){
        $this->references($ref);
        $this->getReference()->remove();
    }

    /**
     * @return mixed
     */
    private function getReference(){
        return $this->database->getReference(implode('/', $this->reference));
    }
}