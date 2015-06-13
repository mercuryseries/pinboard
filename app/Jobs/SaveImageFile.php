<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SaveImageFile extends Job implements SelfHandling
{
    private $file;

    private $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $path)
    {
        $this->file = $file;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $image = Image::make( $this->file->getRealPath() );

        $fileName = $this->generateRandomFileName();

        $this->checksIfUploadDirectoryExistsOrCreate();

        $image->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
              ->save( public_path(). $this->path . $fileName );

        return $this->path . $fileName;
    }

    private function generateRandomFileName(){
        return str_random(20) . '.' . $this->file->getClientOriginalExtension();
    }

    private function checksIfUploadDirectoryExistsOrCreate(){
        return File::exists($this->path) or File::makeDirectory($this->path, 0755, true);
    }
}
