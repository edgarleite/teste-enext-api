<?php

namespace app\models;

use Yii;
use app\components\UserBehavior;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 *
 * @property Formula[] $formulas
 * @property Product[] $products
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'string', 'max' => 25],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            UserBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = md5($this->password);
                $this->auth_key = Yii::$app->security->generateRandomString();
            }

            return true;
        }

        return false;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulas()
    {
        return $this->hasMany(Formula::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public static function findIdentityByAccessToken($token, $type = null)
    // {
    //     foreach (self::$users as $user) {
    //         if ($user['access_token'] === $token) {
    //             return new static($user);
    //         }
    //     }

    //     return null;
    // }
    
    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = self::find()->where(['id' => $token->getClaim('uid')])->one();

        if ($user !== null) {
            return new static($user);
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    
    /**
     * Generate JWT
     * @return string
     */
    public static function generateToken(\app\models\User $user)
    {
        $signer = new Sha256();

        $token = Yii::$app->jwt->getBuilder()
            ->setIssuer('http://localhost:8888') // Configures the issuer (iss claim)
            ->setAudience('http://localhost:8888') // Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setNotBefore(time() + 60) // Configures the time before which the token cannot be accepted (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('uid', $user->id) // Configures a new claim, called "uid"
            ->set('username', $user->username) // Configures a new claim, called "uid"
            ->sign($signer, 'testing') // creates a signature using "testing" as key
            ->getToken(); // Retrieves the generated token

        return (string) $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
