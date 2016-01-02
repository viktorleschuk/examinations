<?php

namespace App\Jobs;

use App\Models\Participant;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadCVForParticipant extends Job implements SelfHandling
{

    protected $participant;

    protected $cvFile;

    /**
     * UploadCVForParticipant constructor.
     * @param Participant $participant
     * @param UploadedFile $cvFile
     */
    public function __construct(Participant $participant, UploadedFile $cvFile)
    {
        $this->participant = $participant;
        $this->cvFile = $cvFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = sha1(uniqid($this->participant->getKey())) . '.' . $this->cvFile->getClientOriginalExtension();

        $path = Participant::getPathForCV($fileName);

        $this->cvFile->move($path, $fileName);

        $this->participant->setAttribute('cv_file', $fileName);
        $this->participant->save();
    }
}
