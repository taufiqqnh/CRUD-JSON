<?php
namespace App\Models;
use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'nim';


    protected $allowedFields = ['nim', 'nama', 'tmplahir', 'tgllahir', 'jenkel'];


}