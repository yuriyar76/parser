<?php


namespace App\Models;


use App\Model;

class Link extends Model
{
    protected const TABLE = 'links';
    public $id_cat;
    public $name_cat;
    public $abslink;
    public $alias_cat;

}