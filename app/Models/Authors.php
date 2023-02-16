<?php

namespace App\Models;

use App\Models\Book;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Authors extends Authenticatable

{
    use HasFactory, HasApiTokens;
    protected $fillable = ["name", "email", "password", "phone_no"];


    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
