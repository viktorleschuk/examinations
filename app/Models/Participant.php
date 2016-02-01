<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    const CV_FILES_PATH = 'cv/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'country_id',
        'city', 'phone_number', 'skype_name', 'cv_file'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getPathForCV($fileName)
    {
        return storage_path(self::CV_FILES_PATH . $fileName);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantExams()
    {
        return $this->hasMany('App\Models\ParticipantExam');
    }

    /**
     * @param \App\Models\Exam $exam
     * @return mixed
     */
    public function getParticipantExam(Exam $exam)
    {
        return $this->getAttribute('participantExams')
            ->where('exam_id', $exam->getKey())
            ->first();
    }

    /**
     * @param \App\Models\Exam $exam
     * @return string
     */
    public function getExamStatusName(Exam $exam)
    {
        return $this->getParticipantExam($exam)
            ->getStatusName();
    }
}
