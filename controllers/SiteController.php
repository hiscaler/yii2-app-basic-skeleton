<?php

namespace app\controllers;

use app\models\User;
use app\forms\ChangeMyPasswordForm;
use app\forms\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'profile', 'change-password', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->goHome();
        }

        $this->layout = false;

        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                    'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    public function actionProfile()
    {
        $model = User::findOne(Yii::$app->getUser()->id);

        return $this->render('profile', [
                'model' => $model,
        ]);
    }

    /**
     * 修改密码
     * @return mixed
     */
    public function actionChangePassword()
    {
        $user = $this->findCurrentUserModel();
        $model = new ChangeMyPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->setPassword($model->password);
            if ($user->save(false)) {
                Yii::$app->getSession()->setFlash('notice', "您的密码修改成功，请下次登录使用新的密码。");
                return $this->refresh();
            }
        }

        return $this->render('change-password', [
                'user' => $user,
                'model' => $model,
        ]);
    }

    public function findCurrentUserModel()
    {
        if (($model = User::findOne(Yii::$app->user->id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
