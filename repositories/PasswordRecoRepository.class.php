<?php

require 'core/phpmailer/src/Exception.php';
require 'core/phpmailer/src/PHPMailer.php';
require 'core/phpmailer/src/SMTP.php';


class PasswordRecoRepository extends Basesql
{

    /**
     * [initMailer description]
     * @return [type] [description]
     */
    public static function initMailer()
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = Setting::getParam('mail-server');
        $mail->SMTPAuth = true;
        $mail->Username = Setting::getParam('mail-login');
        $mail->Password = Setting::getParam('mail-password');
        $mail->SMTPSecure = 'tls';
        $mail->Port = Setting::getParam('mail-port');
        $mail->CharSet = "UTF-8";
        $mail->setFrom(Setting::getParam('mail-login'), Setting::getParam('title'));
        $mail->isHTML(true);

        return $mail;
    }

    /**
     * [sendResetPassword description]
     * @param  [type] $login [description]
     * @return [type]        [description]
     */
    public static function sendResetPassword($login)
    {
        if (User::loginExists($login)) {
            $passwordrecovery = new Passwordrecovery();
        
            $user = new User();
            $userFound = $user->getData('user', ["login"=>$login])[0];


            if ($userFound['status'] == 1) {
                $user->setId($userFound['id']);
                $user->cleanUserSlugPasswordRecovery();


                $passwordrecovery = new Passwordrecovery();
                $passwordrecovery->setToken();
                $passwordrecovery->setSlug($passwordrecovery->getToken());
                $passwordrecovery->setType(1);
                $passwordrecovery->setUserId($userFound['id']);

                $slug = new Slug();
                $slug->setSlug($passwordrecovery->getToken());
                $slug->setType(4);

                $slug->save();
                $passwordrecovery->save();

                $mail = self::initMailer();

                $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));
                $mail->Subject = ucfirst($userFound['firstname']).', réinitialiser votre mot de passe';
                $message = file_get_contents('views/mail/passwordrecovery.tpl.php');
                $message = str_replace('%username%', ucfirst($userFound['firstname']), $message);
                $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
                $message = str_replace('%sitename%', Setting::getParam('title'), $message);
                $mail->Body = $message;

            
                $mail->send();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * [confirmEmailNewUser description]
     * @param  [type] $login [description]
     * @return [type]        [description]
     */
    public static function confirmEmailNewUser($login)
    {
        if (User::loginExists($login)) {
            $passwordrecovery = new Passwordrecovery();
        
            $user = new User();
            $userFound = $user->getData('user', ["login"=>$login])[0];

        
            $user->setId($userFound['id']);
            $user->cleanUserSlugPasswordRecovery();


            $passwordrecovery = new Passwordrecovery();
            $passwordrecovery->setTokenConfirmation();
            $passwordrecovery->setSlug($passwordrecovery->getToken());
            $passwordrecovery->setType(2);
            $passwordrecovery->setUserId($userFound['id']);

            $slug = new Slug();
            $slug->setSlug($passwordrecovery->getToken());
            $slug->setType(5);

            $slug->save();
            $passwordrecovery->save();



            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';
            $mail->Password = 'wesic2018';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');

            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = ucfirst($userFound['firstname']).', veuillez confirmer votre e-mail';
            $message = file_get_contents('views/mail/confirmationemail.tpl.php');
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message);
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
            $message = str_replace('%sitename%', Setting::getParam('title'), $message);
            $mail->Body = $message;

            
            $mail->send();
            return true;
        } else {
            return false;
        }
    }

    /**
     * [confirmEmailNewsletter description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public static function confirmEmailNewsletter($email)
    {
        if (User::emailExists($email)) {
            $passwordrecovery = new Passwordrecovery();
        
            $user = new User();

            $qb = new QueryBuilder();

            $userFound = $qb
            ->select('*')
            ->from('user')
            ->addWhere('email = :email')
            ->setParameter('email', $email)
            ->fetchOne();

        
            $user->setId($userFound['id']);
            $user->cleanUserSlugPasswordRecovery();


            $passwordrecovery = new Passwordrecovery();
            $passwordrecovery->setTokenConfirmation();
            $passwordrecovery->setSlug($passwordrecovery->getToken());
            $passwordrecovery->setType(3);
            $passwordrecovery->setUserId($userFound['id']);

            $slug = new Slug();
            $slug->setSlug($passwordrecovery->getToken());
            $slug->setType(6);

            $slug->save();
            $passwordrecovery->save();



            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesic.corporate@gmail.com';
            $mail->Password = 'wesic2018';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";
            $mail->setFrom('wesic.corporate@gmail.com', 'Wesic Inc.');

            $mail->addAddress($userFound['email'], ucfirst($userFound['firstname'])." ".strtoupper($userFound['lastname']));

            $mail->isHTML(true);
            $mail->Subject = ucfirst($userFound['firstname']).', veuillez confirmer votre abonnement à la newsletter';
            $message = file_get_contents('views/mail/confirmationemailnewsletter.tpl.php');
            $message = str_replace('%username%', ucfirst($userFound['firstname']), $message);
            $message = str_replace('%urlreset%', "http://".DOMAIN."/".$passwordrecovery->getToken(), $message);
            $message = str_replace('%sitename%', Setting::getParam('title'), $message);
            $mail->Body = $message;

            
            $mail->send();
            return true;
        } else {
            return false;
        }
    }
}
