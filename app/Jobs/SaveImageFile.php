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
        $image = Image::make( $this->file->getRealPath() );

        $fileName = $this->generateRandomFileName();

        $this->checksIfUploadDirectoryExistsOrCreate(config('uploads_paths.pins.original'));
        $this->checksIfUploadDirectoryExistsOrCreate(config('uploads_paths.pins.medium'));

        $image->save(public_path() . config('uploads_paths.pins.original') . $fileName);

        $image->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
              ->save(public_path(). config('uploads_paths.pins.medium') . $fileName);

        return $fileName;
    }

    private function generateRandomFileName(){
        return str_random(20) . '.' . $this->file->getClientOriginalExtension();
    }

    private function checksIfUploadDirectoryExistsOrCreate($path){
        return File::exists($path) or File::makeDirectory($path, 0755, true);
    }
}
