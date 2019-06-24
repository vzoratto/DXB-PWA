 if (Yii::$app->user->isGuest) {

            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];

            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];

        } else {

            $menuItems[] = [

                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',

                'url' => ['/site/logout'],

                'linkOptions' => ['data-method' => 'post']

            ];

        }