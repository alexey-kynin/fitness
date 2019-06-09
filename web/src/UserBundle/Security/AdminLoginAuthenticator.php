<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.05.2019
 * Time: 16:59
 */

namespace UserBundle\Security;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use UserBundle\Form\AdminLoginForm;

final class AdminLoginAuthenticator extends AbstractFormLoginAuthenticator implements AuthenticatorInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em, RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        if ($request->getPathInfo() != '/admin/login' || $request->getMethod() != 'POST') {
            return false;
        }

        return true;
    }

    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create( AdminLoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $request->getSession()->set(Security::LAST_USERNAME,$data['email']);

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];

        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            return true;
        }

        if (!$user->hasRole('ROLE_ADMIN')) {
            throw new CustomUserMessageAuthenticationException("You don't have permission to access that page.");
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new RedirectResponse($this->router->generate('admin_login'));
    }

    protected function getLoginUrl()
    {
        return new RedirectResponse($this->router->generate('admin_login'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
//        return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
        $user = $token->getUser();
        if($user->isGranted( 'ROLE_ADMIN' )){
            $url = $this->router->generate( 'sonata_admin_dashboard' );
        }else{
            $url = $this->router->generate( 'security_login' );
        }
        return new RedirectResponse( $url );
    }


}