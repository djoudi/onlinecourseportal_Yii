<?php

class ViewAction extends CViewAction {
	
	private $_id;
	private $_viewPath;

	public function __construct($controller, $id) {
		parent::__construct($controller, $id);
		$this->_id = strtr($this->getRequestedView(), array('/' => '.', DIRECTORY_SEPARATOR => '.'));
	}
	
	/**
	 * Returns the name of the view requested by the user.
	 * If the user doesn't specify any view, the {@link defaultView} will be returned.
	 * @return string the name of the view requested by the user.
	 * This is in the format of 'path.to.view'.
	 */
	public function getRequestedView()
	{
		if($this->_viewPath === null)
		{
			$this->_viewPath = $this->getId();
			foreach($_GET as $key => $value) {
				if(!empty($key))
					$this->_viewPath .= "/$key";
				if(!empty($value))
					$this->_viewPath = "/$value";
			}
		}
		return $this->_viewPath;
	}

	/**
	 * Resolves the user-specified view into a valid view name.
	 * @param string $viewPath user-specified view in the format of 'path.to.view'.
	 * @return string fully resolved view in the format of 'path/to/view'.
	 * @throw CHttpException if the user-specified view is invalid
	 */
	protected function resolveView($viewPath)
	{
		// start with a word char and have word chars, dots and dashes only
		if(preg_match('/^\w[\w\.\-\/]*$/',$viewPath))
		{
			$view = strtr($viewPath, array('.' => DIRECTORY_SEPARATOR, '/' => DIRECTORY_SEPARATOR));
			if(!empty($this->basePath))
				$view=$this->basePath . DIRECTORY_SEPARATOR . $view;
			if($this->getController()->getViewFile($view)!==false)
			{
				$this->view = $view;
				return;
			}
		}
		throw new CHttpException(404,Yii::t('yii','The requested view "{name}" was not found.',
			array('{name}'=>$viewPath)));
	}

}