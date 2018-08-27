<?php 

namespace App\Traits;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

trait UploadTrait {

    protected $configUpload = [
        'fieldInput' => 'file',
        'extensions' => ['jpeg','jpg','png','gif'],
        'path'       => 'images',
        'dbFieldFile'=> 'photo',
        'thumbs'     => []
    ];

    protected $configThumbs = [];

    protected function configUpload( $config = [] )
    {
        if(isset($config['field'])){
            $this->configUpload['fieldInput'] = $config['field'];
        }

        if(isset($config['extensions'])){
            $this->configUpload['validExtensions'] = $config['extensions'];
        }

        if(isset($config['path'])){
            $this->configUpload['path'] = $config['path'];
        }

        if(isset($config['dbFieldFile'])){
            $this->configUpload['dbFieldFile'] = $config['dbFieldFile'];
        }

        if(isset($config['dbFieldPath'])){
            $this->configUpload['dbFieldPath'] = $config['dbFieldPath'];
        }

        if(isset($config['thumbs'])){
            $this->configUpload['thumbs'] = $config['thumbs'];
        }

        return $this;

    }

    private function uploadImage($name = null)
    {

        $file = \Request::file($this->configUpload['fieldInput']);

        if( is_null($file) || !$file->isValid() || !in_array( $file->extension(), $this->configUpload['extensions']) ){
            return null;
        }
        
        $extension = $file->extension();

        $fileName = $file->getClientOriginalName();

        if( isset($name) ) {

            if( $name == 'uniq' ){
                $name = uniqid(date('HisYmd'));
            }

            $fileName = $name.'.'.$extension;

        }

        $fullPath = $file->storeAs($this->configUpload['path'], $fileName);

        return [
            'fullPath'  => $fullPath,
            'file'      => $fileName
        ];

    }

    private function fillUpload($model, $name = null){

        $fileData = $this->uploadImage($name);

        if( !$fileData ){
            return $model;
        }

        $this->makeThumb($fileData);

        $data = [];

        $field = $this->configUpload['dbFieldFile'];

        $data[$field] = $fileData['file'];

        $existingFile = $model->{$field};

        if($existingFile){
            $this->removeFile($existingFile);
        }

        $model->fill($data);

        return $model;
    }

    protected function makeThumb($fileData){

        $p = \Storage::disk(config('filesystems.default'))->getDriver()->getAdapter()->getPathPrefix();

        if( isset($this->configUpload['thumbs']) ){

            foreach ($this->configUpload['thumbs']['sizes'] as $key => $value) {

                $img = Image::make($p.$this->configUpload['path'].'/'.$fileData['file'])->fit($value[0], $value[1], function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
            
                $img->save($p.$this->configUpload['path'].'/'.$key.'_'.$fileData['file']); 
            }

        }

    }

    protected function removeFile($file)
    {
        $f = $file;

        $prefix = \Storage::disk(config('filesystems.default'))->getDriver()->getAdapter()->getPathPrefix();
        $file = $prefix . $this->configUpload['path'] . '/' . $file;
        if (file_exists($file) and !is_dir($file)) {
            unlink($file);
        }

        if( isset($this->configUpload['thumbs']) ){

            foreach ($this->configUpload['thumbs']['sizes'] as $key => $value) {     
                $thumbFile = $prefix.$key.'_'.$f;
                if (file_exists($thumbFile) and !is_dir($thumbFile)) {
                    unlink($thumbFile);
                }
            }

        }

    }

}
