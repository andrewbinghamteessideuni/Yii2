<?php

//New function for actionAddproperty -- update 16/10/18 to make more simple
//Place this function within the site controller
    public function actionAddproperty()
    {
      //define three models
      $properties = new Properties();
      $images = new Images();
      $propertiesImages = new PropertiesImages();



      //return true only if the view has posted data
      if ($properties->load(Yii::$app->request->post()))  {

        //save created, updated and delete attributes within class, not view
        $properties->Created = date("Y-m-d");
        $properties->Updated = "0000-00-00";
        $properties->Deleted = "0000-00-00";

        $images->Created = date("Y-m-d");
        $images->Updated = "0000-00-00";
        $images->Deleted = "0000-00-00";


        //process file

        $images->ImagePath = UploadedFile::getInstance($images, 'ImagePath');

        $images->ImagePath->saveAs('/web/users/u0018370/Yii2/basic/web/uploads/' . $images->ImagePath->baseName . '.' . $images->ImagePath->extension);

        $images->ImagePath = "uploads/".$images->ImagePath->baseName . '.' . $images->ImagePath->extension;


        if ($properties->validate() && $images->validate()) {


         $properties->save();
         $images->save();


         //get PKs from properties and images for use in our mapping model
         $propertiesImages->PropertiesID = $properties->PropertiesID ;
         $propertiesImages->ImagesID = $images->ImagesID  ;

            if ($propertiesImages->validate()) {

            //save to the mapping model
            $propertiesImages->save();

            }else{

            throw Exception('Unable to save related record.');
            $errors = $propertiesImages->errors;
            var_dump($errors);
            }




         //return to controller view
        return $this->redirect(['/properties']);


        }else{

        throw Exception('Unable to save images or properties records.');
        $errors = $properties->errors;
        var_dump($errors);

      }//close validate properties / images

    }//close if post



       return $this->render('addproperty', [

          //send the models to the view
           'properties' => $properties, 'images' => $images,
       ]);

    }//close actionAddproperty

    
    ?>
