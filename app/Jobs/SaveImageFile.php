<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SaveImageFile extends Job implements SelfHandling
{
    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = $this->generateRandomFileName();

        $this->saveOriginalImage($fileName);

        return $fileName;
    }

    private function generateRandomFileName(){
        return str_random(20) . '.' . $this->file->getClientOriginalExtension();
    }

    private function saveOriginalImage($fileName){
        Storage::put(
            config('upload_paths.pins') . $fileName,
            file_get_contents($this->file->getRealPath())
        );
    }
}
