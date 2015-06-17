<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\File;
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

        $destination = config('laravel-glide.source.path'). '/pins';

        $this->checksIfDirectoryExistsOrCreate($destination);

        $this->saveOriginalImage($destination, $fileName);

        return $fileName;
    }

    private function generateRandomFileName(){
        return str_random(20) . '.' . $this->file->getClientOriginalExtension();
    }

    private function checksIfDirectoryExistsOrCreate($path){
        return File::exists($path) or File::makeDirectory($path, 0755, true);
    }

    private function saveOriginalImage($destination, $fileName){
        $this->file->move($destination, $fileName);
    }
}
