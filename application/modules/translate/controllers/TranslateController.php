<?php
class TranslateController extends TranslateBaseController {
	
	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
				array('filters.HttpsFilter'),
				'accessControl - set',
		);
	}
	
	public function accessRules() {
		return array(
				array('allow',
						'expression' => '$user->isAdmin',
				),
				array('deny',
						'users' => array('*'),
				),
		);
	}
	
	public function actionIndex() {
        if(isset($_POST['Message'])) {
            foreach($_POST['Message'] as $id => $message) {
                if(empty($message['translation']))
                    continue;
                $model = new Message();
                $message['id'] = $id;
                $model->setAttributes($message);
                $model->save();
            }
            $this->redirect(Yii::app()->getUser()->getReturnUrl());
        }
        if(($referer = Yii::app()->getRequest()->getUrlReferrer()) && $referer !== $this->createUrl('index'))
            Yii::app()->getUser()->setReturnUrl($referer);
        $translator = TranslateModule::translator();
        $key = $translator::ID."-missing";
        if(isset($_POST[$key]))
            $postMissing = $_POST[$key];
        elseif(Yii::app()->getUser()->hasState($key))
            $postMissing = Yii::app()->getUser()->getState($key);
        else
        	$postMissing = array();
        
        if(count($postMissing)) {
            Yii::app()->getUser()->setState($key,$postMissing); 
            $count = 0;
            foreach($postMissing as $id=>$message){
                $models[$count] = new Message;
                $models[$count]->setAttributes(array('id' => $id, 'language' => $message['language']));
                $count++;
            }
        } else {
            $this->renderText(TranslateModule::t('All messages translated'));
            Yii::app()->end();
        }
        
        $data = array('messages' => $postMissing, 'models' => $models);
        
        $this->render('index', $data);
	}
	
    function actionSet(){
        $translator=TranslateModule::translator();
        if(Yii::app()->getRequest()->getIsPostRequest()){
            TranslateModule::translator()->setLanguage($_POST[$translator::ID]);
            $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
        }else
            throw new CHttpException(400);
    }
    
    function actionGoogletranslate(){
        if(Yii::app()->getRequest()->getIsPostRequest()){
            $translation=TranslateModule::translator()->googleTranslate($_POST['message'],$_POST['language'],$_POST['sourceLanguage']);
            if(is_array($translation))
                echo CJSON::encode($translation);
            else
                echo $translation;
        }else
            throw new CHttpException(400);
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionCreate($id,$language)
    {
    	$model=new Message('create');
    	$model->id=$id;
    	$model->language=$language;
    
    	if(isset($_POST['Message'])){
    		$model->attributes=$_POST['Message'];
    		if($model->save())
    			$this->redirect(array('missing'));
    	}
    
    	$this->render('form',array('model'=>$model));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id,$language)
    {
    	$model=$this->translateLoadModel($id,$language);
    
    	if(isset($_POST['Message'])){
    		$model->attributes=$_POST['Message'];
    		if($model->save())
    			$this->redirect(array('admin'));
    	}
    
    	$this->render('form',array('model'=>$model));
    }
    /**
     * Deletes a record
     * @param integer $id the ID of the model to be deleted
     * @param string $language the language of the model to de deleted
     */
    public function actionDelete($id,$language)
    {
    	if(Yii::app()->getRequest()->getIsPostRequest()){
    		$model=$this->translateLoadModel($id,$language);
    		if($model->delete()){
    			if(Yii::app()->getRequest()->getIsAjaxRequest()){
    				echo TranslateModule::t('Message deleted successfully');
    				Yii::app()->end();
    			}else
    				$this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    		}
    	}else
    		throw new CHttpException(400);
    
    }
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
    	$message = new Message('search');
    	$message->unsetAttributes();  // clear any default values
    	if(isset($_GET['Message']))
    		$message->attributes=$_GET['Message'];

    
    	$messageSource->language=TranslateModule::translator()->getLanguage();
    
    	$this->render('admin',array(
    			'message' => $message,
    			'messageSource' => $messageSource,
    	));
    }
    
    public function actionMissing() {
    	
    	$messageSource=new MessageSource('search');
    	$messageSource->unsetAttributes();  // clear any default values
    	
    	if(isset($_GET['MessageSource']))
    		$messageSource->attributes=$_GET['MessageSource'];
    	
    	$this->render('missing',array(
    			'model' => $messageSource,
    	));
    }
    
    /**
     * Deletes a record
     * @param integer $id the ID of the model to be deleted
     * @param string $language the language of the model to de deleted
     */
    public function actionMissingdelete($id)
    {
    	if(Yii::app()->getRequest()->getIsPostRequest()){
    		$model=MessageSource::model()->findByPk($id);
    		if($model->delete()){
    			if(Yii::app()->getRequest()->getIsAjaxRequest()){
    				echo TranslateModule::t('Message deleted successfully');
    				Yii::app()->end();
    			}else
    				$this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    		}
    	}else
    		throw new CHttpException(400);
    
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function translateLoadModel($id,$language)
    {
    	$model=Message::model()->findByPk(array('id'=>$id,'language'=>$language));
    	if($model===null)
    		throw new CHttpException(404,'The requested page does not exist.');
    	return $model;
    }
    
}