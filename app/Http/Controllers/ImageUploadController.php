<?php

  

namespace App\Http\Controllers;

use Aws\CommandPool;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class File {
    public $url;
    public $path;
    public $name;
    public $type;

    public function __construct($name, $type, $path, $url=null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->path = $path;
    }
}

class ImageUploadController extends Controller

{

     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUpload()

    {

        return view('upload');

    }

    

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function imageUploadPost(Request $request)

    {

        $request->validate([

            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            
        ]);

        /* Store $imageName name in DATABASE from HERE */
        $client = Storage::disk('minio')->getDriver()->getAdapter()->getClient();
        $images = $request->file('images');

        $files = [];
        $time_start = microtime(true);

        foreach($images as $image) {
            $fileName = Str::random(10) . time();
            $fileType = $image->extension();  
            $filePath = config('define.upload_path_zip_file') . 'images/' . $fileName . '.'. $image->extension(); 

            // Way 1
            /*-------------------------------*/ 
            // $client->putObject(array(
            //     'Bucket'     => 'dev-testing',
            //     'Key'        => $filePath,
            //     'SourceFile' => $image,
            // ));
            // 
            // $url = Storage::disk('minio')->temporaryUrl(
            //     $filePath, Carbon::now()->addMinutes(1)
            // );
            // 
            // Redis::set($filePath, $url, 'EX', 600);

            // Way2
            /*-------------------------------*/ 
            $commands[] = $client->getCommand('putObject', [
                'Bucket'     => 'dev-testing',
                'Key'        => $filePath,
                'SourceFile' => $image
            ]);


            $files[] = new File($fileName, $fileType, $filePath);
        }
        // Way 2
        /* Initiate the pool transfers, force the pool to complete synchronously */
        $pool = new CommandPool($client, $commands);
        $promise = $pool->promise();
        $promise->wait();

        $time_end = microtime(true);
        return back()

            ->with('success','You have successfully upload images.')

            ->with('files', $files)
            
            ->with('time', (number_format($time_end - $time_start, 2, ',', ' ')));
    }

    public function getPreSignedUrl(Request $request) 
    {
        $filePath = $request->bucket . '/' . $request->image;
        $url = Redis::get($filePath);
        $redis = Redis::connection();

        if($redis->ping()){
            dd(Redis::get('long'));
        }
        else{
            dd("expression2");
        }
        if(empty($url)) {
            $url = Storage::disk('minio')->temporaryUrl(
                $filePath, Carbon::now()->addMinutes(10)
            );
            Redis::set($filePath, $url, 'EX', 600);
        }

        return Redirect::to($url);
    }

}