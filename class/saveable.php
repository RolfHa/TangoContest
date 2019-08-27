<?php

interface Saveable {
    public function save($objk);
    public function change($id);
    public function delete($id);
    public function getAll();
    public function getHById($id);
}

?>

