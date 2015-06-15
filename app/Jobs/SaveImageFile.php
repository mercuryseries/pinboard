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

        $this->checksIfDirectoryExistsOrCreate(config('uploads_paths.pins.original'));
        $this->checksIfDirectoryExistsOrCreate(config('uploads_paths.pins.medium'));

        $this->saveOriginalImage($image, $fileName);

        $this->saveMediumImage($image, $fileName);

        return $fileName;
    }

    private function generateRandomFileName(){
        return str_random(20) . '.' . $this->file->getClientOriginalExtension();
    }

    private function checksIfDirectoryExistsOrCreate($path){
        return File::exists($path) or File::makeDirectory($path, 0755, true);
    }

    private function saveOriginalImage($image, $fileName){
        $image->save(config('uploads_paths.pins.original') . $fileName);
    }

    private function saveMediumImage($image, $fileName){
        $image->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
              ->save(config('uploads_paths.pins.medium') . $fileName);
    }
}
