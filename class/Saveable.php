<?php

interface Saveable {
    public static function save($objk);
    public static function change($id);
    public static function delete($id);
    public static function getAll();
    public static function getById($id);
}

?>

