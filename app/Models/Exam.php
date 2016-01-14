<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    const LEVEL_EASY    = 1;
    const LEVEL_MEDIUM  = 2;
    const LEVEL_HARD    = 3;

    /**
     * @var string
     */
    protected $table = 'exams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
        'level', 'time', 'is_public'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'exam_id', 'id');
    }

    /**
     * @param $name
     * @return int
     */
    public static function getLevelByName($name)
    {
        switch($name) {
            case 'easy':
                return self::LEVEL_EASY;
            case 'medium':
                return self::LEVEL_MEDIUM;
            case 'hard':
                return self::LEVEL_HARD;
        }
    }

    /**
     * @param $index
     * @return string
     */
    public static function getLevelNameByIndex($index)
    {
        switch($index) {
            case self::LEVEL_EASY:
                return 'easy';
            case self::LEVEL_MEDIUM:
                return 'medium';
            case self::LEVEL_HARD:
                return 'hard';
        }
    }
}
