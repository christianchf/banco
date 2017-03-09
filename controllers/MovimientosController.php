<?php

namespace app\controllers;

use Yii;
use app\models\Cuenta;
use app\models\Movimiento;
use app\models\MovimientoSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * MovimientosController implements the CRUD actions for Movimiento model.
 */
class MovimientosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Movimiento models.
     * @return mixed
     */
    public function actionIndex($id_cuenta)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Movimiento::find()->where(['id_cuenta' => $id_cuenta])->orderBy('fecha_aparicion asc'),
        ]);
        $cuenta = Cuenta::find()->where(['id' => $id_cuenta])->one();

        if ($cuenta === null) {
            throw new NotFoundHttpException('La cuenta no existe.');
        }
        if ($cuenta->id_usuario !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('No tiene permitido ver los movimientos de esta cuenta.');
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'cuenta' => $cuenta,
        ]);
    }

    /**
     * Displays a single Movimiento model.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Movimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_cuenta)
    {
        $model = new Movimiento();
        $cuenta = Cuenta::find()->where(['id' => $id_cuenta])->one();

        if ($cuenta === null) {
            throw new NotFoundHttpException('La cuenta no existe.');
        }

        $model->id_cuenta = $id_cuenta;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_cuenta' => $id_cuenta]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Movimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Movimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Movimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Movimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movimiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
