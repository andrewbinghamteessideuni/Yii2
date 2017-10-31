<?php

//New function for actionAddproperty
    public function actionAddproperty()
    {
      //save to three models
      $properties = new Properties();
      $images = new Images();
      $propertiesImages = new PropertiesImages();

      $transaction = Yii::$app->db->beginTransaction();

      try {
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


        //get PK's for FK's in linking model
         $propertiesImages->PropertiesID = $properties->PropertiesID ;
         $propertiesImages->ImagesID = $images->ImagesID  ;

            if ($propertiesImages->validate()) {

            $propertiesImages->save();

            }else{

            throw Exception('Unable to save related record.');
            $errors = $propertiesImages->errors;
            var_dump($errors);
            }



         $transaction->commit();
         //return to controller view
        return $this->redirect(['/properties']);
         //return;
        }else{

        throw Exception('Unable to save images or properties records.');
        $errors = $properties->errors;
        var_dump($errors);

        }

        }

        } catch(Exception $e) {
          $transaction->rollback();
      }//close try



       return $this->render('addproperty', [
           'properties' => $properties, 'images' => $images,
       ]);

    }//close actionAddproperty
    
    ?>
