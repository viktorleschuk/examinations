<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class Question extends Model
{
    const TYPE_VARIOUS  = 1;
    const TYPE_TEXT     = 2;

    /**
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id', 'title',
        'weight', 'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    /**
     * @param $index
     * @return null|string
     */
    public static function getTypeNameByIndex($index)
    {
        switch($index){
            case 1:
                return 'various';
            case 2:
                return 'text';
            default:
                return null;
        }
    }

    /**
     * @param $name
     * @return int|null
     */
    public static function getTypeByName($name)
    {
        switch($name){
            case 'text':
                return self::TYPE_TEXT;
            case 'various':
                return self::TYPE_VARIOUS;
            default:
                return null;
        }
    }

    /**
     * @return bool
     */
    public function validate()
    {
        if($this->getAttribute('type') == self::TYPE_VARIOUS) {

            return count($this->answers) >= 2;
        }

        return true;
    }

    public function hasCorrectAnswer()
    {
        return $this->hasOne('App\Models\Answer')
            ->where('is_correct' === true);
    }
}