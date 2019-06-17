<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.05.2019
 * Time: 22:17
 */

namespace UserBundle\Extend\Security;


use CoreBundle\Extend\Utils\TokenGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use UserBundle\Entity\User;

class RecoverPassword
{
    private $mailer;
    private $twig;
    private $em;
    private $router;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        $this->mailer =$mailer;
        $this->twig =$twig;
        $this->em =$entityManager;
        $this->router =$router;
    }

    /**
     * @param User $user
     * Kynin. sending letter
     */
    public function sendEmail(User $user)
    {
        $token = TokenGenerator::generateToken();

        $url = $this->router->generate('recover', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
        $fullname = $user->getUsername();
        $temlate = $this->twig->render('@User/MailTemplate/recover.html.twig', [
            'url' => $url,
            'fullname' => $fullname
        ]);

        /**Кынин. создаем структуру письма*/
        $mail = \Swift_Message::newInstance();
//        $mail->setFormat('noreplay@userbundle.dev');
        $mail->setFrom('fitnessclub@mail.ru');
        $mail->setTo($user->getEmail());
        $mail->setSubject('Create a password');
        $mail->setBody($temlate);

        var_dump($token);
        $user->getAccount()->setTokenRecover($token);
        $this->em->persist($user);
        $this->em->flush();

        $status = $this->mailer->send($mail);
        if($status){
            return true;
        } else {
            return false;
        }
    }
}