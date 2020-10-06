<?php
namespace frontend\modules\sigi\models\users;
use frontend\models\SignupForm as SignupOriginal;

use yii\base\Model;
use mdm\admin\components\UserStatus;
use common\models\User;

use yii;
/**
 * Signup form
 */
class SignupForm extends SignupOriginal
{
    
  CONST ROL_PROPIETARIO='r_residente'; 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' =>yii::t('base.errors','This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ///['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => yii::t('base.errors','This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 2],
            
            ['status', 'safe', 'on' => 'createx'],
            ['status', 'required', 'on' => 'createx'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signupResidente($edificio_id)
    {
        
        
        if ($this->validate() && !$this->alreadyExists($this->username)) {
           // $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
              $user->status = UserStatus::ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
          
            if(!$this->alreadyExistsMail($user->email)){
            if ($user->save()) {
                $identidad=$user->getId();
                 $auth = Yii::$app->authManager;
               $authorRole = $auth->getRole(self::ROL_PROPIETARIO);
                $auth->assign($authorRole,$identidad );
                yii::error('generado profile');
                yii::error(\frontend\modules\sigi\Module::PROFILE_RESIDENTE);
                $user->getProfile($identidad, \frontend\modules\sigi\Module::PROFILE_RESIDENTE);
               /*
                * Ahorea toca colocarle el edificio al que corresponde */
                $user->refresh();
               //\frontend\modules\sigi\models\SigiUserEdificios::refreshTableByUser($user->id);
                \frontend\modules\sigi\models\SigiUserEdificios::insertUserEdificio($user->id,$edificio_id);
                
                return true;
            } else{
                return false;
            }
        }else{
           $this->addError('username',yii::t('sta.labels','La cuenta de correo {correo} ya existe',['correo'=>$this->email]));
            return false;
           
        }
        
        }else{
            $this->addError('username',yii::t('sta.labels','El nombre de usuario {name} ya existe',['name'=>$this->username]));
         return false;
        }
        
    }
  
   public function alreadyExists($name){
      return  User::find()->where(['username'=>trim($name)])->exists();
   }
   
   public function alreadyExistsMail($email){
      return  User::find()->where(['email'=>trim($email)])->exists();
   }
    
    
   
}

