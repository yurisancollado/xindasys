<?php

class ProductoController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array('accessControl', // perform access control for CRUD operations
		'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array( array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('index', 'view'), 'users' => array('*'), ), array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update', 'loadImage', 'pedido', 'ajaxupdate'), 'users' => array('@'), ), array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin', 'delete'), 'users' => array('admin'), ), array('deny', // deny all users
		'users' => array('*'), ), );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this -> render('view', array('model' => $this -> loadModel($id), ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Producto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Producto'])) {
			$model -> attributes = $_POST['Producto'];
			if (!empty($_FILES['Producto']['tmp_name']['binaryfile'])) {
				$file = CUploadedFile::getInstance($model, 'binaryfile');
				$model -> fileName = $file -> name;
				$model -> fileType = $file -> type;
				$fp = fopen($file -> tempName, 'r');
				$content = fread($fp, filesize($file -> tempName));
				fclose($fp);
				$model -> binaryfile = $content;
			}
			if ($model -> save())
				$this -> redirect(array('view', 'id' => $model -> id));
		}

		$this -> render('create', array('model' => $model, ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this -> loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Producto'])) {
			$model -> attributes = $_POST['Producto'];
			if (!empty($_FILES['Producto']['tmp_name']['binaryfile'])) {
				$file = CUploadedFile::getInstance($model, 'binaryfile');
				$model -> fileName = $file -> name;
				$model -> fileType = $file -> type;
				$fp = fopen($file -> tempName, 'r');
				$content = fread($fp, filesize($file -> tempName));
				fclose($fp);
				$model -> binaryfile = $content;
			}
			if ($model -> save())
				$this -> redirect(array('view', 'id' => $model -> id));
		}

		$this -> render('update', array('model' => $model, ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this -> loadModel($id) -> delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this -> redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Producto');
		$this -> render('index', array('dataProvider' => $dataProvider, ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Producto('search');
		$model -> unsetAttributes();
		// clear any default values
		if (isset($_GET['Producto']))
			$model -> attributes = $_GET['Producto'];

		$this -> render('admin', array('model' => $model, ));
	}

	public function actionPedido() {
		$model = new Producto('search');
		$id = $_GET['id'];
		$model -> unsetAttributes();
		// clear any default values
		if (isset($_GET['Producto']))
			$model -> attributes = $_GET['Producto'];

		$this -> render('pedido', array('model' => $model, 'id' => $id, ));
	}

	public function actionAjaxupdate() {
		$act = $_GET['act'];
		$id = $_GET['id'];

		$autoIdAll = $_POST['autoId'];

		if ($act == 'doDeleteAll') {
			$listmodel = PedidoHasProductos::model() -> findAllByAttributes(array('pedido_id' => $id));
			foreach ($listmodel as $model) {
				if ($model -> delete())
					echo 'ok';
			}
		} else {
			echo "entro";
			if (count($autoIdAll) > 0) {
				echo "entro 2";
				foreach ($autoIdAll as $autoId) {
					if ($act == 'doAdd') {
						$model2 = PedidoHasProductos::model() -> findByAttributes(array('pedido_id' => $id, 'productos_id' => $autoId));
						if (!$model2) {
							$model = new PedidoHasProductos;
							$model -> pedido_id = $id;
							$model -> productos_id = $autoId;
							if ($model -> save())
								echo 'ok';
						}
					}
					if ($act == 'doDelete') {
						$model = PedidoHasProductos::model() -> findByAttributes(array('pedido_id' => $id, 'productos_id' => $autoId));
						if ($model)
							if ($model -> delete())
								echo 'ok';
							else
								echo 'NO elimina';
						else
							echo 'NO Modelo';
					}
				}
			}
		}
	}


/**
 * Returns the data model based on the primary key given in the GET variable.
 * If the data model is not found, an HTTP exception will be raised.
 * @param integer $id the ID of the model to be loaded
 * @return Producto the loaded model
 * @throws CHttpException
 */
public function loadModel($id) {
$model = Producto::model() -> findByPk($id);
if ($model === null)
throw new CHttpException(404, 'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param Producto $model the model to be validated
*/
protected function performAjaxValidation($model) {
if (isset($_POST['ajax']) && $_POST['ajax'] === 'producto-form') {
echo CActiveForm::validate($model);
Yii::app() -> end();
}
}

public function actionloadImage($id) {
$model = $this -> loadModel($id);
header('Content-Type: ' . $model -> fileType);
print $model -> binaryfile;

}

}
