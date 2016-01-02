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

    public static function getPathForCV($fileName)
    {
        return storage_path(self::CV_FILES_PATH . $fileName);
    }
}
