<?php

namespace PhucThinh\API\Transformers;

use Carbon\Carbon;
use League\Fractal;
use PhucThinh\IOT\Models\Factory;

class FactoryTransformer extends Fractal\TransformerAbstract {

    public function transform(Factory $factory) {      
        return [
            'id' => (int) $factory->id,
			'factory_id' => (int) $factory->factory_id,
            'name' => (string) $factory->name,
            'ip' => (string) $factory->ip,            
            'langtitude' => $factory->langtitude,
            'longtitude' => $factory->longtitude,  
			'address' => (string) $factory->address,			
            'thumbnail' => $factory->thumbnail?$factory->thumbnail->getPath():'',            
            'overview' => $factory->overview?$factory->overview->getPath():'',            
			'overview_app' => $this->rotateImage($factory->overview, $factory->factory_id)
        ];
    }
	
	private function rotateImage($file, $factoryID){
		$url = url('');
		$extensionFile = $file->getExtension();	
		$fileName = $file->getPath();
		$degrees = -90;
		$path = storage_path('app/media/rotate/');
		$fileNameRotate = 'overview-'.$factoryID.'.'.$extensionFile;
		$fileSave = $path.$fileNameRotate;
		$fileRotate = $url.'/storage/app/media/rotate/'.$fileNameRotate;
		if($extensionFile == 'png'){
			$source = imagecreatefrompng($fileName);		 
			$rotate = imagerotate($source, $degrees, 0);			
			imagepng($rotate, $fileSave);
		}		
		else{
			$source = imagecreatefromjpeg($fileName);		 
			$rotate = imagerotate($source, $degrees, 0);			
			imagejpeg($rotate, $fileSave);
		}
		return $fileRotate;
	}

}
