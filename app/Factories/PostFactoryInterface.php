<?php
namespace App\Factories;

interface PostFactoryInterface
{
    public function all();
    public function create(array $attributes);
    public function find($id);
    public function update($id, array $attributes);
    public function delete($id);
}