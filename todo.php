<?php
Interface Todo{
    public function create($data);
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function update($id,$data);
}
?>