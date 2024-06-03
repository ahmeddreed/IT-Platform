<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'rating_number'
    ];

    public function userRating($user_id,$course_id){// Get the Rating of user
        $number = $this->where("user_id",$user_id)->where("course_id",$course_id);// Get the hte number of Rating
        if($number->exists())//User Evaluation
            return $number->first()->rating_number;
        else{//User did not Evaluation
            return $number =  0;
        }

    }
}
